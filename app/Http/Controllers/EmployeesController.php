<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    // Menampilkan semua employees
    public function index()
    {
        $employees = Employees::all();
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
            'email' => 'required|email|unique:employees,email,'.$id_employee,
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
