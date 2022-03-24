<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | Partners</title>

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

    <?php if (session()->getFlashdata('msg_success')) : ?>
      <script>
        swal({
          position: 'top-end',
          icon: 'success',
          title: 'Order Successfully Deleted!',
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
          title: 'Failed to Delete Order!',
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
              <h1 class="m-0">Partners</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Partners</li>
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
            <!-- /.card-header -->
            <div class="card-body table-responsive" style="align-content:flex-end">
              <table id="customer-table" class="table table-striped table-bordered table-sm" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Joined Since</th>
                    <th>Status</th>
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

  </script>

  <script>
    $(document).ready(function() {
      $('#customer-table').DataTable({
        "ajax": {
          "url": "<?php echo base_url('admin/customer/search'); ?>",
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
            "data": "name"
          },
          {
            "data": "email"
          },
          {
            "data": "phone"
          },
          {
            "data": "created_at"
          },
          {
            data: null,
            name: null,
            sortable: false,
            render: function(data, type, row, meta) {
              switch (row.is_active) {
                case "1":
                  return `<button type="button" class="btn btn-block btn-success">Active</button>`;
                  break;
                case "0":
                  return `<button type="button" class="btn btn-block btn-danger">Inactive</button>`;
                  break;
                default:
                  return `-`;
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