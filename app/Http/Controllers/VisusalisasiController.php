<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisusalisasiController extends Controller
{
    // Visulasasi Overall Activity
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

    // Visualisasi Activity Percentage
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

    // Visualisasi Employee
    public function EmployeeActivity()
    {
        $datavisual = DB::select('SELECT activity.activity_name AS aktivitas,
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

        return view('i_employee', [
            'datavisual' => json_encode($datavisualArray),
        ]);
    }

    // Visualisasi Sektor
    public function Sector()
    {
        $datavisual = DB::select('SELECT
        subsector.subsector_name AS subsector,
        subsector.description AS deskripsi,
        sector.sector_name AS sector
        FROM subsector
        JOIN sector ON subsector.id_sector = sector.id_sector;');

        // Mengonversi data menjadi array asosiatif
        $datavisualArray = [];
        foreach ($datavisual as $data) {
            $datavisualArray[] = [
                'sector' => $data->sector,
                'deskripsi' => $data->deskripsi,
                'subsector' => $data->subsector,
                'value' => 70// Contoh nilai, sesuaikan dengan kebutuhan Anda
            ];
        }

        return view('i_sector', [
            'datavisual' => json_encode($datavisualArray),
        ]);
    }
}
