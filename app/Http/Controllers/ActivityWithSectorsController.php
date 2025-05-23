<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Sector;

class ActivityWithSectorsController extends Controller
{
    public function index()
    {
        // Ambil 1 activity dan ambil 3 sector pertama
        $activity = Activity::first(); // atau bisa gunakan find(1) jika mau ambil id tertentu
        $sectors = Sector::take(3)->get();

        return view('activity_with_sector', compact('activity', 'sectors'));
    }
}
