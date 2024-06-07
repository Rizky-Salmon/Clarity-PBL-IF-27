@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div class="h3" style="font-weight: bold">
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

        @if (auth()->user()->default_password)
            <div class="alert alert-danger" role="alert">
                Your Password is Default. Please Change Your Password.
            </div>
        @endif

        <div class="card" style="font-family: Roboto, sans-serif;">
            <div class="row no-gutters">
                <div class="col-12 col-md-3 mt-5 ml-5 my-5 text-center">
                    <img src="img/profile.svg" class="card-img rounded" alt="Sorry, it's Empty.">
                </div>
                <div class="col-12 col-md-7 mt-5 ml-5">
                    <h5 class="card-title"><b>
                            <center>PROFILE</center>
                        </b></h5>
                    <hr>
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>:&nbsp;&nbsp;</td>
                                <td>{{ $employee->name }}</td>
                                <td><a href="#editNameModal" class="edit-profile-link" data-toggle="modal"><i
                                            class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:&nbsp;&nbsp;</td>
                                <td>{{ $employee->email }}</td>
                                <td><a href="#editEmailModal" class="edit-profile-link" data-toggle="modal"><i
                                            class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:&nbsp;&nbsp;</td>
                                <td>********</td>
                                <td><a href="#editPasswordModal" class="edit-profile-link" data-toggle="modal"><i
                                            class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Name Modal -->
        <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="editNameModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('update.name', ['id_employee' => $employee->id_employees]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $employee->name }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Email Modal -->
        <div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('update.email', ['id_employee' => $employee->id_employees]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $employee->email }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Password Modal -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="editPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasswordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('update.password', ['id_employee' => $employee->id_employees]) }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="current-password">Current Password</label>
                                <input type="password" class="form-control" id="current-password"
                                    name="current_password" placeholder="Enter Your Current Password" required>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;" for="new-password">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new-password" name="new_password"
                                        placeholder="Enter Your New Password" required>
                                    <div class="input-group-append">
                                        <button style="font-weight: bold;" class="btn btn-outline-secondary"
                                            type="button" onclick="togglePassword(this,'new-password')">
                                            <span class="fa fa-eye-slash"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;" for="confirm-password">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm-password"
                                        name="new_password_confirmation" placeholder="Confirm Your New Password" required>
                                    <div class="input-group-append">
                                        <button style="font-weight: bold;" class="btn btn-outline-secondary"
                                            type="button" onclick="togglePassword(this,'confirm-password')">
                                            <span class="fa fa-eye-slash"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Content Wrapper -->

    <script>
        function togglePassword(e, inputId) {
            var input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                e.querySelector('span').classList.remove('fa-eye-slash');
                e.querySelector('span').classList.add('fa-eye');
            } else {
                input.type = "password";
                e.querySelector('span').classList.remove('fa-eye');
                e.querySelector('span').classList.add('fa-eye-slash');
            }
        }
    </script>

    @if (session('openModal'))
        <script>
            let modal = "{{ session('openModal') }}";
            setTimeout(function() {
                $('#' + modal).modal('show');
            }, 2000);
        </script>
    @endif

@endsection
