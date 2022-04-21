
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
  <!-- Main Sidebar Container -->
  
  <?php include(APPPATH . "Views/layout/aside.php"); ?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?php echo base_url('/product/index')?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
            <h1 class="m-0">Product Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                <h3 class="card-title">Product Name: <strong><?php echo $customer_data['product']['name'];?></strong></h3>
                <br><br>
                <div class="card col-sm-2" >
                  <div class="card-body">
                    <?php if (!empty($customer_data['product']['picture'])): ?>
                      <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0;">
                        <img src="<?php echo base_url('/uploads/product').'/'.$customer_data['product']['picture'] ?>" class="img-fluid" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; width:100%;height:100%;object-fit:contain;" />
                      </div>
                    <?php else:?>
                      <div>
                        <img src="<?php echo base_url('/assets/no_image.png');?>" class="img-fluid" width="275" height="400" />
                      </div>
                    <?php endif;?>
                  </div>
                  <a class="btn" style="font-weight:550;color:#5cc5e6;" data-toggle="modal" data-target="#productModal">Edit Picture</a>
                </div>    
              </div>

              <!-- /.modal -->
              <div id="productModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Edit Picture</h3>
                  </div>
                  <div class="modal-body" style="text-align: center; margin:auto;">
                    <table id="profile-table" style="border: none;">
                      <tbody>
                        <form method="POST" action="<?php echo base_url('product/updatePicture/').'/'. $customer_data['product']['id']; ?>" name="updatePicture" enctype="multipart/form-data">
                          <tr>
                            <td>
                              <?php if (!empty($customer_data['product']['picture'])) : ?>
                                <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0 0 25px;">
                                  <img id="product-image" src="<?php echo base_url('/uploads/product') . '/' . $customer_data['product']['picture']; ?>" class="profile-user-img img-fluid img-circle" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px;width:100%;object-fit:cover;" alt="User product picture" />
                                </div>
                              <?php else : ?>
                                <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0 0 25px;">
                                  <img id="product-image" src="<?php echo base_url('/dist/img/avatar5.png'); ?>" class="profile-user-img img-fluid img-circle" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px;width:100%;object-fit:cover;" alt="User product picture" />
                                </div>
                              <?php endif; ?>
                              <div class="form-group">
                                <div class="col" style="margin-top: 10px;">
                                  <input type="file" name="productpicture" id="productpicture" onchange="onFileSelected(event)">
                                </div>
                              </div>
                            </td>
                          </tr>
            
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

              <!-- /.card-header -->
              
              <form action="<?php echo base_url('product/update') . "/" . $customer_data['product']['id'];?>" method="POST">
                <div class="card-body table-responsive" style="padding:0;">
                  <table class="table table-hover text-nowrap" id="warehouse-table">
                  <tbody>
                      <tr>
                        <th>ID</th>
                        <td><?php echo $customer_data['product']['id'];?> </td>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <td><input type="text" class="form-control" name='name' id='product_name' value="<?php echo $customer_data['product']['name'];?>" required> </td>
                      </tr>
                      <tr>
                        <th>Quantity</th>
                        <td><?php echo $customer_data['product']['quantity'];?></td>
                      </tr>
                      <tr>
                        <th>Price</th>
                        <td><div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" name='price' id='product_price' value="<?php echo $customer_data['product']['price'];?>" required></div>
                        </td>
                      </tr>
                      <tr>
                        <th>Description</th>
                        <td><textarea  class="form-control" name='description' id='product_description'  required><?php echo $customer_data['product']['description'];?></textarea></td>
                      </tr>
                      <tr>
                        <th>Weight</th>
                        <td><?php echo $customer_data['product']['weight'];?> gr</td>
                      </tr>
                      <tr>
                        <th>Volume</th>
                        <td><?php echo $customer_data['product']['volume'];?> cm³</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="float-right" style="padding:10px 25px 10px 0 ">
                  <button type="submit" class="btn btn-block btn-success">Save</button>
                </div>
              </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  
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
  function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("product-image");
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
      imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
  }
</script>

</body>
</html>
