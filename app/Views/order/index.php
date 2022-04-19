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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if (session()->getFlashdata('msg_success')) : ?>
      <script>
        swal({
          position: 'top-end',
          icon: 'success',
          title: 'Order Canceled Successfully!',
          showConfirmButton: false,
          timer: 1500
        });
      </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('msg_fail')) : ?>
      <script>
        swal({
          position: 'top-end',
          icon: 'error',
          title: 'Order Cancelation Failed!',
          showConfirmButton: false,
          timer: 1500
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
              <h1 class="m-0">Order</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Order</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="row" style="padding:0 10px 0 10px">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order</h3>
              <div class="float-right">
                <a href="<?php echo base_url('/order/create_order/'); ?>">
                  <button type="button" class="btn btn-block btn-success">Create Order</button>
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" style="align-content:flex-end;">
              <table id="order-table" class="table table-hover text-nowrap table-sm" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Name</th>
                    <th>Destination Address</th>
                    <th>Total Price</th>
                    <th>Shipping Cost</th>
                    <th>Date Time</th>
                    <th>Status</th>
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

    <!-- Modal -->
    <div id="shelfModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-xl modal-dialog-centered">



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

      </script>

      <script>
        $(document).ready(function() {
          $('#order-table').DataTable({
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
                  switch (row.status) {
                    case "ON PROGRESS":
                      return `<a href="<?php echo base_url('order/view') ?>/${row.id}" class="btn" style="background-color:#5cc5e6; color:white;"><i class="fas fa-eye"></i></a>
                              <form method='POST' action='<?php echo base_url('order') ?>/${row.id}/delete' style='display: unset;'>
                                <button type='submit' class='btn btn-danger' onclick="return confirm('Are you sure you want to cancel this order?')">CANCEL</button>
                              </form>
                              `;
                      break;
                    default:
                      return `<a href="<?php echo base_url('order/view') ?>/${row.id}" class="btn" style="background-color:#5cc5e6; color:white;"><i class="fas fa-eye"></i></a>`;
                      break;
                  }
                }
              },
            ]
          });
        });
      </script>
      <script>
        let tabel;
        let count = 0;

        function table($id) {
          count++;
          if (count === 1) {
            tabel = $('#detail-table').DataTable({
              "scrollX": true,
              "ajax": {
                "url": `<?php echo base_url('order/search/detail'); ?>/${$id}`,
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
                  "data": "nama_warehouse"
                },
                {
                  "data": "nama_customer"
                },
                {
                  "data": "nama_produk"
                },
                {
                  "data": "berat_produk"
                },
                {
                  "data": "volume_produk"
                },
                {
                  "data": "kuantitas_produk"
                },
                {
                  "data": "alamat_tujuan"
                },
                {
                  "data": "total_harga"
                },
                {
                  "data": "status_order"
                },
                {
                  "data": "nama_pengiriman"
                },
                {
                  "data": "ongkos_kirim"
                },
                {
                  "data": "status_pengiriman"
                },
              ]
            });
          } else {
            tabel.destroy();
            tabel = $('#detail-table').DataTable({
              "scrollX": true,
              "ajax": {
                "url": `<?php echo base_url('order/search/detail'); ?>/${$id}`,
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
                  "data": "nama_warehouse"
                },
                {
                  "data": "nama_customer"
                },
                {
                  "data": "nama_produk"
                },
                {
                  "data": "berat_produk"
                },
                {
                  "data": "volume_produk"
                },
                {
                  "data": "kuantitas_produk"
                },
                {
                  "data": "alamat_tujuan"
                },
                {
                  "data": "total_harga"
                },
                {
                  "data": "status_order"
                },
                {
                  "data": "nama_pengiriman"
                },
                {
                  "data": "ongkos_kirim"
                },
                {
                  "data": "status_pengiriman"
                },
              ]
            });
          }
        }
      </script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>