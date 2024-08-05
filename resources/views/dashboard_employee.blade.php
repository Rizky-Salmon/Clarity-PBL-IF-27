@extends('layouts.admin')

@section('title', 'Employee Dashboard')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div class="h3" style="font-weight: bold">
                <i class="fa-solid fa-globe-europe fa-lg"></i>
                Dashboard
            </div>
        </div>

        @if (auth()->user()->default_password)
            <div class="alert alert-danger" role="alert">
                Your Password is Default. Please Change Your Password.
            </div>
        @endif

        <div class="card" style="font-family: Roboto, sans-serif; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="row no-gutters">
                <div class="col-12 col-md-3 text-center" style="padding: 20px; margin-bottom: 0px">
                    <img src="img/profile.svg" class="card-img rounded" alt="Profile Image"
                        style="max-width: 200px; height: auto; margin: 20px auto;">
                </div>
                <div class="col-12 col-md-7" style="padding: 20px;">
                    <h5 class="card-title" style="font-weight: bold; text-align: center; margin-bottom: 20px;">PROFILE</h5>
                    <hr>
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td style="width: 150px;">Name</td>
                                <td style="width: 20px;">:</td>
                                <td>{{ $employee->name }}</td>
                                <td style="width: 40px;">
                                    <a href="#editNameModal" class="edit-profile-link" data-toggle="modal"
                                        style="color: #007bff; transition: color 0.3s;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px;">Email</td>
                                <td style="width: 20px;">:</td>
                                <td>{{ $employee->email }}</td>
                                <td style="width: 40px;">
                                    <a href="#editEmailModal" class="edit-profile-link" data-toggle="modal"
                                        style="color: #007bff; transition: color 0.3s;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px;">Password</td>
                                <td style="width: 20px;">:</td>
                                <td>********</td>
                                <td style="width: 40px;">
                                    <a href="#editPasswordModal" class="edit-profile-link" data-toggle="modal"
                                        style="color: #007bff; transition: color 0.3s;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
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
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current-password" name="current_password"
                                    placeholder="Enter Your Current Password" required>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;" for="new-password">New Password</label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password') is-invalid @enderror" id="new-password"
                                        name="new_password" placeholder="Enter Your New Password" required>
                                    <div class="input-group-append">
                                        <button style="font-weight: bold;" class="btn btn-outline-secondary"
                                            type="button" onclick="togglePassword(this, 'new-password')">
                                            <span class="fa fa-eye-slash"></span>
                                        </button>
                                    </div>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;" for="confirm-password">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        id="confirm-password" name="new_password_confirmation"
                                        placeholder="Confirm Your New Password" required>
                                    <div class="input-group-append">
                                        <button style="font-weight: bold;" class="btn btn-outline-secondary"
                                            type="button" onclick="togglePassword(this, 'confirm-password')">
                                            <span class="fa fa-eye-slash"></span>
                                        </button>
                                    </div>
                                    @error('new_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

        <script>
            function togglePassword(button, inputId) {
                const input = document.getElementById(inputId);
                if (input.type === 'password') {
                    input.type = 'text';
                    button.querySelector('span').classList.remove('fa-eye-slash');
                    button.querySelector('span').classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    button.querySelector('span').classList.remove('fa-eye');
                    button.querySelector('span').classList.add('fa-eye-slash');
                }
            }

            @if (session('openModal') === 'editPasswordModal')
                $('#editPasswordModal').modal('show');
            @endif
        </script>
    </div>
    <!-- End of Content Wrapper -->

@endsection
