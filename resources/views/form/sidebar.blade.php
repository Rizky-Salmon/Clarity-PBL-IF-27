<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-pastel sidebar sidebar-light sidebar-light-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="img/CLAIRVOYANT.png" alt="" style="max-width: 70px; height: auto; margin-top: 30px;">
        </div>
        <div class="sidebar-brand-text mx-3">CLARITY</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Admin Menu -->
    <div class="sidebar-heading">
        Admin Menu
    </div>

    <!-- Manage Employee -->
    <li class="nav-item {{ Request::segment(1) === 'employees' ? 'active' : '' }}">
        <a class="nav-link" href="employees">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Employee</span>
        </a>
    </li>

    <!-- Manage Sector -->
    <li class="nav-item {{ Request::segment(1) === 'sector' ? 'active' : '' }}">
        <a class="nav-link" href="sector">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Sector</span>
        </a>
    </li>

    <!-- Manage Sub Sector -->
    <li class="nav-item {{ Request::segment(1) === 'a_subsector' ? 'active' : '' }}">
        <a class="nav-link" href="/a_subsector">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Sub Sector</span>
        </a>
    </li>

    <!-- Manage Activity -->
    <li class="nav-item {{ Request::segment(1) === 'activity' ? 'active' : '' }}">
        <a class="nav-link" href="activity">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Activity</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading - Employee Menu -->
    <div class="sidebar-heading">
        Employee Menu
    </div>

    <!-- Data visualization -->
    <li class="nav-item {{ Request::segment(1) === 'i_activity' || Request::segment(1) === 'i_percentage' || Request::segment(1) === 'i_employee' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data visualization</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/i_activity">Overall Activity</a>
                <a class="collapse-item" href="/i_percentage">Activity Percentage</a>
                <a class="collapse-item" href="/i_employee">Employee</a>
                <a class="collapse-item" href="/i_sector">Sector</a>
                <a class="collapse-item" href="/i_subsector">Sub Sector</a>
                <a class="collapse-item" href="/i_MinEmployee">Min Employee / Activities</a>
                <a class="collapse-item" href="/i_MaxEmployee">Max Employee / Activities</a>
            </div>
        </div>
    </li>

    <!-- Manage Activity Percentage -->
    <li class="nav-item {{ Request::segment(1) === 'a_percentage' ? 'active' : '' }}">
        <a class="nav-link" href="/a_percentage">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Manage Activity Percentage</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggle Button -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
