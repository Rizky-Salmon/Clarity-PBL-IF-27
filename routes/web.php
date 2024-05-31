<?php

use App\Models\Sector;
use App\Models\Employees;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SubSectorController;
use App\Http\Controllers\ActivityPercentageController;
use App\Http\Controllers\VisusalisasiController;

// Akses Tanpa Login
Route::middleware('guest')->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});


// Harus Login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [SessionController::class, 'logout']);

    Route::get('/employee', [AdminController::class, 'employees']);

    Route::get('/admin', [AdminController::class, 'index']);

    // Dashboard Admin
    Route::post('/update-name/{id_employee}', [AdminController::class, 'updateName'])->name('update.name');
    Route::post('/update-email/{id_employee}', [AdminController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password/{id_employee}', [AdminController::class, 'updatePassword'])->name('update.password');

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
    Route::post('subsector', [SubSectorController::class, 'store'])->name('subsector.store');
    Route::put('subsector/{id_subsector}', [SubSectorController::class, 'update'])->name('subsector.update');
    Route::delete('subsector/{id_subsector}', [SubSectorController::class, 'destroy'])->name('subsector.destroy');


    // Manage Activity
    Route::get('activity', [ActivityController::class, 'index'])->name('ManageActivity');
    Route::post('activity', [ActivityController::class, 'store'])->name('activity.store');
    Route::put('activity/{id_activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('activity/{id_activity}', [ActivityController::class, 'destroy'])->name('activity.destroy');

    // Manage Activity Percentage
    Route::get('/a_percentage/{id_activity_percentage?}', [ActivityPercentageController::class, 'index'])->name('ManagePercentage');
    Route::post('activity_percentage', [ActivityPercentageController::class, 'store'])->name('activity_percentage.store');
    Route::put('activity_percentage/{id_activity_percentage}', [ActivityPercentageController::class, 'update'])->name('activity_percentage.update');
    Route::delete('activity_percentage/{id_activity_percentage}', [ActivityPercentageController::class, 'destroy'])->name('activity_percentage.destroy');

});




// Navbar untuk Interaktif visualisasi dan employee

Route::get('/i_percentage', function () {
    return view('i_percentage', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_activity', [VisusalisasiController::class, 'OverallActivity']);

Route::get('/i_employee', function () {
    return view('i_employee', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_sector', function () {
    return view('i_sector', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_subsector', function () {
    return view('i_subsector', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_MaxEmployee', function () {
    return view('i_MaxEmployee', [
        'title' => 'Clarity'
    ]);
});

Route::get('/i_MinEmployee', function () {
    return view('i_MinEmployee', [
        'title' => 'Clarity'
    ]);
});

// profile
Route::get('/profile', function () {
    return view('profile', [
        'title' => 'Clarity'
    ]);
});
