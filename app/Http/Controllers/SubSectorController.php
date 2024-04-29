<?php

namespace App\Http\Controllers;

use App\Models\SubSector;
use Illuminate\Http\Request;

class SubSectorController extends Controller
{
    public function index( $id_sector = null ) {

        if ( $id_sector ) {
            $query = SubSector::where('id_sector', $id_sector);
        } else {
            $query = SubSector::all();
        }


        if ( request()->ajax() ) {

        }

        return view('a_subsector', [
            'title' => 'Clarity'
        ]);

    }
}
