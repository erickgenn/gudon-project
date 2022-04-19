<?php

namespace App\Controllers;

use \App\Models\OrderModel;
use \App\Models\CreateOrderTemp;
use App\Models\DetailOrderModel;
use App\Models\NotificationModel;
use \App\Models\ProductModel;
use App\Models\StorageModel;
use \App\Models\Warehouse;

use DateTime;
use Exception;
use DateInterval;

date_default_timezone_set("Asia/Jakarta");

class OrderController extends BaseController
{


    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }

    public function index()
    {
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        $cust_data['customer_data'] = [
            'notification' => $notif
        ];
        return view('order/index', $cust_data);
    }

    public function view($id)
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->get_detail($id)->getResultArray();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_harga'] = MoneyFormatController::money_format_rupiah($order[$i]['total_harga']);
            $order[$i]['ongkos_kirim'] = MoneyFormatController::money_format_rupiah($order[$i]['ongkos_kirim']);
        }
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'order' => $order
        ];

        return view('order/view', $cust_data);
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->orderBy('created_at', 'desc')
            ->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
            $order[$i]['created_at'] = date_format(date_create($order[$i]['created_at']), 'Y/m/d H:i');
        }

        return json_encode($order);
    }

    public function searchDetail($id)
    {
        $orderModel = new \App\Models\OrderModel();
        $order = $orderModel->get_detail($id)->getResultArray();
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_harga'] = MoneyFormatController::money_format_rupiah($order[$i]['total_harga']);
            $order[$i]['ongkos_kirim'] = MoneyFormatController::money_format_rupiah($order[$i]['ongkos_kirim']);
        }

        return json_encode($order);
    }


    public function create()
    {
        $orderModel = new ProductModel();
        $orderModel1 = new Warehouse();
        $data['groupproduct'] = $orderModel->where('customer_id', $_SESSION["id"])->where('storage_id is NOT NULL', NULL, FALSE)->findAll();
        $data['groupwarehouse'] = $orderModel1->get_warehouse_id()->getResultArray();

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'data' => $data
        ];
        return view('order/create_order', $cust_data);
    }

    public function store()
    {
        $session = session();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();
        $detailOrderModel = new DetailOrderModel();
        $storageModel = new StorageModel();

        try {
            $data = $this->request->getPost();
            //Untuk mencari warehouse_id
            $product = $productModel->find($this->request->getPost('id_produk')); //isi find adalah array dari id Product

            $warehouse_id_arr = [];
            $total_price = 0;
            $temp_data_produk = $this->request->getPost('data_produk');
            //get data from table addRow
            foreach ($temp_data_produk as $a) {
                $product_id = $this->request->getPost('id_produk' . $a);
                $product_row =  $productModel->where('id', $product_id)->first();
                $product_qty = $product_row['quantity'];
                $product_price = $product_row['price'];
                $qty = $this->request->getPost('detail_quantity' . $a);
                $total_price = $total_price + ($product_price * $qty);
                $data_update_product = [
                    'quantity' => $product_qty - $qty
                ];
                $productModel->update($product_id, $data_update_product); //kurangin qty product di DB

                $storage_id = $productModel->where('id', $product_id)->findColumn('storage_id');
                $warehouse = $storageModel->where('id', $storage_id)->first();
                $warehouse_id = $warehouse['warehouse_id'];
                if (!in_array($warehouse_id, $warehouse_id_arr)) {
                    array_push($warehouse_id_arr, $warehouse_id);
                }
            }

            $data['warehouse_id'] = implode(",", array_filter($warehouse_id_arr));
            $data_order = [
                'customer_id' => $_SESSION['id'],
                'warehouse_id' => $data['warehouse_id'],
                'destination_address' => $data['alamat'],
                'destination_phone' => $data['notelp'],
                'total_price' => $total_price,
                'delivery_price' => (int)$data['service_id'],
                'destination_name' => $data['namacust'],
                'delivery_courier' => $data['delivery_courier']
            ];
            $order_insert = $orderModel->insert($data_order); //insert mst_order

            if ($order_insert) {
                $order_id = $orderModel->getInsertID();
            }
            foreach ($temp_data_produk as $a) {
                $product_id = $this->request->getPost('id_produk' . $a);
                $product_qty = $this->request->getPost('detail_quantity' . $a);
                $data_detail = [
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'quantity' => $product_qty
                ];
                $detailOrderModel->insert($data_detail);
            }

            // notify
            $modelNotif = new NotificationModel();
            $data_notif = [
                'title' => 'Order Successfully Created',
                'message' => 'Hey ' . $_SESSION["name"] . ', your order was successfully created. Please wait until your order is confirmed 😊',
                'cust_id' => $_SESSION['id'],
                'link' => 'order/index',
                'adm_notified' => 1,
                'adm_message' => $_SESSION['name'] . '#' . $_SESSION['id'] . ' recently made new order, please confirm the order with number #' . $order_id
            ];
            $modelNotif->insert($data_notif);
        return redirect()->to(base_url('order/index'));
        } catch (Exception $e) {
         $session->setFlashdata('error', 'Password and Confirm Password do not match!');
        return redirect()->to(base_url('order/index'));
        }
    }

    public function get_price($id)
    {
        $model = new ProductModel();
        $response["data_price"] = $model->get_data_price($id)->getResultArray();
        echo json_encode($response);
    }


    public function delete($id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        $detailOrderModel = new \App\Models\DetailOrderModel();
        try {

            $detailOrderModel->detailDelete($id);

            $orderModel->deleteOrder($id);

            // notify
            $modelNotif = new NotificationModel();
            $data_notif = [
                'title' => 'Order Cancelled',
                'message' => 'Hey ' . $_SESSION["name"] . ', your order was recently cancelled. We will notify Warehouse admin soon. Maybe another order 😞',
                'cust_id' => $_SESSION['id'],
                'link' => 'order/index',
                'adm_notified' => 1,
                'adm_message' => $_SESSION['name'] . '#' . $_SESSION['id'] . ' recently just cancelled order with number #' . $id
            ];
            $modelNotif->insert($data_notif);

            $session->setFlashdata('msg_success', 'Order Telah Dihapus!');
        } catch (Exception $e) {
            $session->setFlashdata('msg_fail', 'Order Gagal Dihapus!');
        }
        return redirect()->to('order/index');
    }

    public static function checkOrderCancelation() {
        $modelOrder = new OrderModel();
        $order = $modelOrder->check_notified()->getResultArray();
        // dd($order);
        for($i=0; $i<count($order);$i++) {
            $order_date = $order[$i]['created_at'];
            $date = new DateTime($order_date);
            $date_end = $date->add(new DateInterval('P3D'));
            $date_now = new DateTime();
            if($date_now > $date_end) {
                $email = \Config\Services::email();
                $url_changepass = base_url('order/create_order');
                $email->setFrom('gudon.adm@gmail.com', "GuDon Admin");
                $email->setTo($order[$i]['email_customer']);
                $email->setSubject('Order Cancelled Automatically GUDON');
                $email->setMessage('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
                    <html>
                        <head>
                            <!-- Compiled with Bootstrap Email version: 1.1.2 --><meta http-equiv="x-ua-compatible" content="ie=edge">
                            <meta name="x-apple-disable-message-reformatting">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <style type="text/css">
                            body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.p-4:not(table),.p-4:not(.btn)>tbody>tr>td,.p-4.btn td a{padding:16px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}}
                            </style>
                            <link rel="preconnect" href="https://fonts.googleapis.com">
                            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                        </head>
                        <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                            <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                            <tbody>
                                <tr>
                                <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
                                    <table class="container-fluid" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 0 16px;" align="left">
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                            &#160;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                        <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">
                                                            <table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">
                                                                        <div style="background-color: #5cc5e6; color: #FFFFFF; padding: 20px 0px 20px 20px;">
                                                                            <div class="row" style="margin-right: -24px;">
                                                                                <table class="" role="presentation" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; width: 100%;" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                    <div style="display: flex;">
                                                                                        <img class="img-fluid" src="https://drive.google.com/uc?export=view&id=1MhwB2pLXtUv4oejYg30KB7_vmo7X3CPy" allow="autoplay" alt="GuDon" style="display: block; width: auto; height: 100px; max-width: 100%; max-height: 90%; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">
                                                                                        <div style="margin: auto 0; width: 50%; padding:25px">
                                                                                            <h2 style="font-weight: bold; font-size: 4vmin; padding-top: 0; padding-bottom: 0; vertical-align: center; line-height: 38.4px; margin: 0;" align="LEFT">GUDON</h2>
                                                                                        </div>
                                                                                    </div>
                                                                                    </tr>
                                                                                </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <table class="p-4" role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody style="font-family: Roboto, sans-serif;">
                                                                            <tr>
                                                                                <td style="line-height: 24px; font-size: 16px; margin: 0; padding: 16px;" align="left">
                                                                                    <div class="">
                                                                                    <h5 class="text-muted" style="font-size: 2vmin; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="left">Subscription Renewal</h5>
                                                                                    <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                                                &#160;
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <p style="font-size: 1.8vmin; line-height: 24px; width: 100%; margin: 0;" align="left">Hello  '.ucwords($order[$i]['nama_customer']).', your order #'.$order[$i]['order_id'].' was cancelled automatically by our system. Please create new order.</p>
                                                                                    <br>
                                                                                    <table class="btn" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center">
                                                                                                    <a href='.$url_changepass.' style="font-size: 2vh; background-color: #5cc5e6; color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; padding: 8px 12px; border: 1px solid transparent;">
                                                                                                        Create New Order
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        </table>
                                                                        <h5 class="text-muted  text-center" style="font-size: 1.5vh; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="center">&#169; GuDon</h5>
                                                                        <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                            <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                                &#160;
                                                                            </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                            &#160;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </body>
                    </html>
                ');
                $email->send();
                // notify
                $modelNotif = new NotificationModel();
                $data_notif = [
                    'title' => 'Automatic Order Cancellation',
                    'message' => NULL,
                    'cust_id' => NULL,
                    'link' => 'order/index',
                    'adm_notified' => 1,
                    'adm_message' => 'Automatic Order Cancellation Mail has been sent for '.ucwords($order[$i]['nama_customer']).' ('.$order[$i]['email_customer'].') Successful'
                ];
                $modelNotif->insert($data_notif);
                $data = [
                    'cancel_notified' => 1,
                    'status' => 'CANCELLED',
                    'delivery_status' => 'CANCELLED'
                ];
                $modelOrder->update($order[$i]['order_id'],$data);
            }
        }
    }
}
