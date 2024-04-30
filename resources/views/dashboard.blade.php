@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <div class="h3">
            <i class="fa-solid fa-tachometer-alt fa-lg"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['activity'] }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['sector'] }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['sub_sector'] }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['employee'] }}</div>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeePModal">
                <i class="fas fa-plus"></i> Add Employee Progress
            </button>
        </div>
        <div class="modal fade" id="addEmployeePModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeePModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeePModalLabel">Add Employee Progress
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="addEmployeePName">Name</label>
                                <input type="text" class="form-control" id="addEmployeePName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="addEmployeePSector">Sector</label>
                                <input type="text" class="form-control" id="addEmployeePSector" name="sector" required>
                            </div>
                            <div class="form-group">
                                <label for="addEmployeePSubSector">SubSector</label>
                                <input type="text" class="form-control" id="addEmployeePSubSector" name="sub_sector" required>
                            </div>
                            <div class="form-group">
                                <label for="addEmployeePActivity">Activity</label>
                                <textarea class="form-control" id="addEmployeePActivity" name="activity" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="activityPercentage">Persentage (1-100)</label>
                                <input type="number" class="form-control" id="activityPercentage" name="percentage" min="0" max="100" placeholder="0" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add Employee Progress</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <h5 class="modal-title" id="exampleModalLabel">Delete Employee Progress
                        </h5>
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
</div>
<!-- End of Content Wrapper -->

@endsection
