<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galyna Heiwa | Sasirangan Local Fashion</title>
    <link rel="stylesheet" href="{{ url('/') }}/assets-modernize/css/styles.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/admin_layout.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/sweetalert2/sweetalert2.min.css" />

    <link rel="icon" href="{{ asset('assets/galyna/galyna-heiwa.ico') }}">


    <script src="{{ url('/') }}/assets/sweetalert2/sweetalert2.min.js"></script>

    <style>
        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>

    @yield('style')
</head>

<body class="antialiased bg-motif-1">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar" style="margin-top: 11px">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ url('/') }}" class="text-nowrap logo-img">
                        <img src="{{ url('/') }}/assets/galyna/logo-v2-transparent.svg" width="210"
                            alt="Galyna Heiwa Logo" />
                    </a>
                    <div class="cursor-pointer close-btn d-xl-none d-block sidebartoggler" id="sidebarCollapse">
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
                                href="{{ url('admin/dashboard') }}">

                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow {{ Request::is('admin/order*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <span class="hide-menu">Pesanan</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level {{ Request::is('admin/order*') ? 'in' : '' }}">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/order/proses') }}" class="sidebar-link {{ Request::is('admin/order/proses') ? 'active' : '' }}">
                                        <span class="hide-menu">Pesanan belum diproses</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/order/dikirim') }}" class="sidebar-link {{ Request::is('admin/order/dikirim') ? 'active' : '' }}">
                                        <span class="hide-menu">Pesanan selesai</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/promo*') ? 'active' : '' }}" href="{{url('admin/promo')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-ticket"></i>
                                </span>
                                <span class="hide-menu">Promo</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/omset*') ? 'active' : '' }}" href="{{url('admin/omset')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-printer"></i>
                                </span>
                                <span class="hide-menu">Omset</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Data Master</span>
                        </li>

                        {{-- Category Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/category*') ? 'active' : '' }}"
                                href="{{ url('admin/category') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-category-2"></i>
                                </span>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/product*') ? 'active' : '' }}"
                                href="{{ url('admin/product') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shirt"></i>
                                </span>
                                <span class="hide-menu">Produk</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/article*') ? 'active' : '' }}"
                                href="{{ url('admin/article') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Artikel</span>
                            </a>
                        </li>

                        {{-- Product Menu --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/links*') ? 'active' : '' }}"
                                href="{{ url('admin/links') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-link"></i>
                                </span>
                                <span class="hide-menu">Link</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <span class="hide-menu">Lain - lain</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/user*') ? 'active' : '' }}" href="{{url('admin/user')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">User</span>
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
            <header class="px-1 pt-2 app-header px-md-3">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-xl-block">
                            <p style="margin: 0 20px;">Selamat datang, <span class="fw-bold text-secondary">{{ Auth::user()->name }}</span></p>
                        </li>
                    </ul>
                    <div class="px-0 navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="flex-row navbar-nav ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url('/') }}/assets-modernize/images/user.png" alt=""
                                        width="35" height="35" class="User Profile">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="#" class="gap-2 d-flex align-items-center dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <form action={{ url('logout') }} class="dropdown-item" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="mt-2 btn btn-outline-danger d-block w-100">Logout</button>
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