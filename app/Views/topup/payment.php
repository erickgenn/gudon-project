<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Top Up <?php echo $customer_data['method']; ?></title>

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

        #style-2::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
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

        <!-- /.content-header -->
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
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("topup/method"); ?>">Top Up Method</a></li>
                                <li class="breadcrumb-item active">Top Up <?php echo $customer_data['method']; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay" || $customer_data['method'] == "M-BCA" || $customer_data['method'] == "QRIS") : ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <?php if ($customer_data['method'] == "OVO") : ?>
                                            <img src="<?php echo base_url() ?>/assets/logo-ovo.png" width=20% alt="OVO" class="brand-image">
                                        <?php endif; ?>
                                        <?php if ($customer_data['method'] == "GoPay") : ?>
                                            <img src="<?php echo base_url() ?>/assets/gopay.png" width=20% alt="GOPAY" class="brand-image">
                                        <?php endif; ?>
                                        <?php if ($customer_data['method'] == "M-BCA") : ?>
                                            <img src="<?php echo base_url() ?>/assets/mbca.png" width=9% alt="M-BCA" class="brand-image">
                                        <?php endif; ?>
                                        <?php if ($customer_data['method'] == "QRIS") : ?>
                                            <img src="<?php echo base_url() ?>/assets/qris.png" width=12% alt="QRIS" class="brand-image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <br>
                                        <h4>Please select the amount below</h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm">
                                                <a class="btn btn-outline-success btn-block" onclick='generateModal("50000")' data-toggle="modal" data-target="#paymentModal" href="#paymentModal">
                                                    <br>
                                                    <h1><i class="fas fa-dollar-sign"></i></h1>
                                                    <h2>Rp 50.000</h2>
                                                </a>
                                            </div>
                                            <div class="col-sm">
                                                <a class="btn btn-outline-success btn-block" onclick='generateModal("100000")' data-toggle="modal" data-target="#paymentModal" href="#">
                                                    <br>
                                                    <h1><i class="fas fa-dollar-sign"></i> <i class="fas fa-dollar-sign"></i></h1>
                                                    <h2>Rp 100.000</h2>
                                                </a>
                                            </div>
                                            <div class="col-sm">
                                                <a class="btn btn-outline-success btn-block" onclick='generateModal("200000")' data-toggle="modal" data-target="#paymentModal" href="#">
                                                    <br>
                                                    <h1><i class="fas fa-dollar-sign"></i> <i class="fas fa-dollar-sign"></i> <i class="fas fa-dollar-sign"></i></h1>
                                                    <h2>Rp 200.000</h2>
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm">
                                                <a class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#manualInputModal" href="#">
                                                    <br>
                                                    <h1><i class="far fa-edit"></i></h1>
                                                    <h5>Or, choose your own amount</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </section>
                <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal -->
        <div id="paymentModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <form method="POST" action="<?php echo base_url('topup'); ?>" name="topup">
                        <div class="modal-header">
                            <h4 class="modal-title">Top Up Confirmation</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="invoice p-3 mb-3">

                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img src="<?php echo base_url() ?>/assets/gudon_logo_white.png" width=10% alt="GudOn Logo" class="brand-image img-circle">
                                            <?php if ($customer_data['method'] == "OVO") : ?>
                                                <img src="<?php echo base_url() ?>/assets/logo-ovo.png" width=15% alt="OVO" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "GoPay") : ?>
                                                <img src="<?php echo base_url() ?>/assets/gopay.png" width=15% alt="GoPay" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "M-BCA") : ?>
                                                <img src="<?php echo base_url() ?>/assets/mbca.png" width=7% alt="M-BCA" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "QRIS") : ?>
                                                <img src="<?php echo base_url() ?>/assets/qris.png" width=12% alt="QRIS" class="brand-image">
                                            <?php endif; ?>
                                            <small class="float-right">Date: <?php echo date("d-m-Y"); ?></small>
                                        </h4>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Top Up Amount</th>
                                                        <td id="show_amount"></td>
                                                    </tr>
                                                    <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
                                                        <tr>
                                                            <th>
                                                                <h5>Insert Your Active <?php echo $customer_data['method']; ?> Phone Number</h5>
                                                            </th>
                                                            <td>
                                                                <div class="input-group mb-3">
                                                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0][0-9]{8,15}" required onkeypress="checkPhone()">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input type="hidden" id="amount" name="amount">
                                                                </div>
                                                                <div style="display:none" id="errorMessage" class="alert alert-warning">
                                                                    <i class="icon fas fa-exclamation-triangle"></i>Please insert a valid phone number
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <?php if ($customer_data['method'] == "M-BCA") : ?>
                                                <div class="col-12" id="accordion">
                                                    <div class="card card-primary card-outline">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                            <div class="card-header">
                                                                <h3 class="card-title w-100">
                                                                    Click Here to See Instructions
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <p>1. Log In to your <b>m-BCA</b> account</p>
                                                                <p>2. Choose <b>m-Transfer</b></p>
                                                                <p>3. Choose <b>BCA Virtual Account</b></p>
                                                                <p>4. Insert 38888 + your phone number <b>(38888 08xx-xxxx-xxxx)</b></p>
                                                                <p>5. Follow the instructions to finish transaction</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="amount_bank" name="amount">
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "QRIS") : ?>
                                                <div class="col-12" id="accordion">
                                                    <div class="card card-primary card-outline">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                            <div class="card-header">
                                                                <h3 class="card-title w-100">
                                                                    Click Here to Generate QR Code
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <h5>Please Scan the QR Code Below:</h5>
                                                                <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" title="GudOn QRIS"></center>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="amount_bank" name="amount">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php if ($customer_data['method'] == "M-BCA" || $customer_data['method'] == "QRIS") : ?>
                                <button type="submit" onclick="loadingScreen()" class="btn btn-success">Top Up</button>
                            <?php endif; ?>
                            <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
                                <button type="submit" class="btn btn-success">Top Up</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Modal Custom Input -->
        <div id="manualInputModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <form method="POST" action="<?php echo base_url('topup'); ?>" name="topup">

                        <div class="modal-header">
                            <h4 class="modal-title">Top Up Confirmation</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="invoice p-3 mb-3">

                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img src="<?php echo base_url() ?>/assets/gudon_logo_white.png" width=10% alt="GudOn Logo" class="brand-image img-circle">
                                            <?php if ($customer_data['method'] == "OVO") : ?>
                                                <img src="<?php echo base_url() ?>/assets/logo-ovo.png" width=15% alt="OVO" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "GoPay") : ?>
                                                <img src="<?php echo base_url() ?>/assets/gopay.png" width=15% alt="GoPay" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "M-BCA") : ?>
                                                <img src="<?php echo base_url() ?>/assets/mbca.png" width=7% alt="M-BCA" class="brand-image">
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "QRIS") : ?>
                                                <img src="<?php echo base_url() ?>/assets/qris.png" width=12% alt="QRIS" class="brand-image">
                                            <?php endif; ?>
                                            <small class="float-right">Date: <?php echo date("d-m-Y"); ?></small>
                                        </h4>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Top Up Amount</th>
                                                        <td id="show_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5>Insert Amount</h5>
                                                            <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
                                                                <br>
                                                                <h5>Insert Your Active <?php echo $customer_data['method']; ?> Phone Number</h5>
                                                            <?php endif; ?>
                                                        </th>
                                                        <td>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Rp</span>
                                                                </div>
                                                                <input type="number" class="form-control" id="amount_custom" name="amount" min="10000" max="10000000" required>
                                                            </div>
                                                            <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
                                                                <div class="input-group mb-3">
                                                                    <input type="tel" class="form-control" id="phone_custom" name="phone" pattern="[0][0-9]{8,15}" required onkeypress="checkPhoneCustom()">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div style="display:none" id="errorMessageCustom" class="alert alert-warning">
                                                                    <i class="icon fas fa-exclamation-triangle"></i>Please insert a valid phone number
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php if ($customer_data['method'] == "M-BCA") : ?>
                                                <div class="col-12" id="accordion">
                                                    <div class="card card-primary card-outline">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                            <div class="card-header">
                                                                <h3 class="card-title w-100">
                                                                    Click Here to See Instructions
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <p>1. Log In to your <b>m-BCA</b> account</p>
                                                                <p>2. Choose <b>m-Transfer</b></p>
                                                                <p>3. Choose <b>BCA Virtual Account</b></p>
                                                                <p>4. Insert 38888 + your phone number <b>(38888 08xx-xxxx-xxxx)</b></p>
                                                                <p>5. Follow the instructions to finish transaction</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($customer_data['method'] == "QRIS") : ?>
                                                <div class="col-12" id="accordion">
                                                    <div class="card card-primary card-outline">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                            <div class="card-header">
                                                                <h3 class="card-title w-100">
                                                                    Click Here to Generate QR Code
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <h5>Please Scan the QR Code Below:</h5>
                                                                <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" title="GudOn QRIS"></center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php if ($customer_data['method'] == "M-BCA" || $customer_data['method'] == "QRIS") : ?>
                                <button type="submit" onclick="loadingScreenCustom()" class="btn btn-success">Top Up</button>
                            <?php endif; ?>
                            <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
                                <button type="submit" class="btn btn-success">Top Up</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
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
        <?php if ($customer_data['method'] == "M-BCA" || $customer_data['method'] == "QRIS") : ?>
            if (amount === "50000") {
                document.getElementById("show_amount").innerHTML = "Rp 50.000";
                document.getElementById("amount_bank").value = "50000";
            }
            if (amount === "100000") {
                document.getElementById("show_amount").innerHTML = "Rp 100.000";
                document.getElementById("amount_bank").value = "100000";
            }
            if (amount === "200000") {
                document.getElementById("show_amount").innerHTML = "Rp 200.000";
                document.getElementById("amount_bank").value = "200000";
            }
        <?php endif; ?>
        <?php if ($customer_data['method'] == "OVO" || $customer_data['method'] == "GoPay") : ?>
            if (amount === "50000") {
                document.getElementById("show_amount").innerHTML = "Rp 50.000";
                document.getElementById("amount").value = "50000";
            }
            if (amount === "100000") {
                document.getElementById("show_amount").innerHTML = "Rp 100.000";
                document.getElementById("amount").value = "100000";
            }
            if (amount === "200000") {
                document.getElementById("show_amount").innerHTML = "Rp 200.000";
                document.getElementById("amount").value = "200000";
            }
        <?php endif; ?>
    }
</script>
<script>
    function checkPhone() {
        var input = document.getElementById("phone");
        var inputValue = document.getElementById("phone").value;

        inputValue = document.getElementById("phone").value;
        if (inputValue.length < 8) {
            document.getElementById("errorMessage").style.display = "block";
        } else if (inputValue.length > 15) {
            document.getElementById("errorMessage").style.display = "block";
        } else {
            document.getElementById("errorMessage").style.display = "none";
        }
    }

    function checkPhoneCustom() {
        var input = document.getElementById("phone_custom");
        var inputValue = document.getElementById("phone_custom").value;

        inputValue = document.getElementById("phone_custom").value;
        if (inputValue.length < 8) {
            document.getElementById("errorMessageCustom").style.display = "block";
        } else if (inputValue.length > 15) {
            document.getElementById("errorMessageCustom").style.display = "block";
        } else {
            document.getElementById("errorMessageCustom").style.display = "none";
        }
    }

    function loadingScreenCustom() {
        let amount = document.getElementById("amount_custom").value;
        if (amount > 10000) {
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
    }

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

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>