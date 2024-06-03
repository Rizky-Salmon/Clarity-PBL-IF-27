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
                'value' => 30 // Contoh nilai, sesuaikan dengan kebutuhan Anda
            ];
        }

        return view('i_sector', [
            'datavisual' => json_encode($datavisualArray),
        ]);
    }

    public function SubSector()
    {
        $datavisual = DB::select('SELECT
        activity.activity_name AS activity,
        subsector.subsector_name AS subsector
        FROM activity_subsector
        JOIN activity ON activity_subsector.id_activity = activity.id_activity
        JOIN subsector ON activity_subsector.id_subsector = subsector.id_subsector');

        // Mengonversi data menjadi array asosiatif
        $datavisualArray = [];
        foreach ($datavisual as $data) {
            $datavisualArray[] = [
                'activity' => $data->activity,
                'subsector' => $data->subsector,
                'value' => 70 // Contoh nilai, sesuaikan dengan kebutuhan Anda
            ];
        }

        return view('i_subsector', [
            'datavisual' => json_encode($datavisualArray),
        ]);
    }

    public function MinEmployee()
    {
        $activityCounts = DB::select('SELECT activity.activity_name AS activity, employees.name AS name, COUNT(employees.id_employees) AS employee_count
FROM activity_percentage
JOIN activity ON activity.id_activity = activity_percentage.id_activity
JOIN employees ON employees.id_employees = activity_percentage.id_employees
WHERE activity_percentage.id_activity IN (
    SELECT id_activity
    FROM activity_percentage
    GROUP BY id_activity
    HAVING COUNT(id_employees) = (
        SELECT COUNT(id_employees) AS min_employee_count
        FROM activity_percentage
        GROUP BY id_activity
        ORDER BY min_employee_count ASC
        LIMIT 1
    )
)
GROUP BY activity.activity_name, employees.name;
');

        // Menentukan jumlah karyawan paling sedikit
        $minEmployeeCount = $activityCounts[0]->employee_count;

        // Mengambil semua aktivitas yang memiliki jumlah karyawan paling sedikit
        $minEmployeeActivities = [];
        foreach ($activityCounts as $activityCount) {
            if ($activityCount->employee_count == $minEmployeeCount) {
                $minEmployeeActivities[] = $activityCount->activity;
            } // Tidak ada else di sini, biarkan loop terus berjalan untuk menangani aktivitas dengan jumlah karyawan yang sama
        }

        return view('i_MinEmployee', [
            'activities' => json_encode($minEmployeeActivities),
            'activityData' => json_encode($activityCounts), // Mengirimkan data aktivitas lengkap, termasuk nama karyawan, ke tampilan
        ]);
    }


    public function MaxEmployee()
    {
        $activityCounts = DB::select('SELECT activity.activity_name AS activity, employees.name AS name, COUNT(employees.id_employees) AS employee_count
        FROM activity_percentage
        JOIN activity ON activity.id_activity = activity_percentage.id_activity
        JOIN employees ON employees.id_employees = activity_percentage.id_employees
        WHERE activity_percentage.id_activity IN (
            SELECT id_activity
            FROM activity_percentage
            GROUP BY id_activity
            HAVING COUNT(id_employees) = (
                SELECT COUNT(id_employees) AS max_employee_count
                FROM activity_percentage
                GROUP BY id_activity
                ORDER BY max_employee_count DESC
                LIMIT 1
            )
        )
        GROUP BY activity.activity_name, employees.name;');

        // Menentukan jumlah karyawan paling banyak
        $maxEmployeeCount = $activityCounts[0]->employee_count;

        // Mengambil semua aktivitas yang memiliki jumlah karyawan paling banyak
        $maxEmployeeActivities = [];
        foreach ($activityCounts as $activityCount) {
            if ($activityCount->employee_count == $maxEmployeeCount) {
                $maxEmployeeActivities[] = $activityCount->activity;
            } // Tidak ada else di sini, biarkan loop terus berjalan untuk menangani aktivitas dengan jumlah karyawan yang sama
        }

        return view('i_MaxEmployee', [
            'activities' => json_encode($maxEmployeeActivities),
            'activityData' => json_encode($activityCounts), // Mengirimkan data aktivitas lengkap, termasuk nama karyawan, ke tampilan
        ]);
    }
}
