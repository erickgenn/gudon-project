<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\MembershipModel;
use App\Models\OrderModel;

class Home extends BaseController
{
    public function index()
    {

        // get order count
        $orderModel = new OrderModel();
        $order = $orderModel->where('customer_id', $_SESSION['id'])->findAll();
        $count_order = count($order);

        // get order successful rate
        $status_order = $orderModel->where('customer_id', $_SESSION['id'])->where('status', 'SELESAI')->findAll();
        $success_order = count($status_order);
        $percentage_order = round($success_order / $count_order * 100);

        // get order sold
        $income = 0;
        for($i=0;$i<sizeOf($status_order);$i++) {
            $income += $status_order[$i]['total_price'];
        }

        // get balance
        $userModel = new Customer();
        $user = $userModel->get_balance($_SESSION['id'])->getResultArray();
        $user_balance = $user[0]['balance'];

        // get product count
        $modelProduct = new ProductModel();
        $total_product = 0;
        $total_weight = 0;
        $product = $modelProduct->where('customer_id', $_SESSION['id'])->findAll();
        for($i=0;$i<sizeOf($product);$i++) {
            $total_product += $product[$i]['quantity'];
            $total_weight += $product[$i]['weight'] * $product[$i]['quantity'];
        }

        // get level max_weight
        $modelLevel = new MembershipModel();
        $level = $modelLevel->where('id', $_SESSION['id'])->first();
        
        $percentage_weight = round(($total_weight / $level['max_weight']) * 100);

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'income' => $income,
            'total_weight' => $percentage_weight,
            'percentage_order' => $percentage_order
        ];
        return view('dashboard', $cust_data);
    }
}
