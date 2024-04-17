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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <div style="display: flex; align-items: center;">
                                <img src="img/activity.png" style="height: 60px; width: 60px; margin-right: 10px;">
                                <h3 style="margin-top: 10px; font-weight: bold; color: black;">Activities Data</h3>
                            </div>
                            <!--Add activity button-->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
                                <i class="fas fa-plus"></i> Add Activities
                            </button>
                            <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addActivityModalLabel">Add Activites</h5>
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
                                                    <label for="startDate">Start Date</label>
                                                    <input type="date" class="form-control" id="startDate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="endDate">End Date</label>
                                                    <input type="date" class="form-control" id="endDate" required>
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
                                            <th style="text-align: center;">Start Date</th>
                                            <th style="text-align: center;">End Date</th>
                                            <th style="text-align: center; width: 190px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="text-align: center;">1.</th>
                                            <th style="text-align: center;">Make an agenda</th>
                                            <th style="text-align: center;">2024-01-01</th>
                                            <th style="text-align: center;">2024-04-04</th>
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

                                        <tr>
                                            <th style="text-align: center;">2.</th>
                                            <th style="text-align: center;">Recording meeting results</th>
                                            <th style="text-align: center;">2024-01-01</th>
                                            <th style="text-align: center;">2024-04-04</th>
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

                                        <tr>
                                            <th style="text-align: center;">3.</th>
                                            <th style="text-align: center;">Vacation</th>
                                            <th style="text-align: center;">2024-01-01</th>
                                            <th style="text-align: center;">2024-04-04</th>
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

                                        <tr>
                                            <th style="text-align: center;">4.</th>
                                            <th style="text-align: center;">Visiting England</th>
                                            <th style="text-align: center;">2024-01-01</th>
                                            <th style="text-align: center;">2024-04-04</th>
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
                                                        <h5 class="modal-title" id="editActivityModalLabel">Update Activities!</h5>
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
                                                                <label for="startDate">Start Date</label>
                                                                <input type="date" class="form-control" id="startDate" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="endDate">End Date</label>
                                                                <input type="date" class="form-control" id="endDate" required>
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
                                                        <h5 class="modal-title" id="deleteActivityModalLabel">Delete Activities</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this activities?</p>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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