<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | New Warehouse</title>

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
                            <a href="<?php echo base_url('admin/warehouse/index') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                            <h1 class="m-0">New Warehouse</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/warehouse/index'); ?>">Warehouse</a></li>
                                <li class="breadcrumb-item active">New Warehouse</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <form method="POST" action="<?php echo base_url('admin/warehouse/store'); ?>" name="createorder">
                <div class="row" style="padding: 0 10px 0 10px">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <br>
                                        <label>Warehouse Name</label>
                                        <input type="text" name="namawarehouse" id="namawarehouse" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8" style="max-height:408px; overflow-y:auto">
                        <div class="card">
                            <div class="card-body" style="min-height:407px">
                                <div class="col-lg-12">
                                    <table class="table table-bordered dataTable table-sm" id="shelf_table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <td>Shelf Name</td>
                                                <td>Maximum Weight</td>
                                                <td>Maximum Volume</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="tambah_shelf_button_container">
                                                <td colspan=4>
                                                    <button type="button" class="btn btn-sm col-lg-12" style="background-color: #5cc5e6; color:white;" onclick="tambahRowShelf()">Add Shelf</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 tampilDataOrder">
                        </div>
                    </div>
                </div>
                <div class="float-right" style="padding:5px 25px 0 0 ">
                    <button type="submit" class="btn btn-block btn-success">Submit</button>
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        var row = 0;
    </script>

    <script>
        function tambahRowShelf() {
            var html = `
              <tr id = "tambahRowShelf${row}">
                <input type ='hidden' name='data_shelf[]' value='${row}'>
                <td>
                    <input type = 'text' class = 'form-control nf-input' name = 'namashelf${row}' required>
                </td>
                <td>
                    <input type = 'number' class = 'form-control nf-input' name = 'maxweight${row}' min="0" required>
                </td>
                <td>
                    <input type = 'number' class = 'form-control nf-input' name = 'maxvolume${row}' min="0" required>
                </td>
                <td>
                  <button type = 'button' class = 'btn btn-danger btn-sm' onclick = 'deleteShelfData(this)'><i class="fa fa-fw fa-trash"></i></button>
                </td>
              </tr>
            `;
            $("#tambah_shelf_button_container").before(html);
            $('.js-example-basic-single').select2();
            row++;
        }

        function deleteShelfData(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("shelf_table").deleteRow(i);
        }
    </script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>