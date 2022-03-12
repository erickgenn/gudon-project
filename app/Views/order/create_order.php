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


</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
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
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/order/index'); ?>">Order</a></li>
                                <li class="breadcrumb-item active">Create Order</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <form method="POST" action="<?php echo base_url('order/store');?>" name="createorder">
                <div class="row" style="padding: 0 10px 0 10px">
                    <div class="col-md-4">
                        <div class="card" >
                            <div class="card-body">
                                <div class="col-lg-12" >
                                    <div class="form-group">
                                        <br>
                                        <label>Customer Name</label>
                                        <input type="text" name="namacust" id="namacust" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Phone Number</label>
                                        <input type="text" name="notelp" id="notelp" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Destination Address</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Shipment Type</label>
                                        <select class = 'form-control' style="width:100%;" name="tipe_pengiriman" id = 'tipe_pengiriman'>
                                            <option selected disabled>------ Choose Shipment Type ------</option>
                                        <?php for ($i = 0; $i < count ($groupdelivery); $i++) : ?>
                                            <option value = "<?php echo $groupdelivery[$i]["id"]; ?>"><?php echo $groupdelivery[$i]["name"]; ?></option>
                                        <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8" style="max-height:408px; overflow-y:auto">
                        <div class="card">
                            <div class="card-body" style="min-height:407px">
                                <div class="col-lg-12">
                                    <table class="table table-bordered dataTable table-sm" id="product_table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <td>Product name</td>
                                                <td>Product Information</td>
                                                <td>Quantity</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr id="tambah_produk_button_container">
                                            <td colspan=4>
                                            <button type="button" class="btn btn-sm col-lg-12" style="background-color: #5cc5e6; color:white;" onclick="tambahRowProduk()">Add Product</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 tampilDataOrder">
                        </div>
                    </div>
                </div>
                <div class="float-right" style="padding:5px 25px 0 0 ">
                    <button type="submit" class="btn btn-block btn-success">Order</button>
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
    function tambahRowProduk() {
      var html = `
              <tr id = "tambahRowProduk${row}">
                <td>
                  <input type ='hidden' name='data_produk[]' value='${row}'>
                  <select class = 'js-example-basic-single form-control select2-hidden-accessible' style="width:100%;" name = 'id_produk${row}' id = 'get_product${row}' onchange="showHarga(${row})">
                    <option selected disabled>------ Choose Product ------</option>
                  <?php for ($i = 0; $i < count ($groupproduct); $i++) : ?>
                    <option value = "<?php echo $groupproduct[$i]["id"]; ?>"><?php echo $groupproduct[$i]["name"]; ?></option>
                  <?php endfor; ?>
                  </select>
                </td>
                <td>
                  <table>
                    <tr>
                      <td style="border:none;">Price</td>
                      <td style="border:none; text-align:right;" id="harga_produk${row}"></td>
                    </tr>
                    <tr>
                      <td style="border:none;">Quantity</td>
                      <td style="border:none; text-align:right;" id = "kuantitas_produk${row}"></td>
                    </tr>
                  </table>
                <td><input type = 'number' class = 'form-control nf-input' name = 'detail_quantity${row}' min="0" required></td>
                <td>
                  <button type = 'button' class = 'btn btn-danger btn-sm' onclick = 'deleteProdukData(this)'><i class="fa fa-fw fa-trash"></i></button>
                </td>
              </tr>
            `;
      $("#tambah_produk_button_container").before(html);
      $('.js-example-basic-single').select2();
      row++;
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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>