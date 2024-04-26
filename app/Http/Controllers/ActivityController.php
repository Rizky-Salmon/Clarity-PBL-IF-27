<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // Menampilkan semua kegiatan
    public function index()
    {
        $activity = Activity::all();
        return view('a_activity', compact('activity'));
    }


    // Menampilkan form untuk membuat kegiatan baru
    public function create()
    {
        return view('a_activity');
    }

    // Menyimpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
        ]);

        Activity::create($request->all());

        return redirect()->route('activity.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // Menampilkan detail kegiatan
    public function show(Activity $activity)
    {
        return view('a_activity.show', compact('activity'));
    }

    // Menampilkan form untuk mengedit kegiatan
    public function edit(Activity $activity)
    {
        return view('a_activity.edit', compact('activity'));
    }

    // Menyimpan perubahan pada kegiatan
    // Menyimpan perubahan pada kegiatan
    public function update(Request $request, $id_activity)
    {
        $request->validate([
            'activity_name' => 'required',
        ]);

        $activity = Activity::findOrFail($id_activity); // Mengambil aktivitas berdasarkan id_activity

        $activity->update([
            'activity_name' => $request->activity_name, // Memperbarui nama aktivitas
        ]);

        return redirect()->route('activity.index')
        ->with('success', 'Kegiatan berhasil diperbarui.');
    }



    // Menghapus kegiatan
    public function destroy($id_activity)
    {
        $activity = Activity::findOrFail($id_activity);

        if ($activity->delete()) {
            return redirect()->route('activity.index')
            ->with('success',
                'Activity deleted successfully.'
            );
        } else {
            return redirect()->back()
            ->with('error', 'Failed to delete activity.');
        }
    }


}
