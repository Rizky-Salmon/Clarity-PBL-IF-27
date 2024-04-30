<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Http\Request;

class SubSectorController extends Controller
{
    public function index($id_sector = null)
    {

        $sector = Sector::all();

        $query = SubSector::query();

        // Jika ID sektor diberikan, maka tambahkan kriteria where
        if ($sector->find($id_sector)) {
            $query->where('id_sector', $id_sector);
        }

        // SubSector
        $subsectors = $query->with('sectorData')->get();

        return view('a_subsector', [
            'subsector' => $subsectors,
            'sector' => $sector,
            'selectedSector' => $id_sector,
        ]);
    }
}
