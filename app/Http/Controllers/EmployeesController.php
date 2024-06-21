<?php

namespace App\Http\Controllers;

use App\Models\ActivityPercentage;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    // Menampilkan semua employees
    public function index()
    {
        $employees = Employees::all();
        $query = Employees::all();

        if (request()->ajax()) {
            return DataTables::of($query)
            ->addcolumn('activity',
                function ($item) {
                    return $item->ActivitY->count() . " Activity" ?? 0 . " Activity";
                }
            )
            ->addcolumn('action', function ($item) {
                $return= '
                    <div class="edit-employee-buttons"> ';
                    if (auth()->user()->email != $item->email) {
                        $return .= '<a href="#" data-toggle="modal" data-target="#editEmployeeModal' . $item->id_employees . '">
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#deleteEmployeeModal' . $item->id_employees . '">
                            <button type="button" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </a>';
                    } $return .= '

                        <a href="' . route('ManagePercentage', $item->id_employees) . '">
                            <button type="button" class="btn btn-secondary btn-sm my-1 mx-1">
                                Manage Activity
                            </button>
                        </a>
                    </div>
                    <div class="modal fade" id="editEmployeeModal' . $item->id_employees . '" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEmployeeModalLabel">Update Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="' . route('employees.update', $item->id_employees) . '" method="POST">
                                        ' . method_field("PUT") . csrf_field() . '
                                        <input type="hidden" name="modalId" value="editEmployeeModal' . $item->id_employees . '">
                                        <input type="hidden" name="id_employees" value="' . $item->id_employees . '">
                                        <input type="hidden" name="old_employeeEmail" value="' . $item->email . '">
                                        <div class="form-group">
                                            <label for="employeeName">Name</label>
                                            <input type="text" class="form-control" id="employeeName" name="employeeName" value="' . old('employeeName', $item->name) . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="employeeEmail">Email</label>
                                            <textarea class="form-control" name="employeeEmail" id="employeeEmail" rows="2">' . old('employeeEmail', $item->email) . '</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="employeeRole">Role</label>
                                            <select class="form-control" id="employeeRole" name="employeeRole">
                                                <option value="admin" ' . (old('employeeRole', $item->role) == 'admin' ? 'selected' : '') . '>Admin</option>
                                                <option value="employees" ' . (old('employeeRole', $item->role) == 'employees' ? 'selected' : '') . '>Employees</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteEmployeeModal' . $item->id_employees . '" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModal' . $item->id_employees . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this data?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="' . route("employees.destroy", $item->id_employees) . '" method="POST">
                                    ' . csrf_field() . method_field("DELETE") . '
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                return $return;
            })
                ->rawColumns(['action'])
                ->make();
        }

        return view('a_employees', compact('employees'));
    }


    // Menampilkan form untuk membuat employees baru
    public function create()
    {
        return view('a_employees');
    }

    // Menyimpan employees baru
    public function store(Request $request)
    {
        $rules = [
            'add_employeeName' => 'required',
            'add_employeeEmail' => 'required|email|unique:employees,email',
            'add_employeeRole' => ['required', Rule::in(['admin', 'employees'])],
            'add_employeePassword' => 'required|min:8', // Validasi untuk password baru
        ];

        $customMessage = [
            'add_employeeName.required' => 'Employee name is required',
            'add_employeeEmail.required' => 'Employee email is required',
            'add_employeeEmail.email' => 'Employee email must be a valid email address',
            'add_employeeEmail.unique' => 'Employee email has already been used',
            'add_employeeRole.required' => 'Employee role is required',
            'add_employeeRole.in' => 'Employee role must be either admin or employees',
            'add_employeePassword.required' => 'Employee password is required',
            'add_employeePassword.min' => 'Employee password must be at least 8 characters',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addEmployeeModal'])
                ->withInput($request->all());
        }

        $insert_data = [
            'name' => $request->input('add_employeeName'),
            'email' => $request->input('add_employeeEmail'),
            'password' => Hash::make($request->input('add_employeePassword')), // Enkripsi password
            'role' => $request->input('add_employeeRole', 'employees'),
        ];

        Employees::create($insert_data);

        Alert::success('Success', 'Employee added successfully!');
        return redirect()->route('employees.index')
        ->with('success', 'Employee berhasil ditambahkan.');
    }


    // Menampilkan detail employees
    public function show(Employees $employee)
    {
        return view('a_employees.show', compact('employee'));
    }

    // Menampilkan form untuk mengedit employees
    public function edit(Employees $employee)
    {
        return view('a_employees.edit', compact('employee'));
    }

    // Menyimpan perubahan pada employees
    public function update(Request $request, $id_employee)
    {
        $rules = [
            'employeeName' => 'required',
            'employeeEmail' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($request->old_employeeEmail, 'email'),
            ],
            'employeeRole' => ['required', Rule::in(['admin', 'employees'])],
        ];

        $customMessage = [
            'employeeName.required' => 'Employee name is required',
            'employeeEmail.required' => 'Employee email is required',
            'employeeEmail.email' => 'Employee email must be a valid email address',
            'employeeEmail.unique' => 'Employee email has already been used',
            'employeeRole.required' => 'Employee role is required',
            'employeeRole.in' => 'Employee role must be either admin or employees',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            Alert::error('Error', 'Check submitted data and try again later !');
            return redirect()->back()
            ->withErrors($validator)
                ->with(['openModal' => $request->modalId])
                ->withInput($request->all());
        }

        $employee = Employees::where('id_employees', $id_employee)->firstOrFail();

        $employee->name = $request->employeeName;
        $employee->email = $request->employeeEmail;
        $employee->role = $request->employeeRole;

        $employee->save();

        Alert::success('Success', 'Employee updated successfully!');

        return redirect()->route('employees.index')
        ->with('success', 'Employee berhasil diperbarui.');
    }

    // Menghapus employees
    public function destroy($id_employee)
    {
        $employee = Employees::findOrFail($id_employee);

        ActivityPercentage::where('id_employees', $id_employee)->delete();

        if ($employee->delete()) {
            Alert::success('Success', 'Employee deleted successfully!');
            return redirect()->route('employees.index')
                ->with('success','Employees deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete employees.');
        }
    }
}
