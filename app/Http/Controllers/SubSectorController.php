<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SubSectorController extends Controller
{
    public function index($id_sector = null)
    {
        $sector = Sector::all();

        $query = SubSector::query();

        // Jika ID sektor diberikan, maka tambahkan kriteria where
        if (Sector::find($id_sector)) {
            $query->where('id_sector', $id_sector);
        }

        // SubSector
        $subsectors = $query->with('sector')->get();

        if (request()->ajax()) {
            return DataTables::of($subsectors)
                ->addColumn('sector_name', function ($subsector) {
                    return $subsector->sector->sector_name;
                })
                ->addColumn('action', function ($item) {
                    return '
                        <div class="edit-subsector-buttons">
                            <a href="#" data-toggle="modal" data-target="#editSubsectorModal' . $item->id_subsector . '">
                                <button type="button" class="btn btn-success btn-sm my-1 mx-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#deleteSubsectorModal' . $item->id_subsector . '">
                                <button type="button" class="btn btn-danger btn-sm my-1 mx-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                        </div>

                        <div class="modal fade" id="editSubsectorModal' . $item->id_subsector . '" tabindex="-1" role="dialog" aria-labelledby="editSubsectorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSubsectorModalLabel">Update
                                                                Subsector</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="' . route('subsector.update', $item->id_subsector) . '" method="POST">
                                        ' . method_field("PUT") . csrf_field() . '

                                                                <input type="hidden" name="modalId" value="editSubsectorModal' . $item->id_subsector . '">
                                                                <input type="hidden" name="id_subsector" value="' . $item->id_subsector . '">
                                                                <input type="hidden" name="old_subsectorName" value="' . $item->subsector_name . '">

                                                                <div class="form-group">
                                                                    <label for="sectorName">Sector</label>
                                                                    <input type="text" class="form-control"id="sectorName" name="sectorName" value="' .  $item->sector->sector_name . '" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="subsectorName">Subsector</label>
                                                                    <input type="text" class="form-control" id="sectorName" name="sectorName" value="' . old('subsectorName', $item->subsector_name) . '">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="subsectorDescription">Description</label>
                                                                    <textarea class="form-control" id="subsectorDescription" rows="3" name="subsectorDescription">' . old('subsectorDescription', $item->description) . '</textarea>
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

                                                <div class="modal fade" id="deleteSubsectorModal' . $item->id_subsector . '" tabindex="-1" role="dialog" aria-labelledby="deleteSubsectorModalLabel' . $item->id_subsector . '" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Subsector</h5>
                                                            <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this subsector?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="' . route("subsector.destroy", $item->id_subsector) . '" method="POST">
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
            'add_subsectorName.required' => 'Subsector name is required',
            'add_description.required' => 'Description is required',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addSubsectorModal'])
                ->withInput($request->all());
        }

        $insert_data = [
            'id_sector' => $request->input('add_sectorName'),
            'subsector_name' => $request->input('add_subsectorName'),
            'description' => $request->input('add_description'),
        ];

        SubSector::create($insert_data);

        Alert::success('Success', 'Subsector added successfully!');
        return redirect()->route('ManageSubSector')->with('success', 'Subsector successfully added.');
    }



    public function show(SubSector $subsector)
    {
        return view('a_subsector.show', compact('subsector'));
    }

    public function edit(SubSector $subsector)
    {
        return view('a_subsector.edit', compact('subsector'));
    }

    public function update(Request $request, $id_subsector)
    {
        $rules = [
            'sector_name' => 'required',
            'subsector_name' => 'required',
            'description' => 'required',
        ];

        $customMessage = [
            'sector_name.required' => 'Sector name is required',
            'subsector_name.required' => 'Subsector name is required',
            'description.required' => 'Description is required',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $subsector = SubSector::findOrFail($id_subsector); // Mengambil subsector berdasarkan id_subsector

        $subsector->update([
            'id_sector' => $request->input('sector_name'), // Memperbarui id_sektor
            'subsector_name' => $request->input('subsector_name'), // Memperbarui nama subsector
            'description' => $request->input('description')
        ]);

        Alert::success(
            'Success',
            'Subsector updated successfully!'
        );

        return redirect()->route('subsector.index')->with('success', 'Subsector successfully updated.');
    }

    public function destroy($id_subsector)
    {
        $subsector = SubSector::findOrFail($id_subsector);

        Alert::success('Success', 'Subsector deleted successfully!');

        if ($subsector->delete()) {
            return redirect()->route('ManageSubSector')->with('success', 'Subsector deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete subsector.');
        }
    }
}
