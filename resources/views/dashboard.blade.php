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
                                <i class="icon fas fa-globe fa-2x text-gray-300"></i>
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

        <div class="card" style="font-family: Roboto, sans-serif;">
            <div class="row no-gutters">
                <div class="col-md-3 mt-5 ml-5 my-5">
                    <img src="img/undraw_profile.svg" class="card-img rounded" alt="Sorry, its Empty.">
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
                                <td><a href="#profile-edit" class="edit-profile-link" data-toggle="tab" role="tab"
                                        style="text-align: right;"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:&nbsp;&nbsp;</td>
                                <td>{{ $employee->email }}</td>
                                <td><a href="#profile-edit" class="edit-profile-link" data-toggle="tab" role="tab"
                                        style="text-align: right;"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:&nbsp;&nbsp;</td>
                                <td>{{ $employee->password }}</td>
                                <td><a href="#profile-edit" class="edit-profile-link" data-toggle="tab" role="tab"
                                        style="text-align: right;"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Content Wrapper -->

@endsection
