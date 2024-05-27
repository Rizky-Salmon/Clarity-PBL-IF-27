<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Activity;
use App\Models\Employees;
use App\Models\SubSector;
use Illuminate\Http\Request;

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
    function employees()
    {
        $employee = Employees::first(); // Assuming you just need one employee data for now
        return view('dashboard_employee', ['employee' => $employee]);
    }
}
