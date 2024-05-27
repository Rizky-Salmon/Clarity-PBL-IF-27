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
        $employee = Employees::first(); // Assuming you just need one employee data for now

        return view('dashboard', ['count' => $count, 'employee' => $employee]);
    }
    function employees()
    {
        return view('dashboard_employee');
    }
}
