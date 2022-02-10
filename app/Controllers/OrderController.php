<?php

namespace App\Controllers;

use \App\Models\OrderModel;
use \App\Models\CreateOrderTemp;
use App\Models\DetailOrderModel;
use \App\Models\ProductModel;
use App\Models\StorageModel;
use \App\Models\Warehouse;
use Exception;

class OrderController extends BaseController
{

    //forms
    function __construct()
    {
        $this->group = new OrderModel();
    }

    public function index()
    {
        return view('order/index');
    }

    public function view($id)
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->get_detail($id)->getResultArray();
        return view('order/view', compact('order'));
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->where('status !=', 'CANCELLED')->where('deleted_at', null)->findAll();

        return json_encode($order);
    }

    public function create()
    {
        $orderModel = new ProductModel();
        $orderModel1 = new Warehouse();
        $data['groupproduct'] = $orderModel->where('customer_id', $_SESSION["id"])->findAll();
        $data['groupwarehouse'] = $orderModel1->get_warehouse_id()->getResultArray();
        return view('order/create_order', $data);
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

            // $product = $productModel->find($this->request->getPost('product_id')); //isi find adalah array dari id Product
            $product = $productModel->find([2, 3]); //isi find adalah array dari id Product

            $warehouse_id_arr = [];
            $total_price = 0;
            $temp_data_produk = $this->request->getPost('data_produk');
            //get data from table addRow
            foreach ($temp_data_produk as $a) {
                $product_id = $this->request->getPost('product_id' . $a);
                $product_qty = $this->request->getPost('product_qty' . $a);
                $qty = $this->request->getPost('qty' . $a);
                $product_price = $this->request->getPost('harga' . $a);
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
                'destination_phone' => $data['phone'],
                'total_price' => $total_price,
                'delivery_price' => $data['delivery_price'],
                'destination_name' => $data['nama'],
                'delivery_id' => $data['delivery']
            ];

            $order_insert = $orderModel->insert($data_order); //insert mst_order
            if ($order_insert) {
                $order_id = $orderModel->getInsertID();
            }
            foreach ($temp_data_produk as $a) {
                $product_id = $this->request->getPost('product_id' . $a);
                $product_qty = $this->request->getPost('product_qty' . $a);
                $temp_qty = $this->request->getPost('qty' . $a);
                $data_detail = [
                    'order_id' => 2,
                    'product_id' => $product_id,
                    'quantity' => $temp_qty
                ];
                $detailOrderModel->insert($data_detail);
            }
        } catch (Exception $e) {
        }
        // return view('order/index');
    }

    // public function tampilDataOrder()
    // {
    //     if($this->request->isAJAX()){
    //         $nama = $this->request->getPost('nama')

    //         // $modalCreateOrderTemp = new CreateOrderTemp;
    //     }
    // }
}
