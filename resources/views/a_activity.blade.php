@extends('layouts.admin')

@section('title', 'Manage Employee')

@push('head-script')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">
@endpush

@section('content')

    <!-- DataTables Activity -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div style="display: flex; align-items: center;">
                <img src="img/activity.png" style="height: 60px; width: 60px; margin-right: 10px;">
                <h3 style="margin-top: 10px; font-weight: bold; color: black;">Activities Data</h3>
            </div>
            <!--Add activity button-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
                <i class="fas fa-plus"></i> Add Activities
            </button>
            <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog"
                aria-labelledby="addActivityModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addActivityModalLabel">Add Activites</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('activity.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="activityName">Activities</label>
                                    <textarea class="form-control" id="activityName" name="activity_name" rows="3"
                                        placeholder="Enter The Activities Name" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorName1">Subsector 1</label>
                                    <input type="text" class="form-control" id="addSubsectorName"
                                        placeholder="Enter Subsector Name 1" required>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorName2">Subsector 2</label>
                                    <input type="text" class="form-control" id="addSubsectorName"
                                        placeholder="Enter Subsector Name 2" required>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorName3">Subsector 3</label>
                                    <input type="text" class="form-control" id="addSubsectorName"
                                        placeholder="Enter Subsector Name 3" required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add
                                    Activity</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Activities</th>
                            <th style="text-align: center;">Subsector 1</th>
                            <th style="text-align: center;">Subsector 2</th>
                            <th style="text-align: center;">Subsector 3</th>
                            <th style="text-align: center; width: 190px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($activity as $act)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $act->activity_name }}</td>
                                <th>
                                    <div class="edit-activity-buttons">
                                        <a href="#" data-toggle="modal" data-target="#editActivityModal">
                                            <button type="button" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="#" data-toggle="modal"
                                            data-target="#deleteActivityModal{{ $act->id_activity }}">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                </th>
                            </tr>

                            <!-- Edit Activity Modal -->
                            <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog"
                                aria-labelledby="editActivityModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editActivityModalLabel">Update
                                                Activities!</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('activity.update', $act->id_activity) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf

                                                <input type="hidden" name="activity_id" value="{{ $act->id_activity }}">
                                                <div class="form-group">
                                                    <label for="editActivityName">Activities</label>
                                                    <input type="text" class="form-control" id="editActivityName"
                                                        name="activity_name" value="{{ $act->activity_name }}">
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

                            <!-- Delete Activity Modal -->
                            <div class="modal fade" id="deleteActivityModal{{ $act->id_activity }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteActivityModalLabel{{ $act->id_activity }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteActivityModalLabel{{ $act->id_activity }}">
                                                Delete
                                                Activity</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this activity?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('activity.destroy', $act->id_activity) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('footer-script')
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>
@endpush
