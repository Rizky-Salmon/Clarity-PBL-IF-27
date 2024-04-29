<?php

use App\Models\Sector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SubSectorController;
use App\Models\Employees;

// Akses Tanpa Login
Route::middleware('guest')->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/register', function () {
        return view('auth/register', [
            'title' => 'Register'
        ]);
    });
});


// Harus Login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [SessionController::class, 'logout']);

    Route::get('/employees', [AdminController::class, 'employees']);

    Route::get('/admin', [AdminController::class, 'index']);


    // Manage Employees
    Route::get('employees', [EmployeesController::class, 'index'])->name('employees.index');
    Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');
    Route::put('employees/{id_employees}', [EmployeesController::class, 'update'])->name('employees.update');
    Route::delete('employees/{id_employees}', [EmployeesController::class, 'destroy'])->name('employees.destroy');


    // Manage Sector
    Route::get('sector', [SectorController::class, 'index'])->name('sector.index');
    Route::post('sector', [SectorController::class, 'store'])->name('sector.store');
    Route::put('sector/{id_sector}', [SectorController::class, 'update'])->name('sector.update');
    Route::delete('sector/{id_sector}', [SectorController::class, 'destroy'])->name('sector.destroy');


    // Manage Sub Sector
    Route::get('/a_subsector/{id_subsector?}', [SubSectorController::class, 'index'])->name('ManageSubSector');



    // Manage Activity
    Route::get('activity', [ActivityController::class, 'index'])->name('activity.index');
    Route::post('activity', [ActivityController::class, 'store'])->name('activity.store');
    Route::put('activity/{id_activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('activity/{id_activity}', [ActivityController::class, 'destroy'])->name('activity.destroy');
});










// Navbar untuk Interaktif visualisasi dan employee
Route::get('/a_percentage', function () {
    return view('a_percentage', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_percentage', function () {
    return view('i_percentage', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_activity', function () {
    return view('i_activity', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_employee', function () {
    return view('i_employee', [
        'title' => 'Clarity'
    ]);
});

// profile
Route::get('/profile', function () {
    return view('profile', [
        'title' => 'Clarity'
    ]);
});
