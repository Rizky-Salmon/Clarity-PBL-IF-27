<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Activity;
use App\Models\Employees;
use App\Models\SubSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        // Count Activity
        $count['activity'] = Activity::count();

        // Count Sector
        $count['sector'] = Sector::count();

        // Count SubSector
        $count['sub_sector'] = SubSector::count();

        // Count Employee
        $count['employee'] = Employees::count();

        // Fetch Employee Data
        $user_id = auth()->user()->id_employees; // Assuming you have `id` column in your `employees` table
        $employee = Employees::where('id_employees', $user_id)->first();

        return view('dashboard', ['count' => $count, 'employee' => $employee]);
    }

    public function employees()
    {
        $user_id = auth()->user()->id_employees; // Assuming you have `id` column in your `employees` table
        $employee = Employees::where('id_employees', $user_id)->first();
        return view('dashboard_employee', ['employee' => $employee]);
    }

    // Update name
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user_id = auth()->user()->id_employees;
        $employee = Employees::where('id_employees', $user_id)->first();
        $employee->name = $request->name;
        $employee->save();

        Alert::success('Success', 'Name updated successfully');

        return redirect()->back()->with('success', 'Name updated successfully')->with('openModal', 'editNameModal');
    }

    // Update email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:employees,email,' . auth()->user()->id_employees . ',id_employees',
        ]);

        $user_id = auth()->user()->id_employees;
        $employee = Employees::where('id_employees', $user_id)->first();
        $employee->email = $request->email;
        $employee->save();

        Alert::success('Success', 'Email updated successfully');

        return redirect()->back()->with('success', 'Email updated successfully')->with('openModal', 'editEmailModal');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user_id = auth()->user()->id_employees;
        $employee = Employees::where('id_employees', $user_id)->first();

        if (!Hash::check($request->current_password, $employee->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $employee->password = Hash::make($request->new_password);
        $employee->default_password = 0;
        $employee->save();

        Alert::success('Success', 'Password updated successfully');

        return redirect()->back()->with('success', 'Password updated successfully')->with('openModal', 'editPasswordModal');
    }

}
