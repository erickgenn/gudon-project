<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\LevelDetailModel;

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

        // get membership detail
        $modelLevel = new LevelDetailModel();
        $terms = $modelLevel->where('level_id', $_SESSION['level_id'])->where('benefit', null, false)->where('is_active', 1)->findAll();
        $benefit = $modelLevel->where('level_id', $_SESSION['level_id'])->where('terms', null, false)->where('is_active', 1)->findAll();

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'terms' => $terms,
            'benefit' => $benefit
        ];
        return view('membership/index', $cust_data);
    }
    
    public function index_v2()
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

        // get membership detail
        $modelLevel = new LevelDetailModel();
        $terms = $modelLevel->where('level_id', $_SESSION['level_id'])->where('benefit', null, false)->where('is_active', 1)->findAll();
        $benefit = $modelLevel->where('level_id', $_SESSION['level_id'])->where('terms', null, false)->where('is_active', 1)->findAll();

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'terms' => $terms,
            'benefit' => $benefit
        ];
        return view('membership/index_v2', $cust_data);
    }

    public function upgrade_menu() {
        return view('membership/upgrade');
    }

    // public function upgrade($id)
    // {
        
    // }
}
