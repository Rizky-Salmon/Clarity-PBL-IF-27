@extends('layouts.admin')

@section('title', 'Manage Activity Percentage')

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

            <!-- Add Percentage button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPercentageModal">
                <i class="fas fa-plus"></i> Add Activity Percentage
            </button>

            <!-- Add Percentage Modal -->
            <div class="modal fade" id="addPercentageModal" tabindex="-1" role="dialog"
                aria-labelledby="addPercentageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPercentageModalLabel">Add Percentage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('activity_percentage.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="activity_name">Activity</label>
                                    <input type="text" class="form-control" id="activity_name" name="activity_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="percentage">Percentage (1-100)</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage"
                                        min="0" max="100" required>
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
                            <th style="text-align: center;">Activity</th>
                            <th style="text-align: center;">Percentage</th>
                            <th style="text-align: center; width: 190px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: window.location.href
            },
            columns: [{
                    data: null,
                    name: 'id_activity_percentage', // Sesuaikan dengan kolom yang digunakan sebagai identitas unik
                    render: function(data, type, row, meta) {
                        // Mengembalikan nomor urut berdasarkan posisi data dalam tabel
                        return meta.row + 1;
                    }
                },
                
                {
                    data: 'activity_name',
                    name: 'activity_name'
                },
                {
                    data: 'percentage',
                    name: 'percentage'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                }
            ]
        });
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
