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
    <!-- Select2 -->
    <link href="<?php echo base_url(); ?>/adminlte/plugins/select2/css/select2.css" rel="stylesheet" />
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <a href="<?php echo base_url('order/index') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
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
            <form method="POST" action="<?php echo base_url('order/store'); ?>" name="createorder">
                <input type="hidden" id="delivery_courier" name="delivery_courier">
                <div class="row" style="padding: 0 10px 0 10px">
                    <div class="col-md-7" style="max-height:708px; overflow-y:auto">
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
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <br>
                                        <label>Customer Name</label>
                                        <input type="text" name="namacust" id="namacust" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Phone Number</label>
                                        <input type="number" name="notelp" id="notelp" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Province</label>
                                        <select class="form-control" id="province_id" name="province_id" onchange="getKota()">
                                        </select>
                                    </div>
                                    <div id="div_kota" style="display:none;" class="form-group">
                                        <label>City</label>
                                        <select class="form-control" id="city_id" name="city_id" onchange="getKurir(); getService()">
                                        </select>
                                    </div>
                                    <div id="div_detail" style="display:none;" class="form-group">
                                        <label>Destination Address</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div id="div_kurir" class="col-6" style="display:none;">
                                            <label>Courier</label>
                                            <select class="form-control" id="kurir_name" name="kurir_name" onchange="getService()">
                                                <option value="" disabled selected>Choose Courier</option>
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS INDONESIA</option>
                                                <option value="tiki">TIKI</option>
                                            </select>
                                        </div>
                                        <div id="div_service" class="col-6" style="display:none;">
                                            <label>Service Type</label>
                                            <select class="form-control" id="service_id" name="service_id" onchange="showOngkir()">
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="div_ongkir">
                                        <label>Delivery Price</label>
                                        <p id="ongkir" class="form-control">Rp. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 tampilDataOrder">
                            </div>
                        </div>
                        <div class="float-right" style="padding:5px 25px 0 0 ">
                            <button type="submit" class="btn btn-block btn-success">Order</button>
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

    <script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Select 2 -->
    <script src="<?php echo base_url(); ?>/adminlte/plugins/select2/js/select2.min.js"></script>


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
        $(document).ready(function() {
            $('#province_id').select2({
                minimumResultsForSearch: -1,
                placeholder: 'Choose Province',
                width: 'resolve',
                ajax: {
                    dataType: 'json',
                    url: '<?php echo base_url("delivery/getprovinsi"); ?>',
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            })
        });
    </script>

    <script>
        row = 0;

        function tambahRowProduk() {
            var html = `
              <tr id = "tambahRowProduk${row}">
                <td>
                  <input type ='hidden' name='data_produk[]' value='${row}'>
                  <select class = 'js-example-basic-single form-control select2-hidden-accessible' style="width:100%;" name = 'id_produk${row}' id = 'get_product${row}' onchange="showHarga(${row}); getService();">
                    <option selected disabled>------ Choose Product ------</option>
                  <?php for ($i = 0; $i < count($customer_data['data']['groupproduct']); $i++) : ?>
                    <option value = "<?php echo $customer_data['data']['groupproduct'][$i]["id"]; ?>"><?php echo $customer_data['data']['groupproduct'][$i]["name"]; ?></option>
                  <?php endfor; ?>
                  </select>
                </td>
                <td>
                  <table>
                    <tr>
                      <td style="border:none;">Price</td>
                      <td style="border:none; text-align:right;" id="harga_produk${row}"></td>
                      <input type="hidden" id="weight_produk${row}">
                    </tr>
                    <tr>
                      <td style="border:none;">Quantity</td>
                      <td style="border:none; text-align:right;" id = "kuantitas_produk${row}"></td>
                    </tr>
                  </table>
                <td><input type = 'number' class = 'form-control nf-input' id='quantity_produk${row}' name = 'detail_quantity${row}' min="0" onkeydown="getService()" required></td>
                <td>
                  <button type = 'button' class = 'btn btn-danger btn-sm' onclick = 'deleteProdukData(this)'><i class="fa fa-fw fa-trash"></i></button>
                </td>
              </tr>
            `;
            $("#tambah_produk_button_container").before(html);
            $('.js-example-basic-single').select2();
            row++;
            getService();
            showOngkir();
        }

        function deleteProdukData(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("product_table").deleteRow(i);
        }

        function showHarga(row) {
            var id_produk = $(`#get_product${row}`).val();
            $.ajax({
                url: `<?php echo base_url('order/get_price') ?>/${id_produk}`,
                type: "GET",
                dataType: "JSON",
                success: function(respond) {
                    $(`#harga_produk${row}`).text("Rp. " + respond['data_price'][0]['price']);
                    $(`#kuantitas_produk${row}`).text(respond['data_price'][0]['quantity']);
                    $(`#weight_produk${row}`).val(respond['data_price'][0]['weight']);
                }
            });
        }

        function getKota() {
            document.getElementById("city_id").value = "";
            document.getElementById("div_kota").style.display = "block";
            let province_id = document.getElementById("province_id").value;
            $('#city_id').select2({
                minimumResultsForSearch: -1,
                placeholder: 'Choose City',
                width: 'resolve',
                ajax: {
                    dataType: 'json',
                    url: '<?php echo base_url(); ?>/delivery/getcity/' + province_id,
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            })
        }

        function getKurir() {
            document.getElementById("kurir_name").value = "";
            document.getElementById("div_detail").style.display = "block";
            document.getElementById("div_kurir").style.display = "block";
            document.getElementById("div_service").style.display = "block";
        }

        function showOngkir() {
            let price = document.getElementById("service_id").value;
            $(`#ongkir`).text("Rp. " + price);
            let courier = $("#kurir_name option:selected").text();
            let service = $("#service_id option:selected").text();
            let courier_name = courier + " " + service;
            document.getElementById("delivery_courier").value = courier_name;
        }

        function getService() {
            $(`#ongkir`).text("Rp. ");
            document.getElementById("service_id").value = "";
            let destination_id = document.getElementById("city_id").value;
            let courier_name = document.getElementById('kurir_name').value;
            let total_weight = 0;
            for (let i = 0; i < row; i++) {
                var id_produk = $(`#get_product${i}`).val();
                var quantity_produk = $(`#quantity_produk${i}`).val();
                var weight_produk = $(`#weight_produk${i}`).val();

                total_weight = total_weight + (quantity_produk * weight_produk);
            }

            $(document).ready(function() {
                $('#service_id').select2({
                    minimumResultsForSearch: -1,
                    placeholder: 'Choose Service',
                    width: 'resolve',
                    ajax: {
                        dataType: 'json',
                        url: '<?php echo base_url(""); ?>/delivery/getservice/' + destination_id + "/" + total_weight + "/" + courier_name,
                        processResults: function(data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                })
            });


        }
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>