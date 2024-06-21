<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Activity;
use App\Models\Employees;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\ActivityPercentage;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ActivityPercentageController extends Controller
{
    public function index(Request $request, $id_employees = null)
    {
        $activity = Activity::all();
        $user = auth()->user();

        // Jika role adalah employees, batasi karyawan yang dapat diakses hanya ke data mereka sendiri
        if ($user->role === 'employees') {
            $employees = Employees::where('id_employees', $user->id_employees)->get();
        } else {
            $employees = Employees::all();
        }

        $query = ActivityPercentage::query()->with(['activity', 'employee']);

        // Jika ID karyawan diberikan, tambahkan kriteria where
        if ($id_employees && $id_employees !== 'All') {
            $query->where('id_employees', $id_employees);
        }

        // Jika role adalah employees, batasi data yang ditampilkan hanya untuk karyawan tersebut
        if ($user->role === 'employees') {
            $query->where('id_employees', $user->id_employees);
        }

        if ($request->ajax()) {
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
                ->addColumn('action', function ($item) use ($activity, $employees) {
                    $role = auth()->user()->role;

                    $editForm = '<form action="' . route('activity_percentage.update', $item->id_activity_percentage) . '" method="POST">
                    ' . csrf_field() . method_field("PUT") . '
                    <div class="form-group">
                        <label for="activityName">Activity</label>
                        <select class="form-control" id="activityName" name="activity_name">
                            <option value="' . $item->activity->id_activity . '">' . $item->activity->activity_name . '</option>';
                    foreach ($activity as $value) {
                        $editForm .= '<option value="' . $value->id_activity . '">' . $value->activity_name . '</option>';
                    }
                    $editForm .= '</select>
                    </div>';

                    if ($role == 'admin') {
                        $editForm .= '<div class="form-group">
                          <label for="employeeName">Employee</label>
                          <select class="form-control" id="employeeName" name="employee_name">';
                        foreach ($employees as $value) {
                            $editForm .= '<option value="' . $value->id_employees . '"';
                            if ($value->id_employees == $item->employee->id_employees) {
                                $editForm .= ' selected';
                            }
                            $editForm .= '>' . $value->name . '</option>';
                        }
                        $editForm .= '</select>
                      </div>';
                    } else {
                        $editForm .= '<div class="form-group">
                          <label for="employeeName">Employee</label>
                          <input type="text" class="form-control" id="employeeName" name="employee_name" value="' . $item->employee->name . '" readonly>
                          <input type="hidden" name="employee_name" value="' . $item->employee->id_employees . '">
                      </div>';
                    }

                    $editForm .= '<div class="form-group">
                      <label for="percentageValue">Percentage (1-100)</label>
                      <input type="number" class="form-control" id="percentageValue" name="percentage" min="0" max="100" placeholder="0" value="' . $item->percentage . '" required>
                  </div>
                  <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>';

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
                        ' . $editForm . '
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
                ->make(true);
        }

        return view('a_percentage', [
            'activity' => $activity,
            'employees' => $employees,
            'selectedEmployees' => $id_employees,
        ]);
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


    public function update(Request $request, $id_activity_percentage)
    {
        $rules = [
            'activity_name' => 'required|exists:activity,id_activity',
            'employee_name' => 'required|exists:employees,id_employees',
            'percentage' => 'required|integer|min:0|max:100',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity is required',
            'activity_name.exists' => 'Activity does not exist',
            'employee_name.required' => 'Employee is required',
            'employee_name.exists' => 'Employee does not exist',
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

        $update_data = [
            'id_activity' => $request->input('activity_name'),
            'id_employees' => $request->input('employee_name'),
            'percentage' => $request->input('percentage'),
        ];

        try {
            $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);
            $activityPercentage->update($update_data);

            Alert::success('Success', 'Activity percentage updated successfully!');
            return redirect()->route('ManagePercentage')
                ->with('success', 'Activity percentage successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update activity percentage: ' . $e->getMessage());
        }
    }


    public function destroy($id_activity_percentage)
    {
        try {
            $activityPercentage = ActivityPercentage::findOrFail($id_activity_percentage);
            $activityPercentage->delete();

            Alert::success('Success', 'Activity percentage deleted successfully!');
            return redirect()->route('ManagePercentage')
                ->with('success', 'Activity percentage successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete activity percentage: ' . $e->getMessage());
        }
    }

    public function generate(Request $request, $id_employees = null){

        $query = Employees::query();

        // Jika ID karyawan diberikan, tambahkan kriteria where
        if ($id_employees && $id_employees !== 'All') {
            $query = Employees::where('id_employees', $id_employees)->get();
        } else {
            $query = Employees::all();
        }

        $query->transform(function ($employee) {
            $employee->list_activity =
            ActivityPercentage::where('id_employees', $employee->id_employees)->get()
            ->transform(

                function ( $activity ) {
                    $activity->activity = Activity::where('id_activity', $activity->id_activity)->get();
                    return $activity;
                }


            );

            return $employee;
        });


        $data = DB::select("SELECT subsector.description FROM subsector WHERE id_subsector IN(SELECT DISTINCT  (id_subsector)  FROM activity_subsector WHERE id_activity IN(SELECT id_activity FROM activity_percentage WHERE activity_percentage.id_employees=?))", [$id_employees]);

        ddd( $query->first() );
    }


    public function create()
    {
        $activities = Activity::all();
        $employees = Employees::all();
        return view('activity_percentage.create', compact('activities', 'employees'));
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
}
