<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Top Up Method</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url() ?>/assets/gudon_logo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- /.content-header -->
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php include(APPPATH . "Views/layout/aside.php"); ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php if (session()->getFlashdata('msg_success_topup')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Top Up Successful!',
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        <?php endif; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Top Up Method</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3>
                                        <i class="fas fa-money-bill-wave"></i>
                                        Top Up
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3">
                                            <center>
                                                <div class="alert alert-info bg-primary">
                                                    <h4><i class="icon fas fa-info"></i>Your Balance:</h4>
                                                    <h3><?php echo $balance; ?></h3>
                                                </div>
                                            </center>
                                        </div>
                                    </div>

                                    <br>
                                    <h4>Please select the method below</h4>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                            <a class="btn btn-outline-secondary btn-block" href="<?php echo base_url("topup/view/ovo"); ?>">
                                                <br>
                                                <h1><img src="<?php echo base_url() ?>/assets/logo-ovo.png" width=50% alt="OVO" class="brand-image"></h1>
                                            </a>
                                        </div>
                                        <div class="col-sm">
                                            <a class="btn btn-outline-secondary btn-block" href="<?php echo base_url("topup/view/gopay"); ?>">
                                                <br>
                                                <h1><img src="<?php echo base_url() ?>/assets/gopay.png" width=62% alt="GOPAY" class="brand-image"></h1>
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                            <a class="btn btn-outline-secondary btn-block" href="<?php echo base_url("topup/view/mbca"); ?>">
                                                <br>
                                                <h1><img src="<?php echo base_url() ?>/assets/mbca.png" width=20% alt="MBCA" class="brand-image"></h1>
                                            </a>
                                        </div>
                                        <div class="col-sm">
                                            <a class="btn btn-outline-secondary btn-block" href="<?php echo base_url("topup/view/qris"); ?>">
                                                <br>
                                                <h1><img src="<?php echo base_url() ?>/assets/qris.png" width=32% alt="QRIS" class="brand-image"></h1>
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

    <script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function generateModal(amount) {
            if (amount === "50000") {
                document.getElementById("show_amount").innerHTML = "Rp 50.000";

            }
            if (amount === "100000") {
                document.getElementById("show_amount").innerHTML = "Rp 100.000";
            }
            if (amount === "200000") {
                document.getElementById("show_amount").innerHTML = "Rp 200.000";
            }
        }
    </script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>