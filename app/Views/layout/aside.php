<?php if ($_SESSION['role'] == 'admin') : ?>

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="far fa-bell"></i>
          <?php if($admin_data['notification']):?>
            <span class="badge badge-warning navbar-badge"><?php echo count($admin_data['notification']);?></span>
          <?php endif;?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header"><?php echo count($admin_data['notification']);?> Notifications</span>
          <?php if(isset($admin_data['notification'])):?>
            <?php for($i=0;$i<sizeof($admin_data['notification']);$i++) :?>
              <div class="dropdown-divider"></div>
              <form method="POST" action="<?php echo base_url('notification/admin/update')."/". $admin_data['notification'][$i]['id']."/".$admin_data['notification'][$i]['link'];?>" >
                <button type="submit" class="dropdown-item">
                  <h6 style="font-weight: bold; font-size:small;"><?php echo $admin_data['notification'][$i]['title'];?><span class="float-right text-muted text-sm" ><?php echo $admin_data['notification'][$i]['created_at'];?></span> </h6>
                  <p class="text-sm" align="left"><?php echo $admin_data['notification'][$i]['adm_message'];?></p>
                </button>
              </form>
            <?php endfor;?>
          <?php endif;?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('admin/notification/index')?>" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="modal" data-target="#myModal" href="#" aria-expanded="false">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h4 class="modal-title">Are You Sure You Want To Logout?</h4>
          </center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger">Yes</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>

    </div>
  </div>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color:#5cc5e6">
      <img src="<?php echo base_url() ?>/assets/gudon_logo_white.png" alt="GudOn Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-bold">Gud<span style="color:white;">On</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/index'); ?>" id="home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/customer/index'); ?>" id="customer" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/order/index'); ?>" id="order" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      let current = window.location.href;
      if (current.includes('/home')) {
        document.getElementById("home").className = "nav-link active";
      }
      if (current.includes('/admin/customer/index')) {
        document.getElementById("customer").className = "nav-link active";
      }
      if (current.includes('/order/index')) {
        document.getElementById("order").className = "nav-link active";
      }
    });
  </script>

<?php else : ?>

  <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #5cc5e6;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="far fa-bell"></i>
          <?php if($customer_data['notification']):?>
            <span class="badge badge-warning navbar-badge"><?php echo count($customer_data['notification']);?></span>
          <?php endif;?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header"><?php echo count($customer_data['notification']);?> Notifications</span>
          <?php if(isset($customer_data['notification'])):?>
            <?php for($i=0;$i<sizeof($customer_data['notification']);$i++) :?>
              <div class="dropdown-divider"></div>
              <form method="POST" action="<?php echo base_url('notification/update')."/". $customer_data['notification'][$i]['id']."/".$customer_data['notification'][$i]['link'];?>" >
                <button type="submit" class="dropdown-item">
                  <h6 style="font-weight: bold; font-size:small;"><?php echo $customer_data['notification'][$i]['title'];?><span class="float-right text-muted text-sm" ><?php echo $customer_data['notification'][$i]['created_at'];?></span> </h6>
                  <p class="text-sm" align="left"><?php echo $customer_data['notification'][$i]['message'];?></p>
                </button>
              </form>
            <?php endfor;?>
          <?php endif;?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('notification/index')?>" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="modal" data-target="#myModal" href="#" aria-expanded="false">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h4 class="modal-title">Apakah Anda Ingin Log Out?</h4>
          </center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger">Yes</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>

    </div>
  </div>

  <aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color:#5cc5e6">
      <img src="<?php echo base_url() ?>/assets/gudon_logo_white.png" alt="GudOn Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-bold">Gud<span style="color:white;">On</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="<?php echo base_url('profile/index');?>" class="d-block">
            <?php if (!$_SESSION['picture'] == null): ?>
              <img src="<?php echo base_url('/uploads/profile/customer').'/'.$_SESSION['picture'] ?>" class="img-circle elevation-2" style="min-width:30px; min-height:30px; max-width:30px; max-height:30px;width:100%;object-fit:cover;" alt="User Image" />
            <?php else:?>
              <div>
                <img src="<?php echo base_url('/dist/img/avatar5.png');?>" class="img-circle elevation-2" alt="User Image" />
              </div>
            <?php endif;?>
          </a>
        </div>
        <div class="info">
          <a href="<?php echo base_url('profile/index');?>" class="d-block"><?php echo ucwords($_SESSION['name']); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('home'); ?>" id="home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('product/index'); ?>" id="product" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('warehouse/index'); ?>" id="warehouse" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Warehouse
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('order/index'); ?>" id="order" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('report/index'); ?>" id="report" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Order Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('topup/method'); ?>" id="topup" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Top Up
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      let current = window.location.href;
      if (current.includes('/home')) {
        document.getElementById("home").className = "nav-link active";
      }
      if (current.includes('/warehouse/index')) {
        document.getElementById("warehouse").className = "nav-link active";
      }
      if (current.includes('/product/index')) {
        document.getElementById("product").className = "nav-link active";
      }
      if (current.includes('/order/index')) {
        document.getElementById("order").className = "nav-link active";
      }
      if (current.includes('/report/index')) {
        document.getElementById("report").className = "nav-link active";
      }
      if (current.includes('/topup/method')) {
        document.getElementById("topup").className = "nav-link active";
      }
    });
  </script>

<?php endif; ?>