<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | Dashboard</title>

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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Hello, <?php echo ucwords($_SESSION['name']); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box" style="padding:5%">
                <div class="level" style="float:right; padding:3%">
                  <?php if ($_SESSION['time_left'] <= 0) : ?>
                    <a href="<?php echo base_url('profile/index'); ?>" style="color:red; font-weight:bold;">Membership Expired</a>
                  <?php else : ?>
                    <a href="<?php echo base_url('profile/index'); ?>" style="color: 
                    <?php if ($_SESSION['level'] == "BRONZE") {
                      echo '#A97142';
                    } elseif ($_SESSION['level'] == "SILVER") {
                      echo '#989898';
                    } elseif ($_SESSION['level'] == "GOLD") {
                      echo '#FFD700';
                    } else {
                      echo '#5cc5e6';
                    }
                    ?>; font-weight:bold;">
                      <?php echo $_SESSION['level']; ?>
                    </a>
                  <?php endif; ?>
                </div>
                <div class="inner">
                  <p>Balance</p>
                  <h4>Rp <?php echo number_format($customer_data['user_balance']); ?></h4>
                </div>
                <div class="inner">
                  <p>Revenue</p>
                  <h4>Rp <?php echo number_format($customer_data['income']); ?></h4>
                </div>
                <?php if ($_SESSION['time_left'] <= 5 && $_SESSION['time_left'] > 0) : ?>
                  <div class="inner">
                    <div class="alert alert-warning">
                      <h5><i class="icon fas fa-exclamation-triangle"></i>Warning!</h5>
                      Your Membership is Expiring Soon!
                    </div>
                  </div>
                <?php endif; ?>
                <a href="<?php echo base_url('product/index'); ?>" class="btn btn-block" style="background-color:#5cc5e6; color:white; font-weight:bold;">Manage Products</a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box" style="padding:5%">
                <h4>Dashboard</h4>
                <div class="inner">
                  <br>
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="<?php echo $customer_data['percentage_order'] ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
                      <div>Successful Order</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="<?php echo $customer_data['total_weight']; ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
                      <div>Storage</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="<?php echo $_SESSION['percentage_left']; ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
                      <div>Membership Status</div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
              </div>
            </div>
            <!-- right col -->
            <div class="col-lg-3 col-6">
              <div class="small-box" style="padding:2.5rem 1.5rem 2.5rem 1.5rem">
                <div class="inner">
                  <h3><?php echo $ongoing_order; ?></h3>
                  <p>On Going Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url('order/index'); ?>" style="background-color:#5cc5e6; color:white; font-weight:bold;" class="small-box-footer">See Your Orders Here <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /.row (main row) -->
          <!-- Second row -->
          <div class="row">
            <div class="col-md-6">

              <div class="card">
                <div class="card-header" style="background-color:#5cc5e6">
                  <h3 class="card-title" style="color:white"><i class="fas fa-chart-line"></i> This Week's Orders Chart</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus" style="color:white"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <div class="chartjs-size-monitor">
                      <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                      </div>
                      <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                      </div>
                    </div>
                    <canvas id="orderChart" width="798" height="450" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header" style="background-color:#5cc5e6">
                  <h3 class="card-title" style="color:white"><i class="fas fa-award"></i> Your Best Selling Products</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus" style="color:white"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="product-table" class="table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Total Sold</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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
  <script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function() {
      $('#product-table').DataTable({
        "ajax": {
          "url": "<?php echo base_url('home/bestproducts'); ?>",
          "dataSrc": ""
        },
        dom: 'lrtip',
        "paging": false,
        "bInfo": false,
        "columns": [{
            data: null,
            name: null,
            render: function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          {
            "data": "nama_produk"
          },
          {
            "data": "total"
          }
        ]
      });
    });
  </script>
  <script>
    var ctx = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday',
          'Sunday',
        ],
        datasets: [{
          label: 'Orders',
          backgroundColor: '#1C6DD0',
          borderColor: '#1C6DD0',
          data: [<?php echo $count_order[0] ?>, <?php echo $count_order[1] ?>, <?php echo $count_order[2] ?>, <?php echo $count_order[3] ?>, <?php echo $count_order[4] ?>, <?php echo $count_order[5] ?>, <?php echo $count_order[6] ?>],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          tooltip: {
            mode: 'nearest',
            intersect: false
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Days'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Orders'
            },
            min: 0,
            ticks: {
              stepSize: 5
            }
          }
        },
      }
    });
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('orderChart'),
      config
    );
  </script>
</body>

</html>