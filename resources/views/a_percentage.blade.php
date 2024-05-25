@extends('layouts.admin')

@section('title', 'Manage Activity Percentage')

@push('head-script')
    <!-- Custom styles for this page -->
    <link href="\vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- DataTales Activity Percentage -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div style="display: flex; align-items: center;">
                <img src="img/activity.png" style="height: 60px; width: 60px; margin-right: 10px;">
                <h3 style="margin-top: 10px; font-weight: bold; color: black;">My Activity Percentage</h3>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-primary" id="buttonSelectedFilter" data-toggle="modal"
                    data-target="#filterEmployees">
                    <i class="fas fa-filter"></i> Filter employee
                </button>
                <!-- Add Percentage button -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPercentageModal">
                    <i class="fas fa-plus"></i> Add Activity Percentage
                </button>
            </div>

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
                                    <label for="addActivityName">Activity</label>
                                    <select name="add_activityName" class="form-control" id="addActivityName"
                                        selectedOption="{{ old('add_activityName') }}">
                                        <option value="">- Choose Activity -</option>
                                        @forelse($activity as $key => $value)
                                            <option value="{{ $value->id_activity }}">{{ $value->activity_name }}</option>
                                        @empty
                                            <option value="">- No Activity -</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="addEmployeeName">Employee Name</label>
                                    <select name="add_employeeName" class="form-control" id="addEmployeeName"
                                        selectedOption="{{ old('add_employeeName') }}">
                                        <option value="">- Choose Employee -</option>
                                        @forelse($employees as $key => $value)
                                            <option value="{{ $value->id_employees }}">{{ $value->name }}</option>
                                        @empty
                                            <option value="">- No Employee -</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="percentage">Percentage (0-100)</label>
                                    <input type="number" name="percentage"
                                        class="form-control @error('percentage') is-invalid @enderror" id="percentage"
                                        min="0" max="100" placeholder="Enter Percentage"
                                        value="{{ old('percentage') }}"required>
                                    @error('percentage')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add
                                    Activity Percentage</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="filterEmployees" tabindex="-1" role="dialog"
                aria-labelledby="addPercentageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPercentageModalLabel">Filter Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/a_percentage" method="GET" id="form_filter">
                                <div class="form-group">
                                    <label for="addEmployeeName">Employee</label>

                                    <select name="id_employees" class="form-control" id="id_employees"
                                        selectedOption="{{ $selectedEmployees ? $selectedEmployees : 'All' }}">
                                        <option value="">- Select Employee -</option>
                                        <option value="All">All Employee</option>

                                        @forelse($employees as $key => $value)
                                            <option value="{{ $value->id_employees }}">{{ $value->name }}</option>
                                        @empty
                                            <option value="">No Employee</option>
                                        @endforelse
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Apply</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <p>Showing filter for : <small id="textOption"><i class="fas fa-spin fa-spinner"></i></small></p>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Activity</th>
                            <th style="text-align: center;">Employee</th>
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
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    data: 'activity_name',
                    name: 'activity_name'
                },
                {
                    data: 'employee_name',
                    name: 'employee_name'
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

    <script>
        $(document).ready(function() {
            var selectedValue = $('#id_employees').attr('selectedOption');
            // var buttonFilter = $('#buttonSelectedFilter');

            // Mengecek jika nilai adalah kosong atau 'All', dan mengatur nilainya di select
            if (selectedValue === '' || selectedValue === 'All') {
                $('#id_employees').val('All');
            } else {
                $('#id_employees').val(selectedValue);
            }

            var selectedText = $('#id_employees option:selected').text();

            // Tampilkan teks di dalam elemen dengan ID 'textOption'
            $('#textOption').text(selectedText);
            $('#form_filter').submit(function(event) {
                // Menghentikan perilaku default pengiriman formulir
                event.preventDefault();

                // Mendapatkan nilai ID employee yang dipilih dari dropdown
                var selectedEmployeesId = $('#id_employees').val();

                // Mengarahkan pengguna ke halaman /a_subsector/{selectedSectorId}
                window.location.href = '/a_percentage/' + selectedEmployeesId;
            });
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
