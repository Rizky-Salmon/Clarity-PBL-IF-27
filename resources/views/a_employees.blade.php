<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Employee - {{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">


</head>

<body id="page-top">

    @include('sweetalert::alert')

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
                                                    <input type="text" class="form-control @error('add_employeeName') is-invalid @enderror" id="add_employeeName" name="add_employeeName" value="{{ old('add_employeeName') }}" required>
                                                    @error('add_employeeName')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="employeeEmail">Email</label>
                                                    <textarea class="form-control @error('add_employeeEmail') is-invalid @enderror" id="add_employeeEmail" rows="3" required name="add_employeeEmail">{{ old('add_employeeEmail') }}</textarea>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

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

</body>

</html>
