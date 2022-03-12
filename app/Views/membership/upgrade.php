<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudOn | Membership Upgrade</title>

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
                            <a href="<?php echo base_url('/membership/index') ?>" style="color:grey;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                            <h1 class="m-0">Upgrade Membership</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('/membership/index'); ?>">Membership</a></li>
                                <li class="breadcrumb-item active">Upgrade Membership</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <br>

                </div><!-- /.container-fluid -->
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <center>
                            <div class="alert alert-info bg-primary">
                                <h4><i class="icon fas fa-info"></i>Your Balance:</h4>
                                <h3><?php echo $balance['balance']; ?></h3>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <form method="POST" action="<?php echo base_url('order/store'); ?>" name="upgradelevel">
                <div class="row" style="margin: 10px">
                    <table align="center" style="display:grid; grid-auto-columns: minmax(0, 4fr); grid-auto-flow: column;">
                        <tbody>
                            <tr>
                                <?php for ($i = 0; $i < sizeof($membership_data); $i++) : ?>
                                    <td>
                                        <div class="card card-default" style="max-width: 500px">
                                            <div class="card-header p-2">
                                                <div style="text-align:center; margin: 20px; padding:20px 30px; font-size:20px; font-weight:bold;">
                                                    <?php echo $membership_data['membership'][$i]['name']; ?>
                                                </div>
                                                <div>
                                                    <ul class="nav nav-pills">
                                                        <li class="nav-item"><a class="nav-link active" href="#benefit<?php echo $i ?>" data-toggle="tab">Benefit</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="#tnc<?php echo $i ?>" data-toggle="tab">Terms & Condition</a></li>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="benefit<?php echo $i ?>">
                                                            <ul>
                                                                <?php for ($j = 0; $j < sizeof($membership_data['benefit'][$i]); $j++) : ?>
                                                                    <li><?php echo $membership_data['benefit'][$i][$j]['benefit']; ?></li>
                                                                <?php endfor ?>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="tnc<?php echo $i ?>">
                                                            <ul>
                                                                <?php for ($j = 0; $j < sizeof($membership_data['terms'][$i]); $j++) : ?>
                                                                    <li><?php echo $membership_data['terms'][$i][$j]['terms']; ?></li>
                                                                <?php endfor ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div style="text-align:center;">
                                                        <a href="<?php echo base_url('membership/upgrade') . '/' . $membership_data['membership'][$i]['id'] ?>" class="btn btn-block btn-outline-dark" style="color:#55c5e6; border:none; box-shadow: rgb(49 53 59 / 12%) 5px 5px 10px 5px;">Rp <?php echo number_format($membership_data['membership'][$i]['price']); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                </div>
            <?php endfor; ?>
            </tr>
            </tbody>
            </table>
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
                    <option selected disabled>------ Pilih Produk ------</option>
                  
                  </select>
                </td>
                <td>
                  <table>
                    <tr>
                      <td style="border:none;">Harga</td>
                      <td style="border:none; text-align:right;" id="harga_produk${row}"></td>
                    </tr>
                    <tr>
                      <td style="border:none;">Kuantitas</td>
                      <td style="border:none; text-align:right;" id = "kuantitas_produk${row}"></td>
                    </tr>
                  </table>
                <td><input type = 'text' class = 'form-control nf-input' name = 'detail_quantity${row}' min="0"></td>
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
                url: `<?php echo base_url('order/get_price') ?>/${id_produk}`,
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



    <!-- <script type="text/javascript">
    function addRow()
    {
        
        var nama=document.createorder.nama.value;
        var alamat=document.createorder.alamat.value;
        var kuantitas=document.createorder.kuantitas.value;
        var barang = $( "#barang option:selected" ).text();
       
        // var barang=document.createorder.barang.id;
        alert(warehouse);
        var tr =  document.createElement('tr');

        var td1 =  tr.appendChild(document.createElement('td'));
        var td2 =  tr.appendChild(document.createElement('td'));
        var td3 =  tr.appendChild(document.createElement('td'));
        var td4 =  tr.appendChild(document.createElement('td'));
        

        td1.innerHTML=nama;
        td2.innerHTML=alamat;
        td3.innerHTML=kuantitas;
        td4.innerHTML=barang;
       

        document.getElementById("cust-table").appendChild(tr);
    }
</script> -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>