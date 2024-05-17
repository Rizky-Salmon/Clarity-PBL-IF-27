@extends('layouts.admin')

@section('title', 'Manage Employee')

@push('head-script')

<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<!-- CSS DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">


@endpush

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div style="display: flex; align-items: center;">
            <img src="img/employee.png" style="height: 60px; width: 60px; margin-right: 10px;">
            <h3 style="margin-top: 10px; font-weight: bold; color: black;">Employee's Data</h3>
        </div>
        <!--Add employee button-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
            <i class="fas fa-plus"></i> Add Employee
        </button>
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employees.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="employeeName">Name</label>
                                <input type="text" class="form-control @error('add_employeeName') is-invalid @enderror" id="add_employeeName" name="add_employeeName" placeholder="Enter Employee Name" value="{{ old('add_employeeName') }}"  required>
                                @error('add_employeeName')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="employeeEmail">Email</label>
                                <input class="form-control @error('add_employeeEmail') is-invalid @enderror" id="add_employeeEmail" rows="3" placeholder="Enter Employee Email" name="add_employeeEmail" required>{{ old('add_employeeEmail') }} </input>
                                @error('add_employeeEmail')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add
                                Employee</button>
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
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center; width: 190px;">Action</th>
                    </tr>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('footer-script')

<!-- Page level plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
{{-- <script src="js/demo/datatables-demo.js"></script> --}}


<!-- JavaScript DataTables -->
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script> --}}
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.min.js"></script> --}}



<script>
    var datatable = $('#dataTable').DataTable({
        processing: true
        , serverSide: true
        , ordering: true
        , ajax: {
            url: window.location.href
        }
        , columns: [{
                data: 'id_employees'
                , name: 'id_employees'
            }

            , {
                data: 'name'
                , name: 'name'
            }
            , {
                data: 'email'
                , name: 'email'
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
