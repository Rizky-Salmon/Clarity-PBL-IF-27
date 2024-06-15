<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisusalisasiController extends Controller
{
    // Visulasasi Overall Activity
    public function OverallActivity()
    {
        $datavisual = DB::select('SELECT activity.activity_name AS activity_name,
                                   GROUP_CONCAT(employees.name SEPARATOR ", ") AS employee_names,
                                   COUNT(activity_percentage.id_activity) AS value
                              FROM activity
                              JOIN activity_percentage ON activity_percentage.id_activity = activity.id_activity
                              JOIN employees ON activity_percentage.id_employees = employees.id_employees
                              GROUP BY activity.activity_name');

        // Mengonversi data menjadi array asosiatif
        $datavisualArray = [];
        $activityNames = [];
        foreach ($datavisual as $data) {
            $datavisualArray[] = [
                'activity_name' => $data->activity_name,
                'employee_names' => $data->employee_names,
                'value' => $data->value
            ];
            $activityNames[] = ['activity_name' => $data->activity_name];
        }

        return view('i_activity', [
            'datavisual' => json_encode($datavisualArray),
            'activities' => $activityNames,
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
        sector.sector_name AS sector,
        GROUP_CONCAT(CONCAT("[", subsector.subsector_name, "]") ORDER BY subsector.subsector_name SEPARATOR ", ") AS subsector,
        GROUP_CONCAT(CONCAT("[", subsector.description, "]") ORDER BY subsector.subsector_name SEPARATOR ", ") AS deskripsi,
        subquery.total_subsectors
    FROM subsector
    JOIN sector ON subsector.id_sector = sector.id_sector
    JOIN (
        SELECT
            subsector.id_sector,
            COUNT(subsector.id_subsector) AS total_subsectors
        FROM subsector
        GROUP BY subsector.id_sector
    ) AS subquery ON subsector.id_sector = subquery.id_sector
    GROUP BY sector.sector_name, subquery.total_subsectors
    ORDER BY sector.sector_name;');

        // Mengambil nama sektor untuk dropdown
        $sectors = DB::table('sector')->select('sector_name')->orderBy('sector_name')->get();

        // Mengonversi data menjadi array asosiatif
        $datavisualArray = [];
        foreach ($datavisual as $data) {
            $datavisualArray[] = [
                'sector' => $data->sector,
                'subsector' => $data->subsector,
                'deskripsi' => $data->deskripsi,
                'total_subsectors' => $data->total_subsectors
            ];
        }

        return view('i_sector', [
            'datavisual' => json_encode($datavisualArray),
            'sectors' => $sectors
        ]);
    }

    public function SubSector()
    {
        $query = 'SELECT
        subsector_info.id_subsector,
        subsector_info.subsector_name,
        subsector_info.total_activities,
        activity_info.activity_name AS aktivitas,
        activity_info.total_percentage,
        activity_info.employees_involvement
    FROM
        (
            SELECT
                s.id_subsector,
                s.subsector_name,
                COUNT(DISTINCT acs.id_activity) AS total_activities
            FROM
                subsector s
            JOIN
                activity_subsector acs ON s.id_subsector = acs.id_subsector
            GROUP BY
                s.id_subsector, s.subsector_name
        ) AS subsector_info
    JOIN
        (
            SELECT
                s.id_subsector,
                a.activity_name,
                SUM(ap.percentage) AS total_percentage,
                GROUP_CONCAT(DISTINCT CONCAT(e.name, " (", ap.percentage, "%)") ORDER BY e.name ASC SEPARATOR ", ") AS employees_involvement
            FROM
                subsector s
            JOIN
                activity_subsector acs ON s.id_subsector = acs.id_subsector
            JOIN
                activity a ON acs.id_activity = a.id_activity
            JOIN
                activity_percentage ap ON a.id_activity = ap.id_activity
            JOIN
                employees e ON ap.id_employees = e.id_employees
            GROUP BY
                s.id_subsector, a.activity_name
        ) AS activity_info
    ON
        subsector_info.id_subsector = activity_info.id_subsector
    ORDER BY
        subsector_info.id_subsector, activity_info.activity_name';

        $datavisual = DB::select($query);

        return view('i_subsector', [
            'datavisual' => json_encode($datavisual),
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
