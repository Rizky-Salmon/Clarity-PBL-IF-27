<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Activity;
use App\Models\SubSector;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class ActivityController extends Controller
{
    public function index($id_subsector = null)
    {
        // Mengambil semua data SubSector
        $sectors = Sector::with('subSectors')->get();
        $subsectors = SubSector::all();

        // Inisialisasi query untuk Activity dengan mengambil relasi subsector
        $query = Activity::with(['subsectors' => function ($query) {
            $query->orderBy('priority');
        }]);

        // Jika ID subsector diberikan dan valid, tambahkan kriteria where
        if ($id_subsector && SubSector::find($id_subsector)) {
            $query->whereHas('subsectors', function ($query) use ($id_subsector) {
                $query->where('id_subsector', $id_subsector);
            });
        }

        // Mengambil data Activity beserta relasi SubSector
        $activities = $query->get();

        // Menangani permintaan AJAX untuk DataTables
        if (request()->ajax()) {
            return DataTables::of($activities)
                ->addColumn('subsector_name1', function ($activity) {
                    return $activity->subsectors->isNotEmpty() ? $activity->subsectors->get(0)->subsector_name : '-';
                })
                ->addColumn('subsector_name2', function ($activity) {
                    return $activity->subsectors->count() > 1 ? $activity->subsectors->get(1)->subsector_name : '-';
                })
                ->addColumn('subsector_name3', function ($activity) {
                    return $activity->subsectors->count() > 2 ? $activity->subsectors->get(2)->subsector_name : '-';
                })
                ->addColumn('action', function ($item) use ($subsectors, $sectors) {
                    $subsector1Selected = $item->subsectors->isNotEmpty() ? $item->subsectors->get(0) : null;
                    $subsector2Selected = $item->subsectors->count() > 1 ? $item->subsectors->get(1) : null;
                    $subsector3Selected = $item->subsectors->count() > 2 ? $item->subsectors->get(2) : null;

                    $html = '
                    <div class="edit-activity-buttons">
                        <a href="#" data-toggle="modal" data-target="#editActivityModal' . $item->id_activity . '">
                            <button type="button" class="btn btn-success btn-sm my-1 mx-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#deleteActivityModal' . $item->id_activity . '">
                            <button type="button" class="btn btn-danger btn-sm my-1 mx-1">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </a>
                    </div>
                    <div class="modal fade" id="editActivityModal' . $item->id_activity . '" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel' . $item->id_activity . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editActivityModalLabel' . $item->id_activity . '">Update Activities</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="' . route('activity.update', $item->id_activity) . '" method="POST">
                                        ' . method_field('PUT') . csrf_field() . '
                                        <input type="hidden" name="id_activity" value="' . $item->id_activity . '">
                                        <div class="form-group">
                                            <label for="editActivityName">Activity Name</label>
                                            <input type="text" class="form-control" id="editActivityName" name="activity_name" value="' . old('activity_name', $item->activity_name) . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="editSubsector1">Subsector 1</label>
                                            <select name="subsector_id1" class="form-control subsector-dropdown" id="editSubsector1">
                                                <option value="">- Choose Subsector -</option>';
                    foreach ($sectors as $sector) {
                        $html .= '<optgroup label="Sector: ' . $sector->sector_name . '">';
                        foreach ($sector->subSectors as $subsector) {
                            $selected = ($subsector1Selected && $subsector1Selected->id_subsector == $subsector->id_subsector) ? 'selected' : '';
                            $html .= '<option value="' . $subsector->id_subsector . '" ' . $selected . '>' . $subsector->subsector_name . '</option>';
                        }
                        $html .= '</optgroup>';
                    }
                    $html .= '
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editSubsector2">Subsector 2</label>
                                            <select name="subsector_id2" class="form-control subsector-dropdown" id="editSubsector2">
                                                <option value="">- Choose Subsector -</option>';
                    foreach ($sectors as $sector) {
                        $html .= '<optgroup label="Sector: ' . $sector->sector_name . '">';
                        foreach ($sector->subSectors as $subsector) {
                            $selected = ($subsector2Selected && $subsector2Selected->id_subsector == $subsector->id_subsector) ? 'selected' : '';
                            $html .= '<option value="' . $subsector->id_subsector . '" ' . $selected . '>' . $subsector->subsector_name . '</option>';
                        }
                        $html .= '</optgroup>';
                    }
                    $html .= '
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editSubsector3">Subsector 3</label>
                                            <select name="subsector_id3" class="form-control subsector-dropdown" id="editSubsector3">
                                                <option value="">- Choose Subsector -</option>';
                    foreach ($sectors as $sector) {
                        $html .= '<optgroup label="Sector: ' . $sector->sector_name . '">';
                        foreach ($sector->subSectors as $subsector) {
                            $selected = ($subsector3Selected && $subsector3Selected->id_subsector == $subsector->id_subsector) ? 'selected' : '';
                            $html .= '<option value="' . $subsector->id_subsector . '" ' . $selected . '>' . $subsector->subsector_name . '</option>';
                        }
                        $html .= '</optgroup>';
                    }
                    $html .= '
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteActivityModal' . $item->id_activity . '" tabindex="-1" role="dialog" aria-labelledby="deleteActivityModalLabel' . $item->id_activity . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteActivityModalLabel' . $item->id_activity . '">Delete Activity</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this activity?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="' . route('activity.destroy', $item->id_activity) . '" method="POST">
                                        ' . csrf_field() . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';

                    return $html;
                })
                ->rawColumns(['subsector_name1', 'subsector_name2', 'subsector_name3', 'action'])
                ->make(true);
        }

        // Mengembalikan view dengan data subsectors dan activities
        return view('a_activity', [
            'activity' => $activities,
            'sectors' => $sectors,
            'subsector' => $subsectors,
            'selectedSubsector' => $id_subsector,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'add_activityName' => 'required',
            'subsector_id1' => 'required|exists:subsector,id_subsector',
            'subsector_id2' => 'nullable|exists:subsector,id_subsector',
            'subsector_id3' => 'nullable|exists:subsector,id_subsector',
        ];

        $customMessages = [
            'add_activityName.required' => 'Activity name is required',
            'subsector_id1.required' => 'Subsector 1 is required',
            'subsector_id1.exists' => 'Subsector 1 does not exist',
            'subsector_id2.exists' => 'Subsector 2 does not exist',
            'subsector_id3.exists' => 'Subsector 3 does not exist',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addActivityModal'])
                ->withInput($request->all());
        }

        $activity = Activity::create([
            'activity_name' => $request->input('add_activityName'),
        ]);

        // Menyimpan relasi subsektor
        $subsectors = array_filter([
            $request->input('subsector_id1'),
            $request->input('subsector_id2'),
            $request->input('subsector_id3')
        ]);

        $activity->subsectors()->attach($subsectors);

        Alert::success('Success', 'Activity added successfully!');
        return redirect()->route('ManageActivity')->with('success', 'Activity successfully added.');
    }

    public function update(Request $request, $id_activity)
    {
        $rules = [
            'activity_name' => 'required',
            'subsector_id1' => 'nullable|exists:subsector,id_subsector',
            'subsector_id2' => 'nullable|exists:subsector,id_subsector',
            'subsector_id3' => 'nullable|exists:subsector,id_subsector',
        ];

        $customMessages = [
            'activity_name.required' => 'Activity name is required',
            'subsector_id1.exists' => 'Subsector 1 does not exist',
            'subsector_id2.exists' => 'Subsector 2 does not exist',
            'subsector_id3.exists' => 'Subsector 3 does not exist',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $activity = Activity::findOrFail($id_activity);
        $activity->update([
            'activity_name' => $request->input('activity_name'),
        ]);

        // Menyimpan relasi subsektor
        $subsectors = array_filter([
            $request->input('subsector_id1'),
            $request->input('subsector_id2'),
            $request->input('subsector_id3')
        ]);

        // Menghapus relasi subsektor sebelumnya
        $activity->subsectors()->detach();

        // Menyimpan relasi subsektor baru dengan prioritas
        if ($request->has('subsector_id1')) {
            $activity->subsectors()->attach($request->input('subsector_id1'), ['priority' => 1]);
        }
        if ($request->has('subsector_id2')) {
            $activity->subsectors()->attach($request->input('subsector_id2'), ['priority' => 2]);
        }
        if ($request->has('subsector_id3')) {
            $activity->subsectors()->attach($request->input('subsector_id3'), ['priority' => 3]);
        }

        Alert::success('Success', 'Activity updated successfully!');
        return redirect()->route('ManageActivity')->with('success', 'Activity successfully updated.');
    }



    // Menampilkan detail kegiatan
    public function show(Activity $activity)
    {
        return view('a_activity.show', compact('activity'));
    }

    // Menampilkan form untuk mengedit kegiatan
    public function edit(Activity $activity)
    {
        $subsectors = SubSector::all();
        return view('a_activity.edit', compact('activity', 'subsectors'));
    }

    // Menghapus kegiatan
    public function destroy($id_activity)
    {
        $activity = Activity::findOrFail($id_activity);

        if ($activity->delete()) {
            Alert::success('Success', 'Activity deleted successfully!');
            return redirect()->route('ManageActivity')->with('success', 'Activity deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete activity.');
        }
    }
}
