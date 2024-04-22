<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clarity</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('form.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('form.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-2">
                            <div class="h3">
                                <i class="fa-solid fa-globe-europe fa-lg"></i>
                                Dashboard
                            </div>
                        </div>


                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">My Activity</h6>
                                
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>

                                                <th>Activity</th>
                                                <th>Persentase</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>

                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>70%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>

                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>60%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>

                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>80%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal Edit Employee Progress-->
                            <div class="modal fade" id="editEmployeeProgressModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Progress</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                

                                                <div class="form-group">
                                                    <label for="editEmployeePSubSector">Activity</label>
                                                    <input type="text" class="form-control"
                                                        id="editEmployeePActivity" name="activity"
                                                        value="Web Development" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="activityPercentage">Persentage (1-100)</label>
                                                    <input type="number" class="form-control"
                                                        id="activityPercentage" name="percentage" value="70"
                                                        min="0" max="100" placeholder="0">
                                                </div>
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 140px;">Update Employee Progress</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete Employee Progress-->
                            <div class="modal fade" id="deleteEmployeeProgressModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Employee Progress
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure want to delete this data?</p>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2"
                                                    style="margin-left: 140px;">Delete</button>
                                                <button type="button" class="btn btn-secondary mt-2"
                                                    data-dismiss="modal">Close</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->

                    </div>
                    <!-- End of Content Wrapper -->
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white" style="position: fixed; bottom: 0; width: 100%;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-center copyright">
                                    <p class="text-muted">Copyright &copy; Your Website 2021</p>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
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
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
