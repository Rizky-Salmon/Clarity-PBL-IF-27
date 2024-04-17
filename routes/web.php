<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Clarity'
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard_employee', [
        'title' => 'Clarity'
    ]);
});

Route::get('/register', function () {
    return view('register', [
        'title' => 'Register'
    ]);
});

Route::get('/login', function () {
    return view('login', [
        'title' => 'Login'
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
