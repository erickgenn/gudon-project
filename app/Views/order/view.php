
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | Warehouse</title>

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
          <a href="<?php echo base_url('order/index')?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
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
    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Order</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">

                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              <table id="order-table" class="table table-striped table-bordered" style="width:100%">
                  <tbody>
                      <tr>
                          <th>No.</th>
                          <td>1</td>
                      </tr>
                      <tr>
                          <th>Nama Warehouse</th>
                          <td><?php echo $order[0]['nama_warehouse'];?></td>
                      </tr>
                      <tr>
                          <th>Nama Customer</th>
                          <td><?php echo $order[0]['nama_customer'];?></td>
                      </tr>
                      <tr>
                          <th>Nama Produk</th>
                          <td><?php echo $order[0]['nama_produk'];?></td>
                          
                      </tr>
                      <tr>
                          <th>Berat Produk</th>
                          <td><?php echo $order[0]['berat_produk'];?></td>
                      </tr>
                      <tr>
                          <th>Volume Produk</th>
                          <td><?php echo $order[0]['volume_produk'];?></td>
                      </tr>
                      <tr>
                          <th>Kuantitas Produk</th>
                          <td><?php echo $order[0]['kuantitas_produk'];?></td>
                      </tr>
                      <tr>
                          <th>Alamat Tujuan</th>
                          <td><?php echo $order[0]['alamat_tujuan'];?></td>
                      </tr>
                      <tr>
                          <th>Total Harga</th>
                          <td><?php echo $order[0]['total_harga'];?></td>
                      </tr>
                      <tr>
                          <th>Status</th>
                          <td><?php echo $order[0]['status_order'];?></td>
                      </tr>
                      <tr>
                          <th>Nama Pengiriman</th>
                          <td><?php echo $order[0]['nama_pengiriman'];?></td>
                      </tr>
                      <tr>
                          <th>Ongkos Kirim</th>
                          <td><?php echo $order[0]['ongkos_kirim'];?></td>
                      </tr>
                      <tr>
                          <th>Status Pengiriman</th>
                          <td><?php echo $order[0]['status_pengiriman'];?></td>
                      </tr>
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

<script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>/dist/js/pages/dashboard.js"></script>
</body>
</html>
