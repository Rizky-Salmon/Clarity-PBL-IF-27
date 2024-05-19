@extends('layouts.admin')

@section('title', 'Manage Sector')

@push('head-script')
<!-- Custom styles for this page -->
<link href="\vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- CSS DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">

@endpush

@section('content')
                    <!-- DataTales Activity Percentage -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <div style="display: flex; align-items: center;">
                                <img src="img/activity.png" style="height: 60px; width: 60px; margin-right: 10px;">
                                <h3 style="margin-top: 10px; font-weight: bold; color: black;">My Activity</h3>
                            </div>
                            <!--Add activity button-->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
                                <i class="fas fa-plus"></i> Add Activity Percentage
                            </button>
                            <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="activityName">Activities</label>
                                                    <input type="text" class="form-control" id="activityName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="activityEmail">Persentage (1-100)</label>
                                                    <input type="number" class="form-control" id="activityEmail" min="0" max="100" placeholder="0" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add Activity</button>
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
                                            <th style="text-align: center;">Percentage</th>
                                            <th style="text-align: center; width: 190px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="text-align: center;">1.</th>
                                            <th style="text-align: center;">Make an agenda</th>
                                            <th style="text-align: center;">100%</th>
                                            <th>
                                                <div class="edit-activity-buttons">
                                                    <a href="#" data-toggle="modal" data-target="#editActivityModal">
                                                        <button type="button" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteActivityModal">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>

                                        <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editActivityModalLabel">Update My Activity!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="activityName">Activities</label>
                                                                <input type="text" class="form-control" id="activityName">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="activityEmail">Persentage (1-100)</label>
                                                                <input type="number" class="form-control" id="activityEmail" min="0" max="100" placeholder="0" prequired>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="deleteActivityModal" tabindex="-1" role="dialog" aria-labelledby="deleteActivityModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteActivityModalLabel">Delete Activity</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this activity?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

@push('footer-script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    var datatable = $('#dataTable').DataTable({
        processing: true
        , serverSide: true
        , ordering: true
        , ajax: {
            url: window.location.href
        }
        , columns: [{
                data: 'id_sector'
                , name: 'id_sector'
            }

            , {
                data: 'sector_name'
                , name: 'sector_name'
            }
            , {
                data: 'subsector'
                , name: 'subsector'
            }

            , {
                data: 'action'
                , name: 'action'
                , orderable: false
                , searcable: false
                , width: '15%'
            }
        , ]
    })

</script>

@if (session('openModal'))
<script>
    let modal = "{{ session('openModal') }}";
    // Tunggu 2-3 detik sebelum menampilkan modal
    setTimeout(function() {
        $('#' + modal).modal('show');
    }, 2000); // Jeda 2 detik

</script>
@endif

@endpush
