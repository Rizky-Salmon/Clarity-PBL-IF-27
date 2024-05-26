<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\ActivityPercentage;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ActivityPercentageController extends Controller
{
    public function index($id_employees = null)
    {
        $activity = Activity::all();
        $employees = Employees::all();

        $query = ActivityPercentage::query()->with(['activity', 'employee']);

        // Jika ID karyawan diberikan, tambahkan kriteria where
        if ($id_employees) {
            $query->where('id_employees', $id_employees);
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addColumn('activity_name', function ($percentage) {
                    return $percentage->activity->activity_name;
                })
                ->addColumn('employee_name', function ($percentage) {
                    return $percentage->employee->name;
                })
                ->addColumn('percentage', function ($percentage) {
                    return $percentage->percentage . '%';
                })
                ->addColumn('action', function ($item) {
                    $role = auth()->user()->role;
                    $editButton = '<a href="#" data-toggle="modal" data-target="#editPercentageModal' . $item->id_activity_percentage . '">
                                <button type="button" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                               </a>';
                    $deleteButton = '<a href="#" data-toggle="modal" data-target="#deletePercentageModal' . $item->id_activity_percentage  . '">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                              </a>';

                    return '
                <div class="edit-percentage-buttons">
                    ' . $editButton . $deleteButton . '
                </div>

                <!-- Modal Edit -->
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
                                <form action="' . route('activity_percentage.update', $item->id_activity_percentage) . '" method="POST">
                                    ' . csrf_field() . method_field("PUT") . '
                                    <div class="form-group">
                                        <label for="activityName">Activity</label>
                                        <input type="text" class="form-control" id="activityName" name="activity_name" value="' . $item->activity->activity_name . '" ' . ($role == 'admin' ? '' : 'readonly') . '>
                                    </div>

                                    <div class="form-group">
                                        <label for="employeeName">Employee</label>
                                        <input type="text" class="form-control" id="employeeName" name="employee_name" value="' . $item->employee->name . '" ' . ($role == 'admin' ? '' : 'readonly') . '>
                                    </div>

                                    <div class="form-group">
                                        <label for="percentageValue">Percentage (1-100)</label>
                                        <input type="number" class="form-control" id="percentageValue" name="percentage" min="0" max="100" placeholder="0" value="' . $item->percentage . '" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Delete -->
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
                                <form action="' . route("activity_percentage.destroy", $item->id_activity_percentage) . '" method="POST">
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
            'employees' => $employees,
            'selectedEmployees' => $id_employees,
        ]);
    }




    public function create()
    {
        $activities = Activity::all();
        $employees = Employees::all();
        return view('activity_percentage.create', compact('activities', 'employees'));
    }

    public function store(Request $request)
    {
        $rules = [
            'add_activityName' => 'required|exists:activity,id_activity',
            'add_employeeName' => 'required|exists:employees,id_employees',
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'add_activityName.required' => 'Activity is required',
            'add_activityName.exists' => 'Activity does not exist',
            'add_employeeName.required' => 'Employee is required',
            'add_employeeName.exists' => 'Employee does not exist',
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
            'id_activity' => $request->input('add_activityName'),
            'id_employees' => $request->input('add_employeeName'),
            'percentage' => $request->input('percentage'),
        ];

        ActivityPercentage::create($insert_data);

        Alert::success('Success', 'Activity percentage added successfully!');
        return redirect()->route('ManagePercentage')
            ->with('success', 'Activity percentage successfully added.');
    }

    public function show(ActivityPercentage $activityPercentage)
    {
        return view('a_percentage.show', compact('activityPercentage'));
    }

    public function edit(ActivityPercentage $activityPercentage)
    {
        $activities = Activity::all();
        $employees = Employees::all();
        return view('a_percentage.edit', compact('activityPercentage', 'activities', 'employees'));
    }

    public function update(Request $request, $id_activity_percentage)
    {
        $rules = [
            'percentageValue' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'percentageValue.required' => 'Percentage is required',
            'percentageValue.integer' => 'Percentage must be a number',
            'percentageValue.min' => 'Percentage must be at least 0',
            'percentageValue.max' => 'Percentage must be at most 100',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        // Ubah input 'percentageValue' sesuai dengan field yang diperlukan pada ActivityPercentage
        $update_data = [
            'percentage' => $request->input('percentageValue'),
        ];

        try {
            // Ubah bagian ini untuk mencari entitas ActivityPercentage dengan id yang sesuai
            $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);

            // Perbarui entitas dengan data yang diperbarui
            $activityPercentage->update($update_data);

            Alert::success('Success', 'Activity percentage updated successfully!');
            return redirect()->route('ManagePercentage')
            ->with('success', 'Activity percentage successfully updated.');
        } catch (\Exception $e) {
            // Tambahkan penanganan kesalahan untuk menangani kesalahan yang mungkin terjadi saat menyimpan
            return redirect()->back()
                ->with('error', 'Failed to update activity percentage: ' . $e->getMessage());
        }
    }


    public function destroy($id_activity_percentage)
    {
        $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);

        if ($activityPercentage->delete()) {
            Alert::success('Success', 'Activity percentage deleted successfully!');
            return redirect()->route('ManagePercentage')
                ->with('success', 'Activity percentage deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete activity percentage.');
        }
    }
}
