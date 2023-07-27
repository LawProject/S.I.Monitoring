<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard SM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
    @stack('css')
</head>

<body class="hold-transition  light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('AdminLTE/dist/img/bg1.png') }}" alt="AdminLTELogo"
                height="500" width="500">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            style="color: rgb(126, 125, 125);" class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.index') }}" style="color: rgb(126, 125, 125);" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <div class="user-panel  d-flex">
                        <div class="image">
                            <img src="{{ asset('AdminLTE/dist/img/logopoltek.png') }}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="{{ route('admin.profile') }}" style="color: rgb(126, 125, 125);"
                                class="d-block"><b>{{ Auth::user()->name }}</b></a>
                        </div>
                    </div>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="{{ asset('AdminLTE/dist/img/lawding.png') }}" class="brand-image img-circle elevation-3"
                    style="opacity: .8"alt="Logo" width="50" height="50">
                <span class="brand-text font-weight-dark d-block"><b>S.I.Monitoring</b></span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <br>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i style="color: rgb(126, 125, 125);" class="nav-icon fas fa-home"></i>
                                <p
                                    style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px; margin-top:
                                    10px">
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mahasiswa') }}" class="nav-link">
                                <i style="color: rgb(126, 125, 125);" class="nav-icon fas fa-tasks"></i>
                                <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                    Data Mahasiswa
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.organisasi') }}" class="nav-link">
                                <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-tasks"></i>
                                <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                    Data Organisasi
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color:  #fafafa;">
                                <i style="color: rgb(126, 125, 125);" class="nav-icon fas  fa-archive"></i>
                                <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                    Kegiatan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.kegiatan') }}" class="nav-link">
                                        <i style="color: rgb(126, 125, 125);" class="nav-icon fas fa-users"></i>
                                        <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                            Mahasiswa
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kegiatanorg') }}" class="nav-link">
                                        <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-building"></i>
                                        <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                            Organisasi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link user-menu" style="background-color: #fafafa;">
                                <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-user"></i>
                                <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                    User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                                        <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-users"></i>
                                        <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                            Mahasiswa
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.userOrgansiasi') }}" class="nav-link">
                                        <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-building"></i>
                                        <p style="color: rgb(126, 125, 125); margin-left: 20px; margin-right: 10px;">
                                            Organisasi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i style="color: rgb(126, 125, 125);"class="nav-icon fas fa-arrow-left"></i>
                                <p style="color: rgb(125, 126, 126); margin-left: 20px; margin-right: 10px;">
                                    Logout
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        <!-- Main Footer -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://adminlte.io">BAAK/Politeknik Hasnur</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="path/to/dist/feather.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            {
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info'
                    toastr.info("{{ Session::get('message') }}")
                    break;
                    case 'warning'
                    toastr.success("{{ Session::get('message') }}")
                    break;
                    case 'warning'
                    toastr.warning("{{ Session::get('message') }}")
                    break;
                    case 'error'
                    toastr.error("{{ Session::get('message') }}")
                    break;

                }

            }
        @endif
    </script>

    @stack('scripts')

</body>

</html>
