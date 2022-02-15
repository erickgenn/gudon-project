
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | Membership</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<body class="hold-transition sidebar-mini layout-fixed">
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
          <a href="<?php echo base_url('/home')?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
            <h1 class="m-0">Status Membership</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
              <li class="breadcrumb-item active">Membership</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- membership status -->
        <div class="row">
            <div class="card card-default" style="padding:0%; width:100%;">
              <div class="card-body" style="display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-flex-direction: row; -ms-flex-direction: row; flex-direction: row; height: 128px; width: 100%; border-top-left-radius: 8px; border-top-right-radius: 8px; -webkit-align-items: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center; padding: 32px 10px 32px 24px; -webkit-box-pack: justify; -webkit-justify-content: space-between; -ms-flex-pack: justify; justify-content: space-between;">
                <div class="inner" style="display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -webkit-justify-content: center; -ms-flex-pack: center; justify-content: left; min-width:300px">
                  <div>
                    <p style="font-size: 16px; line-height: 22px; font-family: 'Open Sans',sans-serif;">Halo <?php echo ucwords($_SESSION['name']);?>, sekarang kamu adalah</p>
                    <p style="font-size: 24px; line-height: 28px; font-family: 'Nunito Sans',sans-serif; -webkit-letter-spacing: -0.2px; -moz-letter-spacing: -0.2px; -ms-letter-spacing: -0.2px; letter-spacing: -0.2px; font-weight: 800; 
                    color: <?php if ($_SESSION['level'] == "BRONZE") {
                      echo '#A97142';
                    } elseif($_SESSION['level'] == "SILVER") {
                      echo '#989898';
                    } elseif($_SESSION['level'] == "GOLD") {
                      echo '#FFD700';
                    }else {
                      echo '#5cc5e6';
                    }
                    ?>">Member <?php echo $_SESSION['level'];?></p>
                  </div>
                </div>
                <div style="display: flex; -webkit-box-align: center; align-items: center; color: rgba(49, 53, 59, 0.68); padding: 14px 0px 16px 20%; font-size: 10px; line-height: 14px; justify-content: space-around;">
                  <!-- saldo -->
                  <a href="<?php echo base_url();?>">
                    <div style="display: flex; flex-direction: row; text-align: center; -webkit-box-align: center; align-items: center; justify-content: space-around; cursor: pointer; background: rgb(255, 255, 255); box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px; border-radius: 8px; padding: 12px; margin-right: 12px;">
                      <div style="position: relative; width: 34px; height: 32px; background-repeat: no-repeat; background-position: center center; background-size: contain; margin: 0 20px 0 10px;">
                        <i class="fa fa-money fa-3x" style="color: #55c5e6;"></i>
                      </div>
                      <div style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px; color: rgba(49, 53, 59, 0.68); position: relative; padding-right: 12px;">
                        Saldo<br>
                        Rp <?php echo number_format($customer_data['user_balance']);?>
                      </div>
                    </div>
                  </a>
                  <!-- produk -->
                  <a href="<?php echo base_url();?>">
                    <div style="display: flex; flex-direction: row; text-align: center; -webkit-box-align: center; align-items: center; justify-content: space-around; cursor: pointer; background: rgb(255, 255, 255); box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px; border-radius: 8px; padding: 12px; margin-right: 12px;">
                      <div style="position: relative; width: 34px; height: 32px; background-repeat: no-repeat; background-position: center center; background-size: contain; margin: 0 20px 0 10px;">
                        <i class="	fa fa-shopping-basket fa-3x" style="color: #55c5e6;"></i>
                      </div>
                      <div style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px; color: rgba(49, 53, 59, 0.68); position: relative; padding-right: 12px;">
                        Jumlah Produk<br>
                        <?php echo number_format($customer_data['total_product']);?>
                      </div>
                    </div>
                  </a>
                  <!-- order -->
                  <a href="<?php echo base_url('order/index');?>">
                    <div style="display: flex; flex-direction: row; text-align: center; -webkit-box-align: center; align-items: center; justify-content: space-around; cursor: pointer; background: rgb(255, 255, 255); box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px; border-radius: 8px; padding: 12px; margin-right: 12px;">
                      <div style="position: relative; width: 34px; height: 32px; background-repeat: no-repeat; background-position: center center; background-size: contain; margin: 0 20px 0 10px;">
                        <i class="fa fa-cart-arrow-down fa-3x" style="color: #55c5e6;"></i>
                      </div>
                      <div style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px; color: rgba(49, 53, 59, 0.68); position: relative; padding-right: 12px;">
                        Jumlah Order<br>
                        <?php echo number_format($customer_data['count_order']);?>
                      </div>
                    </div>
                  </a>
                  <!-- upgrade -->
                  <a href="<?php echo base_url('membership/upgrade');?>">
                    <div style="background-color: #55c5e6; display: flex; flex-direction: row; text-align: center; -webkit-box-align: center; align-items: center; justify-content: space-around; cursor: pointer; box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px; border-radius: 8px; padding: 12px; margin-right: 12px;">
                    
                      <div style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px; color:#FFFFFF; position: relative;">
                        Upgrade
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="card-footer">
                Status Membership (<?php echo $_SESSION['time_left'];?> hari lagi)
                <div class="progress progress-sm">
                  <div class="progress-bar <?php if($_SESSION['time_left'] <= 3) echo 'bg-red'; else echo 'bg-green'?>" role="progressbar" aria-valuenow="<?php echo $_SESSION['percentage_left'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $_SESSION['percentage_left'];?>%"></div>
                </div>
              </div>
            </div>
          <!-- ./col -->
        </div>
        <!-- Membership advantage -->
        <?php if($_SESSION['level'] == "NOT RATED"):?>
          <div class="row">
            <div class="card card-default" style="width:100%;">
              <div class="card-body">
                <div class="inner">
                  <!-- Content -->
                  Untuk membuka semua fitur, silahkan upgrade membermu sekarang
                  <a class="btn" href="<?php echo base_url('membership/upgrade');?>">
                    <div style="background-color: #55c5e6; display: flex; flex-direction: row; text-align: center; -webkit-box-align: center; align-items: center; justify-content: space-around; cursor: pointer; box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px; border-radius: 8px; padding: 12px; margin-right: 12px;">
                    
                      <div style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 22px; color:#FFFFFF; position: relative;">
                        Upgrade
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <!-- ./col -->
        </div>
        <?php else: ?>
        <div class="row">
            <div class="card card-default" style="width:100%;">
              <div class="card-body">
                <div class="inner">
                  <div>
                    <p style="padding-left:7px;font-size: 24px; line-height: 28px; font-family: 'Nunito Sans',sans-serif; -webkit-letter-spacing: -0.2px; -moz-letter-spacing: -0.2px; -ms-letter-spacing: -0.2px; letter-spacing: -0.2px; font-weight: 800; 
                    color: <?php if ($_SESSION['level'] == "BRONZE") {
                      echo '#A97142';
                    } elseif($_SESSION['level'] == "SILVER") {
                      echo '#989898';
                    } elseif($_SESSION['level'] == "GOLD") {
                      echo '#FFD700';
                    }else {
                      echo '#FFFFFF';
                    }
                    ?>"><?php echo $_SESSION['level'];?></p>
                  </div>

                  <!-- Content -->
                  <div>
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#benefit" data-toggle="tab">Keuntungan Member</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tnc" data-toggle="tab">Syarat & Ketentuan</a></li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active" id="benefit">
                          <div class="post">
                          <ul>
                            <?php for($i=0;$i<sizeof($customer_data['benefit']);$i++):?>
                              <li><?php echo $customer_data['benefit'][$i]['benefit'];?></li>
                            <?php endfor;?>
                          </ul>
                          </div>
                        </div>
                        <div class="tab-pane" id="tnc">
                          <div class="post">
                          <ul>
                            <?php for($i=0;$i<sizeof($customer_data['terms']);$i++):?>
                              <li><?php echo $customer_data['terms'][$i]['terms'];?></li>
                            <?php endfor;?>
                          </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif;?>
              </div>
            </div>
          <!-- ./col -->
        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
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

<!-- jQuery -->
<script src="<?php echo base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>/dist/js/pages/dashboard.js"></script>
</body>
</html>
