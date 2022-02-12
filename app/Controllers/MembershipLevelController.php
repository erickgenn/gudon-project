<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Warehouse;
use App\Models\Shelf;
use App\Models\Customer;
use App\Models\OrderModel;

class MembershipLevelController extends BaseController
{
    public function index()
    {
        // get order count
        $orderModel = new OrderModel();
        $order = $orderModel->where('customer_id', $_SESSION['id'])->findAll();
        $count_order = count($order);

        // get balance
        $userModel = new Customer();
        $user = $userModel->get_balance($_SESSION['id'])->getResultArray();
        $user_balance = $user[0]['balance'];

        // get product count
        $modelProduct = new ProductModel();
            $total_product = 0;
            $product = $modelProduct->where('customer_id', $_SESSION['id'])->findAll();
            for($i=0;$i<sizeOf($product);$i++) {
                $total_product += $product[$i]['quantity'];
            }
            $cust_data['customer_data'] = [
                'total_product' => $total_product,
                'count_order' => $count_order,
                'user_balance' => $user_balance
            ];
        return view('membership/index', $cust_data);
    }

    public function search(){
        $model = new Warehouse;

        $warehouse = $model->where('deleted_at', null)->findAll();

        return json_encode($warehouse);
    }

    // ini untuk bagian shelf
    public function view_shelf($id)
    {
        $model = new Shelf;
        $validate = $model->cust_validate()->getResultArray();
        if(!$validate) {
            $session = session();
            $session->setFlashdata('msg', 'Silahkan daftarkan produk anda untuk melihat halaman ini');
            return view('warehouse/index');
        } else {
            $shelf['shelf'] = $model->get_shelf($id)->getResultArray();
            return view('warehouse/view', $shelf);
        }
    }

    public function view_product($id)
    {
        $model = new Shelf;
        $shelf = $model->get_detail($id)->getResultArray();
        return json_encode($shelf);
    }
}
