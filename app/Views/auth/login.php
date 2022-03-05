<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GudOn | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="<?php echo base_url() ?>/assets/gudon_logo.png" alt="AdminLTE Logo" style="opacity: .8" width="50%">
      </div>
      <div class="card-body">

        <p class="login-box-msg"><b>Sign in to start your session</b></p>
        <form action="<?php echo base_url("login/auth") ?>" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div>
            <?php if (session()->getFlashdata('msg')) : ?>
              <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="row">
            <div class="col-6">
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Recover Password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->

        <p class="mb-0">
          <a href="<?php echo base_url(); ?>/register/index" class="text-center">Register a new membership</a>
        </p>
        <p class="mb-0">
          Are you an admin? <a href="<?php echo base_url(); ?>/login/admin" class="text-center">Log In Here!</a>
        </p>
        <p class="mb-0" style="font-size: 0.8em">
           <a href="<?php echo base_url(); ?>/forgot_password/index" class="text-center">Forgot password?</a>
        </p>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>/dist/js/adminlte.min.js"></script>


</body>

</html>