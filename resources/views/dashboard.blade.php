<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

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

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Activity
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Sector
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-map-marked-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Subsector
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-sitemap fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Total Employee
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">11</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-user-group fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Employee Progress</h6>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addEmployeePModal">
                                    <i class="fas fa-plus"></i> Add Employee Progress
                                </button>
                            </div>
                            <div class="modal fade" id="addEmployeePModal" tabindex="-1" role="dialog"
                                aria-labelledby="addEmployeePModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addEmployeePModalLabel">Add Employee Progress</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="addEmployeePName">Name</label>
                                                    <input type="text" class="form-control" id="addEmployeePName"
                                                        name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="addEmployeePSector">Sector</label>
                                                    <input type="text" class="form-control" id="addEmployeePSector"
                                                        name="sector" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="addEmployeePSubSector">SubSector</label>
                                                    <input type="text" class="form-control" id="addEmployeePSubSector"
                                                        name="sub_sector" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="addEmployeePActivity">Activity</label>
                                                    <textarea class="form-control" id="addEmployeePActivity"
                                                        name="activity" rows="3" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="activityPercentage">Persentage (1-100)</label>
                                                    <input type="number" class="form-control" id="activityPercentage"
                                                        name="percentage" min="0" max="100" placeholder="0" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 140px;">Add Employee Progress</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <i class="fa-solid fa-clipboard-list"></i>
                                Employee Progress Data
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Sector</th>
                                                <th>Subsector</th>
                                                <th>Activity</th>
                                                <th>Persentase</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Billy</td>
                                                <td>IT</td>
                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="accounting">Accounting</option>
                                                        <option value="financialplanning">Financial Planning</option>
                                                        <option value="auditing">Auditing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>70%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sarah</td>
                                                <td>Manufacturing</td>
                                               <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="accounting">Accounting</option>
                                                        <option value="financialplanning">Financial Planning</option>
                                                        <option value="auditing">Auditing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>60%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>John</td>
                                                <td>Finance</td>
                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="accounting">Accounting</option>
                                                        <option value="financialplanning">Financial Planning</option>
                                                        <option value="auditing">Auditing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="subsector">
                                                        <option value="webdevelopment">Web Development</option>
                                                        <option value="networking">Networking</option>
                                                        <option value="security">Security</option>
                                                    </select>
                                                </td>
                                                <td>80%</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editEmployeeProgressModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEmployeeProgressModal">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal Edit Employee Progress-->
                            <div class="modal fade" id="editEmployeeProgressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Progress</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="editEmployeePName">Name</label>
                                                    <input type="text" class="form-control" id="editEmployeePName" name="name" value="Billy">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmployeePSector">Sector</label>
                                                    <input type="text" class="form-control" id="editEmployeePSector" name="sector" value="IT">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmployeePSubSector">SubSector</label>
                                                    <input type="text" class="form-control" id="editEmployeePSubSector" name="sub_sector" value="Web Development">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmployeePActivity">Activity</label>
                                                    <textarea class="form-control" id="editEmployeePActivity" name="activity" rows="3">Web Development</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="activityPercentage">Persentage (1-100)</label>
                                                    <input type="number" class="form-control" id="activityPercentage" name="percentage" value="70" min="0" max="100" placeholder="0">
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Update Employee Progress</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete Employee Progress-->
                            <div class="modal fade" id="deleteEmployeeProgressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Employee Progress</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure want to delete this data?</p>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2" style="margin-left: 140px;">Delete</button>
                                                <button type="button" class="btn btn-secondary mt-2" data-dismiss="modal">Close</button>
                                            </form>
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
                        <span>Copyright &copy; Your Website 2021</span>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
