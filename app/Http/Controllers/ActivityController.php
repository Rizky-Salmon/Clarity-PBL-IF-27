<?php

namespace App\Http\Controllers;

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
        $subsectors = SubSector::all();

        // Inisialisasi query untuk Activity dengan mengambil relasi subsector
        $query = Activity::with('subsectors');

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
                ->addColumn('subsector_name', function ($activity) {
                    // Memeriksa apakah ada subsector terkait dan mengambil nama subsector
                    return $activity->subsectors->isNotEmpty() ? $activity->subsectors->implode('subsector_name', ', ') : '-';
                })
            ->addColumn('action', function ($item) {
                return '
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
            })
                ->rawColumns(['action'])
                ->make();
        }

        // Mengembalikan view dengan data subsectors dan activities
        return view('a_activity', [
            'activity' => $activities,
            'subsector' => $subsectors,
            'selectedSubsector' => $id_subsector,
        ]);
    }



    // Menyimpan data kegiatan baru
    public function store(Request $request)
    {
        $rules = [
            'add_activityName' => 'required',
            'subsector_ids' => 'required|array',
            'subsector_ids.*' => 'exists:subsector,id_subsector', // Sesuaikan dengan nama tabel yang benar
        ];

        $customMessage = [
            'add_activityName.required' => 'Activity name is required',
            'subsector_ids.required' => 'Subsector are required',
            'subsector_ids.*.exists' => 'Subsector does not exist',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['openModal' => 'addActivityModal'])
                ->withInput($request->all());
        }


        $activity = Activity::create([
            'activity_name' => $request->input('add_activityName'),
        ]);

        $activity->subsectors()->attach($request->input('subsector_ids')); // Menggunakan attach untuk menyimpan relasi

        Alert::success('Success', 'Activity added successfully!');
        return redirect()->route('ManageActivity')->with('success', 'Activity successfully added.');
    }

    // Menyimpan perubahan pada kegiatan
    public function update(Request $request, $id_activity)
    {
        $rules = [
            'activity_name' => 'required',
            'subsector_ids' => 'required|array',
            'subsector_ids.*' => 'exists:subsectors,id_subsector',
        ];

        $customMessage = [
            'activity_name.required' => 'Activity name is required',
            'subsector_ids.required' => 'Subsectors are required',
            'subsector_ids.*.exists' => 'Subsector does not exist',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $activity = Activity::findOrFail($id_activity);
        $activity->update([
            'activity_name' => $request->input('activity_name'),
        ]);

        $activity->subsectors()->sync($request->input('subsector_ids')); // Menggunakan sync untuk menyimpan relasi

        Alert::success('Success', 'Activity updated successfully!');
        return redirect()->route('activity.index')->with('success', 'Activity successfully updated.');
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

