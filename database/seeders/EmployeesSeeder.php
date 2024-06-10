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
                'name' => 'BRINDLE',
                'email' => 'brindle@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'PLACE',
                'email' => 'place@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'PRUVOST',
                'email' => 'pruvost@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'CAULIEZ',
                'email' => 'cauliez@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'LE MEUR',
                'email' => 'lemur@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'DEGAUGUE',
                'email' => 'degaugue@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'MILLER',
                'email' => 'miller@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'GARCON',
                'email' => 'garcon@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'DUCAMP',
                'email' => 'ducamp@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'QUIROGA',
                'email' => 'quiroga@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'PREVEL',
                'email' => 'prevel@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'LEGALLIC',
                'email' => 'legallic@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'DRELLON',
                'email' => 'drellon@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ],
            [
                'name' => 'TAMPERE',
                'email' => 'tampere@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'employees'
            ]
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
