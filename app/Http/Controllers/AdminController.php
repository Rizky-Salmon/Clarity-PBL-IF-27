<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Activity;
use App\Models\Employees;
use App\Models\SubSector;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {

        // Count Activity
        $count['activity'] = Activity::count();

        // Count Sector
        $count['sector'] = Sector::count();

        // Count SubSector
        $count['sub_sector'] = SubSector::count();
        // Count Employee
        $count['employee'] = Employees::count();

        return view('dashboard', ['count' => $count]);
    }
    function employees()
    {
        return view('dashboard_employee');
    }
}
