
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
  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            <a href="<?php echo base_url('admin/product/index')?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
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
          <div class="col-12" >
            <div class="card" >
              <div class="card-header">
                <h3 class="card-title">Product Name: <strong><?php echo $admin_data['product'][0]['name'];?></strong></h3>
                <br><br>
                <div style="display:flex;font-weight:600;gap:15px">
                  <div class="card col-sm-2" >
                    <div class="card-body" >
                      <?php if (!empty($admin_data['product'][0]['picture'])): ?>
                        <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0;">
                          <img src="<?php echo base_url('/uploads/product').'/'.$admin_data['product'][0]['picture'] ?>" class="img-fluid" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; width:100%;height:100%;object-fit:contain;" />
                        </div>  
                      <?php else:?>
                        <div>
                          <img src="<?php echo base_url('/assets/no_image.png');?>" class="img-fluid" width="275" height="400" />
                        </div>
                      <?php endif;?>  
                    </div>
                    <?php if (!empty($admin_data['product'][0]['temp_picture'])): ?>
                        <span style="padding-bottom:10px;text-align:center">Before</span>
                    <?php endif;?>
                  </div>
                  <?php if (!empty($admin_data['product'][0]['temp_picture'])): ?>    
                  <div class="card col-sm-2">     
                      <div class="card-body">
                        <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0;">
                          <img src="<?php echo base_url('/uploads/product/temp').'/'.$admin_data['product'][0]['temp_picture'] ?>" class="img-fluid" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; width:100%;height:100%;object-fit:contain;" />
                        </div>
                      </div>
                      <span style="padding-bottom:10px;text-align:center">After</span>
                  </div>
                  <?php endif;?>
                  <div class="col-6">
                    <?php if (!empty($admin_data['product'][0]['temp_picture'])): ?>
                      <span style="color:gray;font-weight:400;font-style:italic;width:100%">* This product request for product picture changes. Please proceed this picture if it is relatable to the previous one</span>
                      <div style="display:flex;gap:15px;padding-top:20px">
                        <div>
                          <form method="POST" action="<?php echo base_url('admin/product/declinePicture/').'/'. $admin_data['product'][0]['id']; ?>" name="updatePicture" enctype="multipart/form-data">
                            <button type="submit" class="btn btn-block btn-danger">Decline</button>
                          </form>
                        </div>
                        <div >
                          <form method="POST" action="<?php echo base_url('admin/product/updatePicture/').'/'. $admin_data['product'][0]['id']; ?>" name="updatePicture" enctype="multipart/form-data">
                            <button type="submit" class="btn btn-block btn-success">Accept</button>      
                          </form>
                        </div>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
                
              </div>

              
                    
          
              <!-- /.card-header -->
              
              <form action="<?php echo base_url('admin/product/update') . "/" . $admin_data['product'][0]['id'];?>" method="POST" id="productform">
                <div class="card-body table-responsive" style="padding:0;">
                  <table class="table table-hover text-nowrap" id="warehouse-table">
                  <tbody>
                      <tr>
                        <th>ID</th>
                        <td><?php echo $admin_data['product'][0]['id'];?> <input type="hidden" name='custid' value='<?php echo $admin_data['product'][0]['customer_id'];?>'></td>
                        <input type="hidden" name='produkid' value='<?php echo $admin_data['product'][0]['id'];?>'>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <td><input type="text" class="form-control" name='name' id='product_name' value="<?php echo $admin_data['product'][0]['name'];?>" required> </td>
                      </tr>
                      <tr>
                        <th>Quantity</th>
                        <td><input type="number" class="form-control" name='quantity' id='product_quantity' min='0' value="<?php echo $admin_data['product'][0]['quantity'];?>" required></td>
                      </tr>
                      <tr>
                        <th>Price</th>
                        <td><div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" min='0' name='price' id='product_price' value="<?php echo $admin_data['product'][0]['price'];?>" required></div>
                        </td>
                      </tr>
                      <tr>
                        <th>Description</th>
                        <td><textarea  class="form-control" name='description' id='product_description' required><?php echo $admin_data['product'][0]['description'];?></textarea></td>
                      </tr>
                      <tr>
                        <th>Weight</th>
                        <td><div class="input-group-append">
                                <span class="input-group-text">gr</span>
                            <input type="text" class="form-control" min='0' name='weight' id='product_weight' value="<?php echo $admin_data['product'][0]['weight'];?>" required></div></td>
                      </tr>
                      <tr>
                        <th>Volume</th>
                        <td><div class="input-group-append">
                                <span class="input-group-text">m³</span>
                          <input type="text" class="form-control" min='0' name='volume' id='product_volume' value="<?php echo $admin_data['product'][0]['volume'];?>" required></div></td>
                      </tr>
                      <tr>
                        <th>Warehouse</th>
                        <td>
                          <select class="form-control" name="warehouse" id="warehouseform" form="productform" onchange="load_shelf()">
                            <?php for($i=0;$i<count($admin_data['warehouse']);$i++):?>
                              <option value="<?php echo $admin_data['warehouse'][$i]['id']?>" <?php if($admin_data['warehouse'][$i]['id'] == $admin_data['product'][0]['warehouse_id']) { echo 'selected';}?>><?php echo $admin_data['warehouse'][$i]['name']?></option>
                            <?php endfor;?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th>Shelf</th>
                        <td>
                          <select class="form-control" name="shelf" id="shelfform" form="productform" required>
                          </select>
                        </td>
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
  function load_shelf() {
    var select = document.getElementById('warehouseform');
    var id_warehouse = select.options[select.selectedIndex].value;
    
    $.ajax({
      url: "<?php echo base_url();?>/admin/product/get_shelf/" + id_warehouse,
      type: "GET",
      dataType: "JSON",
      success: function(respond) {
        var html = "";
        for (var a = 0; a < respond.length; a++) {
          if(respond[a]['shelf_id'] == <?php echo $admin_data['product'][0]['shelf_id'];?> ) {
            html += `<option value ="${respond[a]['shelf_id']}" selected >${respond[a]['shelf_name']}</option>`;
          } else {
            html += `<option value ="${respond[a]['shelf_id']}" >${respond[a]['shelf_name']}</option>`;
          }
        }
        $("#shelfform").html(html);
      }
    });
  }

  $(document).ready(function() {
    load_shelf();
  });
 </script>

</body>
</html>
