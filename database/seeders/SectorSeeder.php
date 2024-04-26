<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Sector::insert([
            ['sector_name' => 'mobilité'],
            ['sector_name' => 'pilotage'],
            ['sector_name' => 'finance'],
            ['sector_name' => 'internationalisation'],
            ['sector_name' => 'projet'],
            ['sector_name' => 'contractualisation'],
        ]);
    }
}
