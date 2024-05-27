        {{-- <div class="row mb-2">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <a href="#" class="d-flex align-items-center justify-content-center"
                            style="height: 150px; width: 150px; border-radius: 50%; border: 1px solid #ccc; position: relative;">
                            <img src="img/undraw_profile.svg" alt="Profile" class="rounded-circle"
                                style="height: 100%; width: 100%; object-fit: cover; opacity: 1;">
                            <div class="edit-profile-image"
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; opacity: 0;">
                                <input type="file" accept="image/*" style="display: none;">
                                <i class="fa-solid fa-pen-to-square fa-2x text-primary"></i>
                            </div>
                        </a>
                        <h2>Kevin Anderson</h2>
                    </div>
                </div>
                <script>
                    document.querySelector('.edit-profile-image').addEventListener('click', function(e) {
                        e.preventDefault();
                        document.querySelector('input[type="file"]').click();
                    });
                    document.querySelector('input[type="file"]').addEventListener('change', function() {
                        document.querySelector('.edit-profile-image').style.display = 'flex';
                        document.querySelector('.edit-profile-image').style.opacity = '1';
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.querySelector('.profile-card img').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    });
                    document.querySelector('.profile-card').addEventListener('mouseenter', function() {
                        document.querySelector('.edit-profile-image').style.display = 'flex';
                        document.querySelector('.edit-profile-image').style.opacity = '1';
                    });
                    document.querySelector('.profile-card').addEventListener('mouseleave', function() {
                        document.querySelector('.edit-profile-image').style.opacity = '0';
                        setTimeout(function() {
                            document.querySelector('.edit-profile-image').style.display = 'none';
                        }, 300);
                    });
                </script>
            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                    aria-selected="true" role="tab">Overview</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                    aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">About</h5>
                                    <a href="#profile-edit" class="edit-profile-link" data-toggle="tab" role="tab"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                    temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae
                                    quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Profile Details</h5>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        Kevin Anderson
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        k.anderson@example.com
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Password</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        ******
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Company</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        Luilwitz, Wisoky and Leuschke
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        Web Designer
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        USA
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        A108 Adam Street, New York, NY 535022
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8 d-flex justify-content-between align-items-center">
                                        (436) 486-3538 x29071
                                        <a href="#profile-edit" class="edit-profile-link" data-toggle="tab"
                                            role="tab"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                <!-- Edit Profile Form -->
                                <form>
                                    <!-- Edit Profile Form Content Here -->
                                </form>
                            </div>
                        </div><!-- End Bordered Tabs -->


                    </div>
                </div>

            </div>
        </div> --}}

        {{-- <div class="card shadow mb-4">
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

    </div> --}}
        <!-- End of Main Content -->
