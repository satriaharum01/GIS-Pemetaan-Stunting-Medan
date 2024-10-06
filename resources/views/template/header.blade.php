<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }} - <?= $title; ?></title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/img/logo-medan.gif') }}" rel="icon">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SweetAlert 2 -->
    <script src="{{ asset('assets/dist/sweetalert2/sweetalert2.all.min.js') }}">
    </script>
    <link rel="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        .new-alert {
            position: relative;
            padding: 0.75rem;
            margin-bottom: 1rem;
            margin-top: 1rem;
            border: 1px solid transparent;
            border-radius: 0.35rem
        }

        .alert-error {
            position: absolute;
            width: 100%;
            top: 0;
            z-index: 100;
        }
    </style>
</head>
<!-- Validator -->
<?php if (isset($validation)) : ?>
    <div class="alert alert-danger alert-error"><?= $validation->listErrors() ?></div>
<?php endif; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img style="width:50px; height:50px;" src="{{ asset('assets/img/logo-medan.gif') }}" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">DINKES</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if (Auth::user()->level == "Admin") { ?>
                <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            <?php } ?>
            <?php if (Auth::user()->level == "Puskesmas") { ?>
                <li class="nav-item {{ (request()->is('puskesmas/dashboard')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('puskesmas.dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MASTER DATA
            </div>
            <?php //ADMIN LOGIN
            if (Auth::user()->level == "Admin") {
            ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item {{ (request()->is('data/kecamatan')) ? 'active' : '' }}{{ (request()->is('data/kelurahan')) ? 'active' : '' }}{{ (request()->is('data/puskesmas')) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseptboy" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-landmark"></i>
                        <span>Pengolahan Unit</span>
                    </a>
                    <div id="collapseptboy" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('data.kecamatan')}}">Data Kecamatan</a>
                            <a class="collapse-item" href="{{route('data.kelurahan')}}">Data Kelurahan</a>
                            <a class="collapse-item" href="{{route('data.puskesmas')}}">Data Puskesmas</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('laporan/stunting')) ? 'active' : '' }}{{ (request()->is('laporan/stunting/peta')) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsep" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-mountain"></i>
                        <span>Laporan Wilayah</span>
                    </a>
                    <div id="collapsep" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('laporan.stunting')}}">Data Stunting</a>
                            <a class="collapse-item" href="{{route('laporan.map')}}">Pemetaan</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('data/users')) ? 'active' : '' }}{{ (request()->is('data/register')) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseuser" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pengolahan Users</span>
                    </a>
                    <div id="collapseuser" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('data.users')}}">Data Users</a>
                            <a class="collapse-item" href="{{route('data.registrasi')}}">Data Registrasi</a>
                        </div>
                    </div>
                </li>
            <?php }
            //END ADMIN LOGIN
            ?>
            <?php //ADMIN LOGIN
            if (Auth::user()->level == "Puskesmas") {
            ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item {{ (request()->is('puskesmas/stunting')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('puskesmas.stunting')}}">
                    <i class="fas fa-fw fa-mountain"></i>
                    <span>Data Stunting</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('puskesmas/stunting/peta')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('puskesmas.map')}}">
                    <i class="fas fa-fw fa-mountain"></i>
                    <span>Pemetaan</span>
                    </a>
                </li>
            <?php }
            //END ADMIN LOGIN
            ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message ->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
           <-- Sidebar Message -->

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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucwords(Auth::user()->name); ?></span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile_1.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- Disabled ->
                                <a class="dropdown-item" href="#">
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
                                <-- Disabled -->
                                <a class="dropdown-item btn-password" href="#" data-id="<?= Auth::user()->id ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    <div class="card new-alert alert-info">Selamat Datang di
                        Sistem Informasi Geografis Monitoring Daerah Prioritas Penanganan Stunting pada Anak di Kota Medan
                    </div>
                </div>
                <!-- End of Topbar -->
                <!-- Section For Content -->
                @yield('content')
                <!-- Section For Content -->

                @include('template/footer')
            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex flex-row">
                    <h5 class="modal-title" id="exampleModalLabel">Akan Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" Untuk Mengakhiri Sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="gantipassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex flex-row">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="gantipassmodalform" action="<?= url('data/users'); ?>/update/" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="patch">
                    <input type="hidden" name="page" value="<?= url()->current() ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Masukkan Password Baru</label>
                            <input type="password" name="password" minlength="6" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-ganti" type="submit">Submit</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Section For Custom Script -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
    <!-- Money Format plugins -->
    <link rel="{{ asset('assets/dist/simple.money.format.js')}}">
    <script>
        $(function() {
            $(".alert").fadeOut(5000);
        });

        $("body").on("click", ".btn-hapus", function() {
            var x = jQuery(this).attr("data-id");
            var y = jQuery(this).attr("data-handler");
            var xy = x + '-' + y;
            event.preventDefault()
            Swal.fire({
                title: 'Hapus Data ?',
                text: "Data yang dihapus tidak dapat dikembalikan !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Data Dihapus!',
                        '',
                        'success'
                    );
                    document.getElementById('delete-form-' + xy).submit();
                }
            });

        })
        $("body").on("click", ".btn-password", function() {
            var id = jQuery(this).attr("data-id");
            $.ajax({
                url: "<?= url('data/users'); ?>/getjson/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        jQuery("#gantipassmodalform input[name=email]").val(row.email);
                    })
                }
            });
            jQuery("#gantipassmodalform").attr("action", '<?= url('data/users'); ?>/update/' + id);
            jQuery("#gantipassword").modal("toggle");
        });
    </script>
    <!-- Section For Custom Script -->
    @yield('custom_script')

</body>

</html>