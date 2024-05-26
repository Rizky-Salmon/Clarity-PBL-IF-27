@extends('layouts.admin')

@section('title', 'Manage Employee')

@push('head-script')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">
@endpush

@section('content')
    <!-- DataTales Employee -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div style="display: flex; align-items: center;">
                <img src="img/employee.png" style="height: 60px; width: 60px; margin-right: 10px;">
                <h3 style="margin-top: 10px; font-weight: bold; color: black;">Employee's Data</h3>
            </div>
            <!-- Add employee button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
                <i class="fas fa-plus"></i> Add Employee
            </button>
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
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
                                    <label for="add_employeeName">Name</label>
                                    <input type="text"
                                        class="form-control @error('add_employeeName') is-invalid @enderror"
                                        id="add_employeeName" name="add_employeeName" placeholder="Enter Employee Name"
                                        value="{{ old('add_employeeName') }}" required>
                                    @error('add_employeeName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="add_employeeEmail">Email</label>
                                    <input type="email"
                                        class="form-control @error('add_employeeEmail') is-invalid @enderror"
                                        id="add_employeeEmail" name="add_employeeEmail" placeholder="Enter Employee Email"
                                        value="{{ old('add_employeeEmail') }}" required>
                                    @error('add_employeeEmail')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="add_employeeRole">Role</label>
                                    <select class="form-control" id="add_employeeRole" name="add_employeeRole">
                                        <option value="admin" {{ old('add_employeeRole') == 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                        <option value="employees"
                                            {{ old('add_employeeRole', 'employees') == 'employees' ? 'selected' : '' }}>
                                            Employees</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="add_employeePassword">Password</label>
                                    <input type="password"
                                        class="form-control @error('add_employeePassword')is-invalid
                                        @enderror"
                                        id="add_employeePassword" name="add_employeePassword"
                                        placeholder="Enter Employee Password" value="12345678" readonly>
                                    @error('add_employeePassword')
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
                            <th style="text-align: center;">Role</th>
                            <th style="text-align: center;">Activity</th>
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

    <!-- JavaScript DataTables -->
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
                    name: 'id_employees',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'activity',
                    name: 'activity'
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
            setTimeout(function() {
                $('#' + modal).modal('show');
            }, 2000);
        </script>
    @endif
@endpush
