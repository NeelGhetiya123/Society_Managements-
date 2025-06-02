<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
       <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="dashboard"><img src="/images/logo-mini.svg" style="margin-top: 5px;">
                        Society<br>&nbsp;&nbsp;Management</a>
                <a class="navbar-brand brand-logo-mini" href="dashboard"><img src="/images/logo-mini.svg"
                        alt="Society" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" onclick="toggleSidebar()">
                <span class="icon-menu"></span>
            </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item" href="{{ route('admin.complaint') }}" style="text-decoration: none;">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New Complaints</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item" href="{{ route('admin.member') }}" style="text-decoration: none;">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="ti-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New members registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            @if ($LoggedAdminInfo->picture)
                                <img src="{{ asset('storage/' . $LoggedAdminInfo->picture) }}">
                            @else
                                <p>Admin Picture not available</p>
                            @endif
                        
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Settings
                            </a>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="ti-power-off text-primary"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <script>
                function applySidebarSkin() {
                    const sidebarLightTheme = document.getElementById("sidebar-light-theme");
                    const sidebarDarkTheme = document.getElementById("sidebar-dark-theme");

                    const sidebarSkin = localStorage.getItem('sidebarSkin');
                    
                    if (sidebarSkin === 'light') {

                    sidebarLightTheme.classList.add('selected');
                    sidebarDarkTheme.classList.remove('selected');
                    document.body.classList.add('sidebar-light');
                    document.body.classList.remove('sidebar-dark');
                    } else if (sidebarSkin === 'dark') {

                    sidebarLightTheme.classList.remove('selected');
                    sidebarDarkTheme.classList.add('selected');
                    document.body.classList.add('sidebar-dark');
                    document.body.classList.remove('sidebar-light');
                    }
                }

                function applyNavbarSkin() {
                    const navbar = document.querySelector('.navbar');
                    const tiles = document.querySelectorAll('.color-tiles .tiles');

                    const navbarSkin = localStorage.getItem('navbarSkin');
                    
                    if (navbarSkin) {
                    navbar.classList.remove('navbar-success', 'navbar-warning', 'navbar-danger', 'navbar-info', 'navbar-dark', 'navbar-default');
                    
                    navbar.classList.add(`navbar-${navbarSkin}`);

                    tiles.forEach(tile => tile.classList.remove('selected'));
                    document.querySelector(`.color-tiles .${navbarSkin}`).classList.add('selected');
                    }
                }

                document.getElementById("sidebar-light-theme").addEventListener("click", function() {
                    localStorage.setItem('sidebarSkin', 'light');
                    applySidebarSkin();
                });

                document.getElementById("sidebar-dark-theme").addEventListener("click", function() {
                    localStorage.setItem('sidebarSkin', 'dark');
                    applySidebarSkin();
                });

                const navbarTiles = document.querySelectorAll('.color-tiles .tiles');
                navbarTiles.forEach(tile => {
                    tile.addEventListener('click', function() {
                    const skinClass = this.classList[1];
                    localStorage.setItem('navbarSkin', skinClass);
                    applyNavbarSkin();
                    });
                });

                window.onload = function() {
                    applySidebarSkin();
                    applyNavbarSkin();
                };
            </script>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <h6><i class="fas fa-tachometer-alt"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Dashboard</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.profile') ? 'active' : '' }}"
                            href="{{ route('admin.profile') }}">
                            <h6><i class="fas fa-user-circle"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Profile</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/flat') ? 'active' : '' }}"
                            href="{{ route('admin.flat') }}">
                            <h6><i class="fas fa-building"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;&nbsp;Flats</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/bill') ? 'active' : '' }}"
                            href="{{ route('admin.bill') }}">
                            <h6><i class="fas fa-file-invoice"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bills</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/visitor') ? 'active' : '' }}"
                            href="{{ route('admin.visitor') }}">
                            <h6><i class="fas fa-address-card"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Visitor</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/announcement') ? 'active' : '' }}"
                            href="{{ route('admin.announcement') }}">
                            <h6><i class="fas fa-bullhorn"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Announcement</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/complaint') ? 'active' : '' }}"
                            href="{{ route('admin.complaint') }}">
                            <h6><i class="fas fa-exclamation-triangle"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Complaints</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/member') ? 'active' : '' }}"
                            href="{{ route('admin.member') }}">
                            <h6><i class="fas fa-users"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Members</h6></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/member*') ? 'active' : '' }}" data-toggle="collapse" 
                            href="#auth" aria-expanded="false" aria-controls="auth">
                            <h6><i class="fas fa-user-alt"></i></h6>
                            <span class="menu-title"><h6>&nbsp;&nbsp;&nbsp;Create Account</h6></span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ request()->is('admin/login') ? 'active' : ''}}" 
                                href="{{ route('admin.login') }}"><h6> Login </h6></a>
                                </li>
                                <li class="nav-item"> <a class="nav-link {{ request()->is('admin/register') ? 'active' : ''}}" 
                                href="{{ route('admin.register') }}"><h6> Register </h6></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            @yield('bill')
            @yield('flat')
            @yield('visitor')
            @yield('announcement')
            @yield('member')
            @yield('complaint')
            @yield('profile')
            @yield('dashboard')
            

            <!-- main-panel ends -->
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let sidebar = document.getElementById("sidebar");
                let body = document.body; // Check if body has class "sidebar-icon-only"

                // Restore sidebar state from localStorage
                if (localStorage.getItem("sidebarState") === "minimized") {
                    sidebar.classList.add("sidebar-icon-only");
                    body.classList.add("sidebar-icon-only");
                }

                // Toggle function for sidebar
                window.toggleSidebar = function () {
                    if (sidebar.classList.contains("sidebar-icon-only")) {
                        sidebar.classList.remove("sidebar-icon-only");
                        body.classList.remove("sidebar-icon-only");
                        localStorage.setItem("sidebarState", "expanded");
                    } else {
                        sidebar.classList.add("sidebar-icon-only");
                        body.classList.add("sidebar-icon-only");
                        localStorage.setItem("sidebarState", "minimized");
                    }
                };
            });
        </script>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/vendors/chart.js/Chart.min.js"></script>
    <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/js/dashboard.js"></script>
    <script src="/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
