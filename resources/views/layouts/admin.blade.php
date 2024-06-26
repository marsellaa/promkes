<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="E-PROMKES">
    <meta name="author" content="Marsella">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Promkes') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #16b3ac" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
                <img src="{{ url('img/logodashboard.png') }}" alt="Logo" class="custom-logo">
            </div>
            <div class="sidebar-brand-text mx-3">E-Promkes</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Form Kegiatan') }}
        </div>

        <li class="nav-item {{ Nav::isRoute('peh.index') }}">
            <a class="nav-link" href="{{ route('peh.index') }}">
                <i class="fas fa-fw fa-hospital"></i>
                <span>{{ __('PEH') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('donordarah.index') }}">
            <a class="nav-link" href="{{ route('donordarah.index') }}">
                <i class="fas fa-fw fa-tint"></i>
                <span>{{ __('Donor Darah') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('feedback.index') }}">
            <a class="nav-link" href="{{ route('feedback.index') }}">
                <i class="fas fa-fw fa-pencil-square"></i>
                <span>{{ __('Feedback') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('healthtalk.index') }}">
            <a class="nav-link" href="{{ route('healthtalk.index') }}">
                <i class="fas fa-fw fa-heartbeat"></i>
                <span>{{ __('Healthtalk') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('infodankomplain.index') }}">
            <a class="nav-link" href="{{ route('infodankomplain.index') }}">
                <i class="fas fa-fw fa-info"></i>
                <span>{{ __('Informasi & Komplain') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('kjmitra.index') }}">
            <a class="nav-link" href="{{ route('kjmitra.index') }}">
                <i class="fas fa-fw fa-link"></i>
                <span>{{ __('Kunjungan Mitra') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('kerjasama_nonbpjs.index') }}">
            <a class="nav-link" href="{{ route('kerjasama_nonbpjs.index') }}">
                <i class="fas fa-fw fa-handshake"></i>
                <span>{{ __('Kerja Sama Non-BPJS') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Nav::isRoute('video.index') }}">
            <a class="nav-link" href="{{ route('video.index') }}">
                <i class="fas fa-fw fa-play"></i>
                <span>{{ __('Video') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Nav::isRoute('flyer.index') }}">
            <a class="nav-link" href="{{ route('flyer.index') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>{{ __('Flyer') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Informasi') }}
        </div>

        <li class="nav-item {{ Nav::isRoute('mitra.index') }}">
            <a class="nav-link" href="{{ route('mitra.index') }}">
                <i class="fas fa-fw fa-link"></i>
                <span>{{ __('Mitra') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('partisipan.index') }}">
            <a class="nav-link" href="{{ route('partisipan.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('Partisipan') }}</span>
            </a>
        </li>

        <li class="nav-item {{ Nav::isRoute('pertanyaan.index') }}">
            <a class="nav-link" href="{{ route('pertanyaan.index') }}">
                <i class="fas fa-fw fa-question-circle"></i>
                <span>{{ __('Pertanyaan') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>

        <!-- Nav Item - About -->
        <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('About') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="Mdp.ac.id" target="_blank">MDP</a> {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')

</body>
</html>
