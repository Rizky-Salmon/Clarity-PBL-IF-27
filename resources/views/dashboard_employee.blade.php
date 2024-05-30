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

                        <div class="card" style="font-family: Roboto, sans-serif;">
                            <div class="row no-gutters">
                                <div class="col-md-3 mt-5 ml-5 my-5">
                                    <img src="img/undraw_profile.svg" class="card-img rounded"
                                        alt="Sorry, its Empty.">
                                </div>
                                <div class="col-md-7 mt-5 ml-5">
                                    <h5 class="card-title"><b>
                                            <center> PROFILE</center>
                                        </b></h5>
                                    <hr>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>:&nbsp;&nbsp;</td>
                                                <td>{{ $employee->name }}</td>
                                                <td><a href="#profile-edit" class="edit-profile-link"
                                                        data-toggle="tab" role="tab"
                                                        style="text-align: right;"><i
                                                            class="fa-solid fa-pen-to-square"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:&nbsp;&nbsp;</td>
                                                <td>{{ $employee->email }}</td>
                                                <td><a href="#profile-edit" class="edit-profile-link"
                                                        data-toggle="tab" role="tab"
                                                        style="text-align: right;"><i
                                                            class="fa-solid fa-pen-to-square"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td>:&nbsp;&nbsp;</td>
                                                <td>{{ $employee->password }}</td>
                                                <td><a href="#profile-edit" class="edit-profile-link"
                                                        data-toggle="tab" role="tab"
                                                        style="text-align: right;"><i
                                                            class="fa-solid fa-pen-to-square"></i></a></td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
