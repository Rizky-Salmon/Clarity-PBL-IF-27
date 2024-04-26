<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{
    // Menampilkan semua employees
    public function index()
    {
        $employees = Employees::all();
        $query = Employees::all();


        if (request()->ajax()) {


            return DataTables::of($query)
                ->addcolumn('action', function ($item) {
                    return '

                        <div class="edit-employee-buttons">
                            <a href="#" data-toggle="modal" data-target="#editEmployeeModal' . $item->id_employees . '">
                                <button type="button" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#deleteEmployeeModal' . $item->id_employees . '">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                        </div>


                        <div class="modal fade" id="editEmployeeModal' . $item->id_employees . '" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEmployeeModalLabel">Update
                                        Employee
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="' . route('employees.update', $item->id_employees) . '" method="POST">
                                        ' . method_field("PUT") . csrf_field() . '

                                        <input type="hidden" name="id_employees" value="' . $item->id_employees . '">
                                        <div class="form-group">
                                            <label for="employeeName">Name</label>
                                            <input type="text" class="form-control" id="employeeName" name="EmployeeName" value="' . old('EmployeeName', $item->name) . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="employeeEmail">Email</label>
                                            <textarea class="form-control" id="employeeEmail" rows="2">' . old('employeeEmail', $item->email) . '</textarea>
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
                                    <button type="button" class="btn btn-danger">Delete</button>
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
        ]);

        Employees::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employees berhasil ditambahkan.');
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
    // Menyimpan perubahan pada employees
    public function update(Request $request, $id_employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id_employee,
        ]);

        $employee = Employees::findOrFail($id_employee); // Mengambil employees berdasarkan id_employee

        $employee->update([
            'name' => $request->name, // Memperbarui nama employees
            'email' => $request->email,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employees berhasil diperbarui.');
    }



    // Menghapus employees
    public function destroy($id_employee)
    {
        $employee = Employees::findOrFail($id_employee);

        if ($employee->delete()) {
            return redirect()->route('employees.index')
                ->with(
                    'success',
                    'Employees deleted successfully.'
                );
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete employees.');
        }
    }
}
