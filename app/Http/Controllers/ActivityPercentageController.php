<?php
namespace App\Http\Controllers;

use App\Models\ActivityPercentage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ActivityPercentageController extends Controller
{
    public function index()
    {
        $percentages = ActivityPercentage::all();
        $query = ActivityPercentage::all();

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '

                        <div class="edit-percentage-buttons">
                            <a href="#" data-toggle="modal" data-target="#editPercentageModal' . $item->id_activity_percentage . '">
                                <button type="button" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#deletePercentageModal' . $item->id_activity_percentage  . '">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                        </div>

                        <div class="modal fade" id="editPercentageModal' . $item->id_activity_percentage . '" tabindex="-1" role="dialog" aria-labelledby="editPercentageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPercentageModalLabel">Update My Activity!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="' . route('percentage.update', $item->id_activity_percentage) . '" method="POST">
                                            ' . csrf_field() . '

                                            <input type="hidden" name="modalId" value="editPercentageModal' . $item->id_activity_percentage . '">

                                            <input type="hidden" name="id_activity_percentage" value="' . $item->id_activity_percentage . '">

                                            <div class="form-group">
                                                <label for="percentageName' . $item->id_activity_percentage . '">Activities</label>
                                                <input type="text" class="form-control" id="percentageName' . $item->id_activity_percentage . '" name="percentageName">
                                            </div>
                                            <div class="form-group">
                                                <label for="percentageValue' . $item->id_activity_percentage . '">Percentage (1-100)</label>
                                                <input type="number" class="form-control" id="percentageValue' . $item->id_activity_percentage . '" name="percentageValue" min="0" max="100" placeholder="0" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deletePercentageModal' . $item->id_activity_percentage . '" tabindex="-1" role="dialog" aria-labelledby="deletePercentageModalLabel' . $item->id_activity_percentage . '" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePercentageModalLabel' . $item->id_activity_percentage . '">Delete Percentage</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this percentage?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="' . route('percentage.destroy', $item->id_activity_percentage) . '" method="POST">
                                            ' . csrf_field() . method_field("DELETE") . '
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('activity_percentages.index', compact('percentages'));
    }
    public function create()
    {
        return view('activity_percentage.create');
    }

    // Store a new percentage
    public function store(Request $request)
    {
        $rules = [
            'activity_name' => 'required|unique:activity_percentages,activity_name',
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity name is required',
            'activity_name.unique' => 'Activity name has already been used',
            'percentage.required' => 'Percentage is required',
            'percentage.integer' => 'Percentage must be a number',
            'percentage.min' => 'Percentage must be at least 0',
            'percentage.max' => 'Percentage must be at most 100',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addPercentageModal'])
                ->withInput($request->all());
        }

        $insert_data = [
            'activity_name' => $request->input('activity_name'),
            'percentage' => $request->input('percentage'),
        ];

        ActivityPercentage::create($insert_data);

        Alert::success('Success', 'Activity percentage added successfully!');
        return redirect()->route('activity_percentage.index')
        ->with('success', 'Activity percentage successfully added.');
    }

    // Show the details of a percentage
    public function show(ActivityPercentage $activityPercentage)
    {
        return view('activity_percentage.show', compact('activityPercentage'));
    }

    // Show the form for editing a percentage
    public function edit(ActivityPercentage $activityPercentage)
    {
        return view('activity_percentage.edit', compact('activityPercentage'));
    }

    // Update an existing percentage
    public function update(Request $request, $id)
    {
        $rules = [
            'activity_name' => 'required|unique:activity_percentages,activity_name,' . $id,
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity name is required',
            'activity_name.unique' => 'Activity name has already been used',
            'percentage.required' => 'Percentage is required',
            'percentage.integer' => 'Percentage must be a number',
            'percentage.min' => 'Percentage must be at least 0',
            'percentage.max' => 'Percentage must be at most 100',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'editPercentageModal'])
                ->withInput($request->all());
        }

        $activityPercentage = ActivityPercentage::findOrFail($id);

        $activityPercentage->update([
            'activity_name' => $request->input('activity_name'),
            'percentage' => $request->input('percentage'),
        ]);

        Alert::success('Success', 'Activity percentage updated successfully!');

        return redirect()->route('activity_percentage.index')
        ->with('success', 'Activity percentage successfully updated.');
    }

    // Delete a percentage
    public function destroy($id)
    {
        $activityPercentage = ActivityPercentage::findOrFail($id);

        if ($activityPercentage->delete()) {
            Alert::success('Success', 'Activity percentage deleted successfully!');
            return redirect()->route('activity_percentage.index')
            ->with('success', 'Activity percentage deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete activity percentage.');
        }
    }
}
