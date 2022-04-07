<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Order Report</title>

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
            <div class="row" style="margin:0 10px 0 10px">
                <div class="col-12">
                    <div class="card">
                        <!-- Form -->
                        <div class="card-body">
                            <h4> Filter </h4>
                            <div class="container col-12">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="start_date">Initial Date</label>
                                        <input type="date" class="form-control" name='start_date' id='start_date' required>

                                    </div>
                                    <div class="col-sm">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control" name='end_date' id='end_date' required>

                                    </div>
                                    <div class="col-sm">
                                        <label for="end_date">Status</label>
                                        <div class="input-group">
                                            <select class="form-control" id="status-select" style="width: 100%;">
                                                <option selected value="0">ALL</option>
                                                <option value="SELESAI">SELESAI</option>
                                                <option value="BATAL">BATAL</option>
                                                <option value="SEDANG DIPROSES">SEDANG DIPROSES</option>
                                                <option value="TELAH DIKONFIRMASI">TELAH DIKONFIRMASI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin: 32px 0 0 10px">
                                        <button onclick="generateTable()" class="btn btn-success fa-pull-right">Find</button>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="report-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Customer Name</th>
                                        <th>Destination Address</th>
                                        <th>Total Price</th>
                                        <th>Shipping Cost</th>
                                        <th>Date Time</th>
                                        <th>Order Status</th>
                                        <th>Shipping Status</th>
                                        <th>Action</th>
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
        function generateTable() {
            let start_date = Date.parse($('#start_date').val());
            let end_date = Date.parse($('#end_date').val());
            if (start_date > end_date || $('#start_date').val() === "" || $('#end_date').val() === "") {
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Insert Date Correctly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
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
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                    ],
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
                            "data": "total_price",
                            "className": "text-right"
                        },
                        {
                            "data": "delivery_price",
                            "className": "text-right"
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
                                return `<a href="<?php echo base_url('report/view') ?>/${row.id}" class="btn" style="background-color:#5cc5e6; color:white;"><i class="fas fa-eye"></i></a>`;
                            }
                        },
                    ]
                });
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#report-table').DataTable({
                "ajax": {
                    "url": "<?php echo base_url('order/search'); ?>",
                    "dataSrc": ""
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                ],
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
                        "data": "total_price",
                        "className": "text-right"
                    },
                    {
                        "data": "delivery_price",
                        "className": "text-right"
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
                            return `<a href="<?php echo base_url('report/view') ?>/${row.id}" class="btn" style="background-color:#5cc5e6; color:white;"><i class="fas fa-eye"></i></a>`;
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