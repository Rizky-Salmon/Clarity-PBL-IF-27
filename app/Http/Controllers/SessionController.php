<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        ], [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($infologin, $remember)) {
            if (auth()->user()->role == 'admin') {
                Alert::success('Success', 'Welcome to Clarity !');
                return redirect('admin');
            } elseif (auth()->user()->role == 'employees') {
                Alert::success('Success', 'Welcome to Clarity !');
                return redirect('employee');
            } elseif (auth()->user()->role == 'assistant') {
                Alert::success('Success', 'Welcome to Clarity !');
                return redirect('employee');
            }
        } else {
            return redirect()->back()->withErrors(['password' => 'Password did not match our records.'])->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        Alert::success('Success', 'Logout Success !');
        return redirect('');
    }
}
