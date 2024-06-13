<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    // Menampilkan formulir registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat pengguna baru di tabel employees
        $employee = Employees::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employees', // Default role as 'employees'
        ]);


        // Menampilkan pesan sukses
        Alert::success('Success', 'Akun Anda telah dibuat!');

        // Mengarahkan ke halaman yang diinginkan
        return redirect()->route('login'); // Ganti 'dashboard' dengan rute yang diinginkan
    }
}
