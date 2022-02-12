<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\OrderModel;

class Home extends BaseController
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

        return view('dashboard', $cust_data);
    }
}
