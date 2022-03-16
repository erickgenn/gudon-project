<?php

namespace App\Controllers;

use \App\Models\OrderModel;
use \App\Models\CreateOrderTemp;
use App\Models\Delivery;
use App\Models\DetailOrderModel;
use App\Models\NotificationModel;
use \App\Models\ProductModel;
use App\Models\StorageModel;
use \App\Models\Warehouse;

use DateTime;
use Exception;

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
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            }
            else if(strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            }
            else if(strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            }
            else if(strcmp($interval->format("%s"), "0") == 1) {
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
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            }
            else if(strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            }
            else if(strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            }
            else if(strcmp($interval->format("%s"), "0") == 1) {
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
        $orderModel2 = new Delivery();
        $data['groupproduct'] = $orderModel->where('customer_id', $_SESSION["id"])->findAll();
        $data['groupwarehouse'] = $orderModel1->get_warehouse_id()->getResultArray();
        $data['groupdelivery'] = $orderModel2->findAll();

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            }
            else if(strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            }
            else if(strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            }
            else if(strcmp($interval->format("%s"), "0") == 1) {
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
            }

            for ($i = 0; $i < count($product); $i++) {
                $storage_id = (int)$product[$i]['storage_id'];
                $warehouse = $storageModel->where('id', $storage_id)->first();
                $warehouse_id = $warehouse['warehouse_id'];
                if (!in_array($warehouse_id, $warehouse_id_arr)) {
                    array_push($warehouse_id_arr, $warehouse_id);
                }
            }
            $data['warehouse_id'] = implode(",", $warehouse_id_arr);

            $data_order = [
                'customer_id' => $_SESSION['id'],
                'warehouse_id' => $data['warehouse_id'],
                'destination_address' => $data['alamat'],
                'destination_phone' => $data['notelp'],
                'total_price' => $total_price,
                'delivery_price' => 9000,
                'destination_name' => $data['namacust'],
                'delivery_id' => $data['tipe_pengiriman']
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
                'message' => 'Hey '.$_SESSION["id"].', your order was successfully created. Please wait until your order is confirmed 😊',
                'cust_id' => $_SESSION['id'],
                'link' => 'order/index'
            ];
            $modelNotif->insert($data_notif);
        } catch (Exception $e) {
        }
        return redirect()->to(base_url('order/index'));
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

            $session->setFlashdata('msg_success', 'Order Telah Dihapus!');
        } catch (Exception $e) {
            $session->setFlashdata('msg_fail', 'Order Gagal Dihapus!');
        }
        return redirect()->to('order/index');
    }
}
