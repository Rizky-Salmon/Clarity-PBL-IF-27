<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\ActivityPercentage;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ActivityPercentageController extends Controller
{
    public function index()
    {
        $activity = Activity::all();

        $query = ActivityPercentage::query()->with('activity')->get();

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addColumn('activity_name', function ($percentage) {
                    return $percentage->activity->activity_name;
                })
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

                    <!-- Modal -->
                    <div class="modal fade" id="editPercentageModal' . $item->id_activity_percentage . '" tabindex="-1" role="dialog" aria-labelledby="editPercentageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPercentageModalLabel">Update Activity Percentage</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="' . route('percentage.update', $item->id_activity_percentage) . '" method="POST">
                                        ' . csrf_field() . method_field("PUT") . '
                                        <div class="form-group">
                                            <label for="activityName">Activity</label>
                                            <input type="text" class="form-control" id="activityName" value="' . $item->activity->activity_name . '" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="percentageValue">Percentage (1-100)</label>
                                            <input type="number" class="form-control" id="percentageValue" name="percentageValue" min="0" max="100" placeholder="0" value="' . $item->percentage . '" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="deletePercentageModal' . $item->id_activity_percentage . '" tabindex="-1" role="dialog" aria-labelledby="deletePercentageModalLabel' . $item->id_activity_percentage . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Activity Percentage</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this activity percentage?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="' . route("percentage.destroy", $item->id_activity_percentage) . '" method="POST">
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

        return view('a_percentage', [
            'activity' => $activity,
        ]);
    }


    public function create()
    {
        return view('activity_percentage.create');
    }

    // Store a new percentage
    public function store(Request $request)
    {
        $rules = [
            'activity_name' => 'required|exists:activity,activity_name',
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity name is required',
            'activity_name.exists' => 'Activity name does not exist',
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

        Alert::success('Success', 'Subsector added successfully!');
        return redirect()->route('ManagePercentage')
        ->with('success', 'Activity percentage successfully added.');
    }


    // Show the details of a percentage
    public function show(ActivityPercentage $activityPercentage)
    {
        return view('a_percentage.show', compact('activityPercentage'));
    }

    // Show the form for editing a percentage
    public function edit(ActivityPercentage $activityPercentage)
    {
        return view('a_percentage.edit', compact('activityPercentage'));
    }

    // Update an existing percentage
    public function update(Request $request, $id_activity_percentage)
    {
        $rules = [
            'activity_name' => 'required',
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity name is required',
            'percentage.required' => 'Percentage is required',
            'percentage.integer' => 'Percentage must be a number',
            'percentage.min' => 'Percentage must be at least 0',
            'percentage.max' => 'Percentage must be at most 100',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);

        $activityPercentage->update([
            'activity_name' => $request->input('activity_name'),
            'percentage' => $request->input('percentage'),
        ]);

        Alert::success(
            'Success',
            'Percentage updated successfully!'
        );

        return redirect()->route('activity_percentage.index')
        ->with('success', 'Activity percentage successfully updated.');
    }


    // Delete a percentage
    public function destroy($id_activity_percentage)
    {
        $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);

        Alert::success('Success', 'Activity percentage deleted successfully!');

        if ($activityPercentage->delete()) {
            return redirect()->route('ManagePercentage')
            ->with('success', 'Activity percentage deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete activity percentage.');
        }
    }
}
