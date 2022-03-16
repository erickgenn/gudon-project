<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | View Order</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <a href="<?php echo base_url('order/index') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
              <h1 class="m-0">Order Detail #<?php echo $order[0]['order_id']; ?></h1>
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
      <div class="row" style="gap:30px; padding:0 25px 0 25px;">
          <div class="card" style="min-width: 610px;">
            <div class="card-header">
              <h3 class="card-title">Order Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" style="padding:0">
              <table id="order-table" class="table table-hover text-nowrap" style="width:100%">
                <tbody>
                  <tr>
                    <th>Warehouse</th>
                    <td><?php echo $order[0]['nama_warehouse']; ?></td>
                  </tr>
                  <tr>
                    <th>Customer Name</th>
                    <td><?php echo $order[0]['nama_customer']; ?></td>
                  </tr>
                  <tr>
                    <th>Destination Address</th>
                    <td><?php echo $order[0]['alamat_tujuan']; ?></td>
                  </tr>
                  <tr>
                    <th>Total Price</th>
                    <td><?php echo $order[0]['total_harga']; ?></td>
                  </tr>
                  <tr>
                    <th>Order Status</th>
                    <td><?php echo $order[0]['status_order']; ?></td>
                  </tr>
                  <tr>
                    <th>Shipment</th>
                    <td><?php echo $order[0]['nama_pengiriman']; ?></td>
                  </tr>
                  <tr>
                    <th>Shipping Cost</th>
                    <td><?php echo $order[0]['ongkos_kirim']; ?></td>
                  </tr>
                  <tr>
                    <th>Shipping Status</th>
                    <td><?php echo $order[0]['status_pengiriman']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card" style="min-width: 610px;">
            <div class="card-header">
              <h3 class="card-title">Product Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" style="padding-top:0">
              <table id="shelf-table" class="table table-hover text-nowrap">
                <thead>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Weight (gr)</th>
                  <th>Volume (m³)</th>
                </thead>
                <tbody>
                  <?php for($i=0;$i<sizeof($order);$i++):?>
                    <tr>
                        <td><?php echo $i+1?></td>
                        <td><?php echo $order[$i]['nama_produk'];?></td>
                        <td><?php echo $order[$i]['kuantitas_produk'];?></td>
                        <td><?php echo $order[$i]['berat_produk'];?></td>
                        <td><?php echo $order[$i]['volume_produk'];?></td>
                    </tr>
                  <?php endfor;?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
</body>

</html>