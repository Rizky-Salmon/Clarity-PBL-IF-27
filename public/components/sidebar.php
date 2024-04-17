        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-pastel sidebar sidebar-light sidebar-light-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="img/CLAIRVOYANT.png" alt="" style="max-width: 70px; height: auto; margin-top: 30px;">

                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">CLARITY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin Menu
            </div>


            <li class="nav-item">
                <a class="nav-link" href="a_employee.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manage Employee</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="a_sector.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manage Sector</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="a_subsector.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manage Sub Sector</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="a_activity.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manage Activity</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Employee Menu
            </div>




            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data visualization</span></a>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" >
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="i_activity.php">Overall Activity</a>
                        <a class="collapse-item" href="i_percentage.php">Activity Percentage</a>
                    </div>
                </div>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="a_percentage.php">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Manage Activity Percentage</span></a>
            </li>


            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->