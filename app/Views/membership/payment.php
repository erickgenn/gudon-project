<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Order</title>

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

        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php include(APPPATH . "Views/layout/aside.php"); ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php if (session()->getFlashdata('msg_balance_fail')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Insufficient Balance! Please Top Up',
                    showConfirmButton: false,
                    timer: 2800
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('msg_password_fail')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password is Incorrect!',
                    showConfirmButton: false,
                    timer: 2800
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('msg_available_sub')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Please Mind That You Have an Active Membership!',
                    showConfirmButton: true,
                    timer: 2700
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
                            <a href="<?php echo base_url('/membership/upgrade') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                            <h1 class="m-0">Membership Payment</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Membership Payment</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="row" style="padding:0 60px 0 60px">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 style="color:white">
                                <?php echo $membership['name']; ?>
                            </h3>
                        </div>
                        <form method="POST" action="<?php echo base_url('membership/payment'); ?>" id="paymentForm" name="payment">
                            <div class="card-body">
                                <div class="callout callout-warning">
                                    <h4>You are about to purchase <?php echo $membership['name']; ?> membership level</h4>
                                    <h5>Please insert your password below as a confirmation</h5>
                                </div>
                                <div class="card-body" style="padding:0 30px 0 30px">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox" required>
                                        <label class="form-check-label" for="checkbox">I Agree to <a data-toggle="modal" data-target="#termsModal" href="#termsModal">The Terms and Conditions</a></label>
                                    </div>
                                    <input type="hidden" name="level_id" value="<?php echo $id; ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" onclick="loadingScreen()" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal -->
        <div id="termsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Terms and Conditions <?php echo $membership['name']; ?> Membership Level</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <?php for ($i = 0; $i < count($detail_level); $i++) : ?>
                                <li><?php echo $detail_level[$i]; ?></li>
                            <?php endfor ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>

    <script>
        function loadingScreen() {
            swal({
                position: 'top-end',
                icon: 'https://cdn.dribbble.com/users/1186261/screenshots/3718681/_______.gif',
                buttons: false,
                closeOnClickOutside: false,
                timer: 2650,
                title: "Please Wait a Moment",
                text: "Confirming Payment...",
            });
        }
    </script>


</body>

</html>