<?php

use App\Models\Sector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EmployeesController;
use App\Models\Employees;

Route::middleware('guest')->group(function () {
    Route::get('/', [SessionController::class, 'index']);
    Route::post('/', [SessionController::class, 'login'])->middleware('throttle:5,1');
});

Route::get('/admin', [AdminController::class, 'index']);
Route::get('employees', [AdminController::class, 'employees']);
Route::get('/logout', [SessionController::class, 'logout']);

// activity
Route::get('activity', [ActivityController::class, 'index'] )->name('activity.index');
Route::post('activity', [ActivityController::class, 'store'])->name('activity.store');
Route::put('activity/{id_activity}', [ActivityController::class, 'update'])->name('activity.update');
Route::delete('activity/{id_activity}', [ActivityController::class, 'destroy'])->name('activity.destroy');

// Sektor
Route::get('sector', [SectorController::class, 'index'])->name('sector.index');
Route::post('sector', [SectorController::class, 'store'])->name('sector.store');
Route::put('sector/{id_sector}', [SectorController::class, 'update'])->name('sector.update');
Route::delete('sector/{id_sector}', [SectorController::class, 'destroy'])->name('sector.destroy');

// Employees
Route::get('employees', [EmployeesController::class, 'index'])->name('employees.index');
Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::put('employees/{id_employees}', [EmployeesController::class, 'update'])->name('employees.update');
Route::delete('employees/{id_employees}', [EmployeesController::class, 'destroy'])->name('employees.destroy');


Route::get('/register', function () {
    return view('auth/register', [
        'title' => 'Register'
    ]);
});



//sidebar untuk admin


Route::get('/a_subsector', function () {
    return view('a_subsector', [
        'title' => 'Clarity'
    ]);
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

