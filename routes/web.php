<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [SessionController::class, 'index']);
    Route::post('/', [SessionController::class, 'login']);
});



    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('employees', [AdminController::class, 'employees']);
    Route::get('/logout', [SessionController::class, 'logout']);



Route::get('/register', function () {
    return view('auth/register', [
        'title' => 'Register'
    ]);
});



//sidebar untuk admin
Route::get('/a_activity', function () {
    return view('a_activity', [
        'title' => 'Clarity'
    ]);
});

Route::get('/a_employee', function () {
    return view('a_employee', [
        'title' => 'Clarity'
    ]);
});

Route::get('/a_sector', function () {
    return view('a_sector', [
        'title' => 'Clarity'
    ]);
});

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

