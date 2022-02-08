
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
            <h1 class="m-0">Create Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="<?php echo base_url('/order/index');?>">Order</a></li>
              <li class="breadcrumb-item active"><a href="#">Create Order</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <form method="POST" name="createorder">
    <div class="row">
        <div class="col-12">
            <div class="card" >
                <div class="card-body" >
                                <div class="col-lg-12">
                                        <div class="float-right">
                                            <div class="input-group-append">
                                                <input type="button" name="add" value="add data" class="btn btn-success" onclick="addRow();">
                                                </button>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <br>
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Tujuan</label>
                                        <input type="text" name="alamat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input type="number" name="kuantitas" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Warehouse</label>
                                        <div class="input-group">
                                            <select class="form-control"
                                                id="customer_ids"
                                                name="customer_ids"
                                                data-placeholder="-Pilih-"
                                                style="width: 50%;">
                                            </select>                                         
                                        </div>                                      
                                        <input type="hidden" id="list_customer_ids" name="list_customer_ids" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Daftar Barang</label>
                                        <div class="input-group">
                                            <select class="form-control"
                                                id="customer_ids"
                                                name="customer_ids"
                                                data-placeholder="-Pilih-"
                                                style="width: 50%;">
                                            </select>                                          
                                        </div>
                                        
                                        <input type="hidden" id="list_customer_ids" name="list_customer_ids" value="">
                                    </div>
                                
                                            
                                </div>
                </div>
            </div>
        </div>
                                   
        <div class="col-12">
            <div class="card" >
                <div class="card-body" >
                                <div class="col-lg-12">
                                    <table class="table table-bordered dataTable table-sm" id="cust-table"
                                        style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Alamat</td>
                                            <td>Kuantitas</td>
                                            <td>Barang</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        <button  type="button" class="btn btn-block btn-success">submit</button>
                                    </div>
                                </div>
                                
                </div>
                            
            </div>
                        
        </div>  
                    
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

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/dist/js/adminlte.js"></script>

<script type="text/javascript">
    function addRow()
    {
        var nama=document.createorder.nama.value;
        var alamat=document.createorder.alamat.value;
        var kuantitas=document.createorder.kuantitas.value;

        var tr =  document.createElement('tr');

        var td1 =  tr.appendChild(document.createElement('td'));
        var td2 =  tr.appendChild(document.createElement('td'));
        var td3 =  tr.appendChild(document.createElement('td'));

        td1.innerHTML=nama;
        td2.innerHTML=alamat;
        td3.innerHTML=kuantitas;

        document.getElementById("cust-table").appendChild(tr);
    }
</script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>/dist/js/pages/dashboard.js"></script>
</body>
</html>

