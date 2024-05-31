<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisusalisasiController extends Controller
{
    function OverallActivity()
    {
        $datavisual = DB::select('SELECT activity.activity_name AS name, COUNT(activity_percentage.id_activity) AS value FROM  activity JOIN activity_percentage ON activity_percentage.id_activity = activity.id_activity GROUP BY activity_percentage.id_activity, activity.activity_name');
        $datavisual = json_encode($datavisual);

        return view('i_activity', [
            'title' => 'Clarity',
            'datavisual' => $datavisual,
        ]);
    }
}
