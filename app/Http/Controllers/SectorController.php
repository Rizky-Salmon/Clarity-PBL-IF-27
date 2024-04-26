<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    // Menampilkan semua kegiatan
    public function index()
    {
        $sector = Sector::all();
        return view('a_sector', compact('sector'));
    }

    // Menampilkan form untuk membuat sector baru
    public function create()
    {
        return view('a_sector');
    }

    // Menyimpan sector baru
    public function store(Request $request)
    {
        $request->validate([
            'sector_name' => 'required',
        ]);

        Sector::create($request->all());

        return redirect()->route('sector.index')
            ->with('success', 'Sector berhasil ditambahkan.');
    }

    // Menampilkan detail sector
    public function show(Sector $sector)
    {
        return view('a_sector.show', compact('sector'));
    }

    // Menampilkan form untuk mengedit sector
    public function edit(Sector $sector)
    {
        return view('a_sector.edit', compact('sector'));
    }

    // Menyimpan perubahan pada sector
    // Menyimpan perubahan pada sector
    public function update(Request $request, $id_sector)
    {
        $request->validate([
            'sector_name' => 'required',
        ]);

        $sector = Sector::findOrFail($id_sector); // Mengambil sector berdasarkan id_sector

        $sector->update([
            'sector_name' => $request->sector_name, // Memperbarui nama sector
        ]);

        return redirect()->route('sector.index')
            ->with('success', 'Sector berhasil diperbarui.');
    }



    // Menghapus sector
    public function destroy($id_sector)
    {
        $sector = Sector::findOrFail($id_sector);

        if ($sector->delete()) {
            return redirect()->route('sector.index')
                ->with(
                    'success',
                    'Sector deleted successfully.'
                );
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete sector.');
        }
    }

}
