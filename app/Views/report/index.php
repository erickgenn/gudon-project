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

<body class="hold-transition sidebar-mini layout-fixed">
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
                            <h1 class="m-0">Order Report</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Order Report</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Form -->
                        <div class="card-body">
                            <h4> Filter </h4>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="start_date">Tanggal Awal</label>
                                        <input type="date" class="form-control" name='start_date' id='start_date' required>

                                    </div>
                                    <div class="col-sm">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name='end_date' id='end_date' required>

                                    </div>
                                    <div class="col-sm">
                                        <label for="end_date">Status</label>
                                        <div class="input-group">
                                            <select class="form-control" id="status-select" style="width: 100%;">
                                                <option selected value="0">SEMUA</option>
                                                <option value="SELESAI">SELESAI</option>
                                                <option value="BATAL">BATAL</option>
                                                <option value="SEDANG DIPROSES">SEDANG DIPROSES</option>
                                                <option value="TELAH DIKONFIRMASI">TELAH DIKONFIRMASI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <button onclick="generateTable()" class="btn btn-success fa-pull-right">Report</button>
                                <!-- <button type="submit" class="btn btn-success fa-pull-right">Detail Report</button> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="report-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat Tujuan</th>
                                        <th>Total Harga</th>
                                        <th>Ongkos Kirim</th>
                                        <th>Tanggal dan Waktu</th>
                                        <th>Status</th>
                                        <th>Status Pengantaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>

    <script>
        function generateTable() {
            let tabel = $('#report-table').DataTable();
            tabel.destroy();
            $('#report-table').DataTable({
                "scrollX": true,
                "ajax": {
                    "url": `<?php echo base_url('report/search'); ?>`,
                    "data": {
                        status: $('#status-select').val(),
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val()
                    },
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        data: null,
                        name: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "destination_name"
                    },
                    {
                        "data": "destination_address"
                    },
                    {
                        "data": "total_price"
                    },
                    {
                        "data": "delivery_price"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "delivery_status"
                    },
                    {
                        data: null,
                        name: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            switch (row.status) {
                                case "SEDANG DIPROSES":
                                    return `<form method='GET' action='<?php echo base_url('order/view') ?>/${row.id}' style='display: unset;'>
                                <button type="button" class="btn" style="background-color:#5cc5e6; color:white;" data-toggle="modal" data-target="#shelfModal" onclick="table(${row.id})">Lihat Detail</button>
                              </form>
                          <form method='POST' action='<?php echo base_url('order') ?>/${row.id}/delete' style='display: unset;'>
                            <button type='submit' class='btn btn-danger' onclick="return confirm('Apakah Anda yakin akan membatalkan order ini?')">BATAL</button>
                          </form>
                          `;
                                    break;
                                default:
                                    return `<form method='GET' action='<?php echo base_url('order/view') ?>/${row.id}' style='display: unset;'>
                                <button type="button" class="btn" style="background-color:#5cc5e6; color:white;" data-toggle="modal" data-target="#shelfModal" onclick="table(${row.id})">Lihat Detail</button>
                              </form>`;
                                    break;
                            }
                        }
                    },
                ]
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#report-table').DataTable({
                "ajax": {
                    "url": "<?php echo base_url('order/search'); ?>",
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        sortable: false,
                        data: null,
                        name: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "destination_name"
                    },
                    {
                        "data": "destination_address"
                    },
                    {
                        "data": "total_price"
                    },
                    {
                        "data": "delivery_price"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "delivery_status"
                    },
                    {
                        data: null,
                        name: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            switch (row.status) {
                                case "SEDANG DIPROSES":
                                    return `<form method='GET' action='<?php echo base_url('order/view') ?>/${row.id}' style='display: unset;'>
                                <button type="button" class="btn" style="background-color:#5cc5e6; color:white;" data-toggle="modal" data-target="#shelfModal" onclick="table(${row.id})">Lihat Detail</button>
                              </form>
                          <form method='POST' action='<?php echo base_url('order') ?>/${row.id}/delete' style='display: unset;'>
                            <button type='submit' class='btn btn-danger' onclick="return confirm('Apakah Anda yakin akan membatalkan order ini?')">BATAL</button>
                          </form>
                          `;
                                    break;
                                default:
                                    return `<form method='GET' action='<?php echo base_url('order/view') ?>/${row.id}' style='display: unset;'>
                                <button type="button" class="btn" style="background-color:#5cc5e6; color:white;" data-toggle="modal" data-target="#shelfModal" onclick="table(${row.id})">Lihat Detail</button>
                              </form>`;
                                    break;
                            }
                        }
                    },
                ]
            });
        });
    </script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>