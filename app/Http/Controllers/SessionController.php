<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
     function index()
    {
        return view('auth/login');
    }

     function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // ddd($infologin); // Tambahkan var_dump di sini

        if(Auth::attempt($infologin)) {
            if(auth()->user()->role == 'admin') {
                return redirect('admin');
            } elseif(auth()->user()->role == 'employees') {
                return redirect('employees');
            }
        } else {
            return redirect('')->withErrors('Email or Password is wrong.')->withInput();
        }
    }

    function logout()
    {
        auth::logout();
        return redirect('');
    }
}
