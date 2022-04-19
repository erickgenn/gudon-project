<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Create Order</title>

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


        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include(APPPATH . "Views/layout/aside.php"); ?>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <?php if (session()->getFlashdata('insertProductFailed')) : ?>
        <script>
            swal({
            position: 'top-end',
            icon: 'error',
            title: 'Failed to Insert New Product!',
            showConfirmButton: false,
            timer: 2500
            });
        </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('ImageFailed')) : ?>
        <script>
            swal({
            position: 'top-end',
            icon: 'error',
            title: 'Please Try Another Image',
            showConfirmButton: false,
            timer: 2500
            });
        </script>
        <?php endif; ?>

        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add Product</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/product/index'); ?>">Product</a></li>
                                <li class="breadcrumb-item active">Add Product</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <form method="POST" action="<?php echo base_url('product/store');?>" name="createorder" enctype="multipart/form-data">
                <div class="card" style="margin: 0 10px 10px; padding:0 10px 10px">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="productname" id="productname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="productquantity" id="productquantity" class="form-control" required min="0">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="productprice" id="productprice" class="form-control" required min="0">
                        </div>
                        <div class="form-group">
                            <label>Picture</label>
                            <div class="col">
                                <input type="file" name="productpicture" id="productpicture" class="custom-file-input" oninput="changeName()">
                                <label class="custom-file-label" for="productpicture" id="productpicturename">Choose File</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="productdesc" id="productdesc" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <div class="input-group-append">
                                <input type="number" min="0" name="productweight" id="productweight" class="form-control" required>
                                <span class="input-group-text">gr</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Volume</label>
                            <div class="input-group-append">
                                <input type="number" min="0" name="productvolume" id="productvolume" class="form-control" required>
                                <span class="input-group-text">m³</span>
                            </div>
                        </div>
                    </div>
                    <div class="float-right" style="padding:5px 25px 0 0">
                        <button type="submit" class="btn btn-block btn-success" style="width:10%;float:right;">Submit</button>
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
    <script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>

    <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
    var row = 0;
  </script>

    <script>

    function changeName() {
        var file = document.getElementById("productpicture");
        var name = file.files[0].name;
        document.getElementById("productpicturename").innerHTML = name;
    }

    function deleteProdukData(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("product_table").deleteRow(i);
    }

    function showHarga(row) {
      var id_produk = $(`#get_product${row}`).val();
      $.ajax({
        url: `<?php echo base_url('order/get_price')?>/${id_produk}`,
        type: "GET",
        dataType: "JSON",
        success: function(respond) {
          $(`#harga_produk${row}`).text("Rp. " + respond['data_price'][0]['price']);
          $(`#kuantitas_produk${row}`).text(respond['data_price'][0]['quantity']);
        }
      });
    }
    </script>

    <script>
        function getCellValues() {
            let arr_table = []
            var table = document.getElementById('cust-table');
            for (var r = 0, n = table.rows.length; r < n - 1; r++) {
                arr_table[r] = new Array();
                for (var i = 1, j = table.rows.length; i <= j - 1; i++) {
                    arr_table[r]["nama"] = table.rows[i].cells[0].innerHTML;
                    arr_table[r]["alamat"] = table.rows[i].cells[1].innerHTML;
                    arr_table[r]["kuantitas"] = table.rows[i].cells[2].innerHTML;
                    arr_table[r]["barang"] = table.rows[i].cells[3].innerHTML;
                    arr_table[r]["gudang"] = table.rows[i].cells[4].innerHTML;

                }
            }
            console.log(arr_table[0]["nama"]);
            return false;
            $('#list_customer_ids').val(arr_table); //ini kirim ke input hidden dalam form supaya bisa disend dalam form submit method post
        }
    </script>


    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>