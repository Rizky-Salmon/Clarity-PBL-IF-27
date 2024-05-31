<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisusalisasiController extends Controller
{
    function OverallActivity()
    {
        $datavisual = DB::select('SELECT activity.activity_name AS name,
        COUNT(activity_percentage.id_activity) AS value FROM  activity
        JOIN activity_percentage ON activity_percentage.id_activity = activity.id_activity
        GROUP BY activity_percentage.id_activity, activity.activity_name');
        $datavisual = json_encode($datavisual);

        return view('i_activity', [
            'datavisual' => $datavisual,
        ]);
    }

    public function ActivityPercentage()
    {
        $datavisual = DB::select('SELECT activity.activity_name AS aktivitas ,
    employees.name AS name,
    activity_percentage.percentage as value
    FROM activity_percentage
    JOIN activity ON activity.id_activity = activity_percentage.id_activity
    JOIN employees ON employees.id_employees = activity_percentage.id_employees');

        // Mengonversi data menjadi array asosiatif
        $datavisualArray = [];
        foreach ($datavisual as $data) {
            $datavisualArray[] = [
                'name' => $data->name,
                'aktivitas' => $data->aktivitas,
                'value' => $data->value
            ];
        }

        return view('i_percentage', [
            'datavisual' => json_encode($datavisualArray),
        ]);
    }
}
