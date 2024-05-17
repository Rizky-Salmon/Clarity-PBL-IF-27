<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    // Menampilkan semua kegiatan
    public function index()
    {
        $sector = Sector::all();
        $query = Sector::all();


        if (request()->ajax()) {


            return DataTables::of($query)

                ->addcolumn('subsector', function ($item) {
                    return $item->subSectors->count() . " Subsector" ?? 0 . " Subsector";
                })
                ->addcolumn('action', function ($item) {
                    return '
                        <div class="edit-sector-buttons">
                            <a href="#" data-toggle="modal" data-target="#editSectorModal' . $item->id_sector . '">
                                <button type="button" class="btn btn-success btn-sm my-1 mx-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#deleteSectorModal' . $item->id_sector . '">
                                <button type="button" class="btn btn-danger btn-sm my-1 mx-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>


                            <a href="' . route('ManageSubSector', $item->id_sector) . '">
                            <button type="button" class="btn btn-secondary btn-sm my-1 mx-1">
                                Manage SubSector
                            </button>
                        </a>
                        </div>

                        <div class="modal fade" id="editSectorModal' . $item->id_sector . '" tabindex="-1" role="dialog" aria-labelledby="editSectorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSectorModalLabel">Update
                                                                Sector</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="' . route('sector.update', $item->id_sector) . '" method="POST">
                                        ' . method_field("PUT") . csrf_field() . '

                                                                <input type="hidden" name="modalId" value="editSectorModal' . $item->id_sector . '">

                                                                <input type="hidden" name="id_sector" value="' . $item->id_sector . '">
                                                                <input type="hidden" name="old_sectorName" value="' . $item->sector_name . '">
                                                                <div class="form-group">
                                                                    <label for="sectorName">Sector</label>
                                                                    <input type="text" class="form-control"id="sectorName" name="sectorName" value="' . old('sectorName', $item->sector_name) . '">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="margin-left: 140px;">Save Changes</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>

                        <div class="modal fade" id="deleteSectorModal' . $item->id_sector . '" tabindex="-1" role="dialog" aria-labelledby="deleteSectorModalLabel' . $item->id_sector . '" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Sector</h5>
                                                            <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this sector?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="' . route("sector.destroy", $item->id_sector) . '" method="POST">
                                ' . csrf_field() . method_field("DELETE") . '
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

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
        $rules = [
            'add_sectorName' => 'required|unique',
        ];

        $customMessage = [
            'add_sectorName.required' => 'Sector name is required',
            'add_sectorName.unique' => 'Sector name has already been used',
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
    public function update(Request $request, $id_sector)
    {
        $rules = [
            'sector_name' => 'required',
        ];

        $customMessage = [
            'sector_name.required' => 'Sector name is required',
        ];

        $sector = Sector::where('id_sector', $id_sector); // Mengambil sector berdasarkan id_sector

        $sector->update([
            'sector_name' => $request->sectorName, // Memperbarui nama sector
        ]);

        Alert::success(
            'Success',
            'Sector updated successfully!'
        );

        return redirect()->route('sector.index')
            ->with('success', 'Sector successfully updated.');
    }

    // Menghapus sector
    public function destroy($id_sector)
    {
        $sector = Sector::findOrFail($id_sector);

        Alert::success('Success', 'Sector deleted successfully!');

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
