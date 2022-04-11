<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Membership Upgrade</title>

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
    <style>
        /*
        *  STYLE 2
        */

        #style-2::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #5cc5e6;
        }
    </style>
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <a href="<?php echo base_url('profile/index') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                            <h1 class="m-0">Upgrade Membership</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/membership/index'); ?>">Membership</a></li>
                                <li class="breadcrumb-item active">Upgrade Membership</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <br>

                </div><!-- /.container-fluid -->
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <center>
                            <div class="alert" style="background-color: #55c5e6;color:white;">
                                <h4><i class="icon fas fa-info"></i>Your Balance:</h4>
                                <h3><?php echo $customer_data['balance']; ?></h3>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <form method="POST" action="<?php echo base_url('order/store'); ?>" name="upgradelevel">
                <div class="row" style="margin: 10px">
                    <table align="center" style="display:grid; grid-auto-columns: minmax(0, 4fr); grid-auto-flow: column;">
                        <tbody>
                            <tr>
                                <?php for ($i = 0; $i < sizeof($customer_data['membership_data']); $i++) : ?>
                                    <td>
                                        <div class="card card-default" style="max-width: 500px">
                                            <div class="card-header p-2">
                                                <div style="text-align:center; margin: 20px; padding:20px 30px; font-size:20px; font-weight:bold;">
                                                    <?php echo $customer_data['membership_data']['membership'][$i]['name']; ?>
                                                </div>
                                                <div>
                                                    <ul class="nav nav-pills">
                                                        <li class="nav-item"><a class="nav-link active" href="#benefit<?php echo $i ?>" data-toggle="tab">Benefit</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="#tnc<?php echo $i ?>" data-toggle="tab">Terms & Condition</a></li>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="benefit<?php echo $i ?>">
                                                            <ul>
                                                                <?php for ($j = 0; $j < sizeof($customer_data['membership_data']['benefit'][$i]); $j++) : ?>
                                                                    <li><?php echo $customer_data['membership_data']['benefit'][$i][$j]['benefit']; ?></li>
                                                                <?php endfor ?>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="tnc<?php echo $i ?>">
                                                            <ul>
                                                                <?php for ($j = 0; $j < sizeof($customer_data['membership_data']['terms'][$i]); $j++) : ?>
                                                                    <li><?php echo $customer_data['membership_data']['terms'][$i][$j]['terms']; ?></li>
                                                                <?php endfor ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div style="text-align:center;">
                                                        <a href="<?php echo base_url('membership/upgrade') . '/' . $customer_data['membership_data']['membership'][$i]['id'] ?>" class="btn btn-block btn-outline-dark" style="color:#55c5e6; border:none; box-shadow: rgb(49 53 59 / 12%) 5px 5px 10px 5px;">Rp <?php echo number_format($customer_data['membership_data']['membership'][$i]['price']); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                </div>
            <?php endfor; ?>
            </tr>
            </tbody>
            </table>
        </div>
        </form>
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

    <link href="<?php echo base_url('plugins/select2/css/select2.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('plugins/select2/js/select2.js'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>