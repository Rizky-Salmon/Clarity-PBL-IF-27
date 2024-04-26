<!DOCTYPE html>
<html lang="en">

<head>
    @include('form.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('form.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('form.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <div style="display: flex; align-items: center;">
                                <img src="img/employee.png" style="height: 60px; width: 60px; margin-right: 10px;">
                                <h3 style="margin-top: 10px; font-weight: bold; color: black;">Employee's Data</h3>
                            </div>
                            <!--Add employee button-->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addEmployeeModal">
                                <i class="fas fa-plus"></i> Add Employee
                            </button>
                            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                                aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('employees.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="employeeName">Name</label>
                                                    <input type="text" class="form-control" id="employeeName"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="employeeEmail">Email</label>
                                                    <textarea class="form-control" id="employeeEmail" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 140px;">Add
                                                    Employee</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
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
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center; width: 190px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $emp)
                                        <tr>
                                             <td>{{ $loop->iteration }}</td>
                                            <td>{{ $emp->name }}</td>
                                            <td>{{ $emp->email }}</td>

                                            <th>
                                                <div class="edit-employee-buttons">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#editEmployeeModal">
                                                        <button type="button" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#deleteEmployeeModal{{ $emp->id_employees }}">
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>


                                        <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                                            aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editEmployeeModalLabel">Update
                                                            Employee's Data!
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('employees.update', $emp->id_employees) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf

                                                            <input type="hidden" name="id_employees" value="{{ $emp->id_employees }}">
                                                            <div class="form-group">
                                                                <label for="employeeName">Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="employeeName" name="EmployeeName" value="{{ $emp->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="employeeEmail">Email</label>
                                                                <textarea class="form-control" id="employeeEmail" rows="2"></textarea>
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

                                        <div class="modal fade" id="deleteEmployeeModal{{ $emp->id_employees }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteEmployeeModalLabel{{ $emp->id_employees }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteEmployeerModalLabel{{ $emp->id_employees }}">Delete
                                                            Data
                                                            Employee</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this data?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('employees.destroy', $emp->id_employees) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-success"
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

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
