
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | View Warehouse</title>

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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url() ?>/assets/gudon_logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Main Sidebar Container -->
  
  <?php include(APPPATH . "Views/layout/aside.php"); ?>

  <?php if(session()->getFlashdata('msg')):?>
    <script>window.alert("Silahkan daftarkan produk anda untuk melihat halaman ini");</script>
  <?php endif;?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?php echo base_url('/warehouse/index')?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
            <h1 class="m-0">Warehouse View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Warehouse</li>
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
                <h3 class="card-title">Warehouse: <strong><?php echo $shelf[0]['nama_warehouse'];?></strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="warehouse-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Shelf</th>
                      <th>Max Weight (gr)</th>
                      <th>Max Volume (m³)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for($i=0;$i<sizeof($shelf);$i++):?>
                      <tr>
                        <td><?php echo $shelf[$i]['id_shelf'];?></td>
                        <td><?php echo $shelf[$i]['nama_rak'];?></td>
                        <td><?php echo $shelf[$i]['berat_maks'];?></td>
                        <td><?php echo $shelf[$i]['volume_maks'];?></td>
                        <td><?php if($shelf[$i]['is_active']=="1") {echo "Active";} else {echo "Not Active";}?></td>
                        <td><button type="button" class="btn" style="background-color:#5cc5e6; color:white;" data-toggle="modal" data-target="#shelfModal" onclick="table(<?php echo $shelf[$i]['id_shelf'];?>)"><i class="fas fa-eye"></i></button></td>
                      </tr>
                    <?php endfor;?>
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
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body table-responsive">
          <table id="shelf-table" class="table table-hover text-nowrap">
            <thead>
              <th>#</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Weight (gr)</th>
              <th>Volume (m³)</th>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

<!-- jQuery -->
<script src="<?php echo base_url();?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>/dist/js/pages/dashboard.js"></script>

<script src="<?php echo base_url('/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>

<script>
  var table = $('#warehouse-table').DataTable();
</script>

<script>
  let tabel;
  let count = 0;
  function table($id) {
    count++;
    if(count === 1){
      tabel = $('#shelf-table').DataTable( {
          "ajax": {
              "url": `<?php echo base_url('/warehouse/view_product');?>/${$id}`,
              "dataSrc": ""
          },
          "columns": [
            {
              searchable: false,
              sortable: false,
              data: null,
              name: null,
              render: function(data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            { "data": "nama_produk" },
            { "data": "kuantitas_produk" },
            { "data": "berat_produk" },
            { "data": "volume_produk" }
          ]
      } );
    } else {
      tabel.destroy();
      tabel = $('#shelf-table').DataTable( {
          "ajax": {
              "url": `<?php echo base_url('/warehouse/view_product');?>/${$id}`,
              "dataSrc": ""
          },
          "columns": [
            {
              searchable: false,
              sortable: false,
              data: null,
              name: null,
              render: function(data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            { "data": "nama_produk" },
            { "data": "kuantitas_produk" },
            { "data": "berat_produk" },
            { "data": "volume_produk" }
          ]
      } );
    }
}
</script>

</body>
</html>
