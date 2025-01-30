<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/dist/icon/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/dist/fontawesome/css/all.css">


    <!-- sweetalert -->
    <link rel="stylesheet" type="text/css" href="<?= site_url(); ?>assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="<?= site_url(); ?>assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="<?= site_url(); ?>assets/plugins/jquery/jquery.min.js"></script>


    <!-- DataTables -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- DataTables  & Plugins -->
    <script src="<?= site_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= site_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        var host = "<?= site_url(); ?>";
        var module = "<?= $module; ?>";
        var title = "<?= $title; ?>";
        var path = "<?= $path; ?>";
        var act = "<?= $act; ?>";
    </script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= site_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-light    ">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button"><i class="fa-solid fa-right-from-bracket"></i>Logout</i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-2 text-center">
                    <div class="info">
                        <a href="#" class="d-block">
                            <h4 class="font-weight-bolder ">Admin</h4>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar d-flex flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>apps/dashboard" class="nav-link">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>apps/admin" class="nav-link">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p>
                                    Data Admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>apps/member" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    Data Member
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>pendaftar" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-lines"></i>
                                <p>
                                    Data Pendaftar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>galeri" class="nav-link">
                                <i class="nav-icon fa-solid fa-film"></i>
                                <p>
                                    Data Galeri
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>pengumuman" class="nav-link">
                                <i class="nav-icon fa-solid fa-bell"></i>
                                <p>
                                    Data Pengumuman
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-contract"></i>
                                <p>
                                    Data Status Siswa
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url(); ?>lulus" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa Lulus</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url(); ?>tidaklulus" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa Tidak Lulus</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-simple"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa Di Terima</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa Di Ditolak</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?= $this->renderSection('content-page') ?>


        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery UI 1.11.4 -->

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="<?= site_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= site_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= site_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <!-- <script src="<?= site_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script> -->
    <!-- <script src="<?= site_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <script src="<?= site_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= site_url(); ?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?= site_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= site_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= site_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= site_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= site_url(); ?>assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?= site_url(); ?>assets/dist/js/pages/dashboard.js"></script> -->
</body>

</html>