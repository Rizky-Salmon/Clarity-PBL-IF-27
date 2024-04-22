<?php

namespace Database\Seeders;


use App\Models\Employees;
use Illuminate\Auth\Console\seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data pengguna untuk disisipkan ke dalam tabel employees
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Employees',
                'email' => 'employees@gmail.com',
                'password' => bcrypt('employees'),
                'role' => 'employees'
            ],
        ];

        // Memeriksa dan menyisipkan data pengguna ke dalam tabel employees
        foreach ($userData as $user) {
            // Memeriksa apakah email sudah digunakan sebelumnya
            if (!Employees::where('email', $user['email'])->exists()) {
                // Menyisipkan data pengguna jika email belum digunakan
                Employees::create($user);
            }
        }
    }
}
