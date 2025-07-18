<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('title' ?? 'Dashboard') | {{ config('app.name') }}</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    @stack('head-script')

</head>

<body id="page-top">

    @include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-pastel sidebar sidebar-light sidebar-light-dark accordion"
            id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('/img/CLAIRVOYANT.png') }}" alt=""
                        style="max-width: 70px; height: auto; margin-top: 30px;">
                </div>
                <div class="sidebar-brand-text mx-3">CLARITY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @auth
            @if (Auth::user()->role == 'admin')
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @elseif (Auth::user()->role == 'employees')
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('employee') ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/employee') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @elseif (Auth::user()->role == 'assistant')
            <li class="nav-item {{ Request::is('employee') ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/employee') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->role == 'admin')
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading - Admin Menu -->
            <div class="sidebar-heading">
                Admin Menu
            </div>

            <!-- Manage Employee -->
            <li class="nav-item {{ Request::segment(1) === 'employees' ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/employees') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manage Employee</span>
                </a>
            </li>

            <!-- Manage Sector -->
            <li class="nav-item {{ Request::segment(1) === 'sector' ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/sector') }}">
                    <i class="icon fas fa-globe"></i>
                    <span>Manage Sector</span>
                </a>
            </li>

            <!-- Manage Sub Sector -->
            <li class="nav-item {{ Request::segment(1) === 'a_subsector' ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/a_subsector') }}">
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Manage Sub Sector</span>
                </a>
            </li>

            <!-- Manage Activity Percentage -->
            <li class="nav-item {{ Request::segment(1) === 'activity' ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/activity') }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Manage Activity Sub-sector</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->role == 'employees' || Auth::user()->role == 'assistant' || Auth::user()->role == 'admin')
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading - Employee Menu -->
            <div class="sidebar-heading">
                Employee Menu
            </div>

            <!-- Data visualization -->
            <li
                class="nav-item {{ Request::segment(1) === 'i_activity' || Request::segment(1) === 'i_percentage' || Request::segment(1) === 'i_employee' || Request::segment(1) === 'i_sector' || Request::segment(1) === 'i_subsector' || Request::segment(1) === 'i_MinEmployee' || Request::segment(1) === 'i_MaxEmployee' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Visualization</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ asset('/i_activity') }}">Overall Activity</a>
                        {{-- <a class="collapse-item" href="{{ asset('/i_percentage') }}">Activity Percentage</a> --}}
                        <a class="collapse-item" href="{{ asset('/i_employee') }}">Employee</a>
                        <a class="collapse-item" href="{{ asset('/i_sector') }}">Sector</a>
                        <a class="collapse-item" href="{{ asset('/i_subsector') }}">Sub Sector</a>
                        {{-- <a class="collapse-item" href="{{ asset('/i_MinEmployee') }}">Min Employee / Activities</a>
                        <a class="collapse-item" href="{{ asset('/i_MaxEmployee') }}">Max Employee / Activities</a> --}}
                    </div>
                </div>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'a_percentage' ? 'active' : '' }}">
                <a class="nav-link" href="{{ asset('/a_percentage') }}">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Manage Activity Percentage</span>
                </a>
            </li>
            @endif
            @endauth

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Sidebar Toggle Button -->
            <div class="text-center d-none d-md-inline ">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow"
                    style="background-color: #B7C9F2;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('img/undraw_male.svg') }}" alt="Profile Picture"
                            class="img-fluid rounded-circle" style="max-width: 50px;">
                        <div style="margin-left: 10px; font-weight: bold; font-size: 22px;">Welcome ,
                            {{ Auth::user()->name }}
                        </div>
                    </div>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        {{-- <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> --}}

                        {{-- <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li> --}}

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"
                            style="color: rgb(20, 20, 20);text-decoration: none;font-weight: bold; cursor: pointer;"
                            onmouseover="this.style.color='white'" onmouseout="this.style.color='rgb(20, 20, 20)'">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" style="color: rgb(20, 20, 20);"></i>
                            Logout
                        </a>
                        {{-- <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">

                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a> -
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li> --}}

                        <!-- Logout Modal-->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                        <button class="close" type="button" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Logout" below if you are ready to end your current
                                        session.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="/logout">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>

                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    @yield('content')

                </div>
                <!-- End of Page Wrapper -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white" style="padding: 10px 0;">
                <div class="container my-auto d-flex justify-content-between align-items-center">
                    <div>
                        <img src="img/Logo-poltek-batam.png" style="width: 60px; height: auto;" alt="">
                    </div>
                    <div class="copyright text-center my-auto" style="font-size: 12px;">
                        <span class="text-muted">&copy; <a href="https://polibatam.ac.id"
                                target="_blank">Politeknik Negeri Batam</a>, in collaboration with <a
                                href="https://www.linkedin.com/in/jonathan-brindle/" target="_blank">Jonathan
                                Brindle</a>, International Office, <a href="https://www.uphf.fr/"
                                target="_blank">Université Polytechnique Hauts-de-France</a>.<br>
                            <a href="{{ route('credits') }}"> Credits and Team </a></span>
                    </div>
                    <div>
                        <img src="img/Logo-uphf.png" style="width: 110px; height: auto;" alt="">
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->



        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>



    @stack('footer-script')
</body>

</html>