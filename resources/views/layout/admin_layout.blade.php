<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galyna Heiwa | Local Fashion</title>
    <link rel="stylesheet" href="{{ url('/') }}/assets-modernize/css/styles.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/admin_layout.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/sweetalert2/sweetalert2.min.css" />

    <script src="{{ url('/') }}/assets/sweetalert2/sweetalert2.min.js"></script>

    <style>
        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="bg-motif-1 antialiased">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ url('/') }}" class="text-nowrap logo-img">
                        <img src="{{ url('/') }}/assets/galyna/logo-v2-transparent.svg" width="210"
                            alt="Galyna Logo" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>

                        {{-- Dashboard Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                                href="{{ url('/admin/dashboard') }}">

                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Data Master</span>
                        </li>

                        {{-- Category Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/category*') ? 'active' : '' }}"
                                href="{{ url('/admin/category') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-category-2"></i>
                                </span>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/products*') ? 'active' : '' }}"
                                href="{{ url('/admin/products') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shirt"></i>
                                </span>
                                <span class="hide-menu">Products</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/article*') ? 'active' : '' }}"
                                href="{{ url('/admin/article') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Article</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/links*') ? 'active' : '' }}"
                                href="{{ url('/admin/links') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-link"></i>
                                </span>
                                <span class="hide-menu">Links</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <span class="hide-menu">COMPANY</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-mood-happy"></i>
                                </span>
                                <span class="hide-menu">Icons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-xl-block">
                            <p style="margin: 0 20px;">Welcome back, <span class="fw-bold text-secondary">Adi Aulia
                                    Rahman</span></p>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url('/') }}/assets-modernize/images/user.png" alt=""
                                        width="35" height="35" class="User Profile">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <form action={{ url('logout') }} class="dropdown-item" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-outline-danger mt-2 d-block w-100">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ url('/') }}/assets-modernize/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/assets-modernize/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets-modernize/js/sidebarmenu.js"></script>
    <script src="{{ url('/') }}/assets-modernize/js/app.min.js"></script>
    {{-- <script src="{{ url('/') }}/assets-modernize/libs/apexcharts/dist/apexcharts.min.js"></script> --}}
    <script src="{{ url('/') }}/assets-modernize/libs/simplebar/dist/simplebar.js"></script>

    @yield('script')
</body>

</html>
