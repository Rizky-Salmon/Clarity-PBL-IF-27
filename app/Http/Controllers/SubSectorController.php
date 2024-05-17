<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

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


    public function store(Request $request)
    {
        $rules = [
            'add_sectorName' => 'required|exists:sector,id_sector',
            'add_subsectorName' => 'required',
            'add_description' => 'required',
        ];

        $customMessage = [
            'add_sectorName.required' => 'Sector name is required',
            'add_sectorName.exists' => 'Sector name does not exist',
            'add_subsectorName.required' => 'Sector name has already been used',
            'add_description.required' => 'Description is required',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addSectorModal'])
                ->withInput($request->all());
        }

        $insert_data = [
            'sector_name' => $request->input('add_sectorName'),
        ];

        Sector::create($insert_data);

        Alert::success('Success', 'Sector added successfully!');
        return redirect()->route('sector.index')
        ->with('success', 'Sector successfully added.');
    }
}
