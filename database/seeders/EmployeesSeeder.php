<?php

namespace Database\Seeders;


use App\Models\Employees;
use Illuminate\Auth\Console\seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
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
            [
                'name' => 'BRINDLE',
                'email' => 'brindle@example.com',
                'password' => bcrypt('brindlepassword'),
                'role' => 'employees'
            ],
            [
                'name' => 'PLACE',
                'email' => 'place@example.com',
                'password' => bcrypt('placepassword'),
                'role' => 'employees'
            ],
            [
                'name' => 'PRUVOST',
                'email' => 'pruvost@example.com',
                'password' => bcrypt('pruvostpassword'),
                'role' => 'employees'
            ],
            [
                'name' => 'CAULIEZ',
                'email' => 'cauliez@example.com',
                'password' => bcrypt('cauliezpassword'),
                'role' => 'employees'
            ],
            [
                'name' => 'LE MEUR',
                'email' => 'lemur@example.com',
                'password' => bcrypt('lemurpassword'),
                'role' => 'employees'
            ],
            [
                'name' => 'DEGAUGUE',
                'email' => 'degaugue@example.com',
                'password' => bcrypt('degauguepassword'),
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
