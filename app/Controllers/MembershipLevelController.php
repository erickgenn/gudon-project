<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\LevelDetailModel;
use App\Models\MembershipModel;
use App\Models\Subscription;
use DateInterval;
use DateTime;

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

        // get subscription status
        $modelSubs = new Subscription();
        $subs = $modelSubs->where('cust_id', $_SESSION['id'])->where('is_active', 1)->first();
        $subscription_date = $subs['subscription_date'];
        $date = new DateTime($subscription_date);
        $date->add(new DateInterval('P30D'));
        $time_left = round((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24));
        $percentage_left = round($time_left/30*100);

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'terms' => $terms,
            'benefit' => $benefit,
            'time_left' => $time_left,
            'percentage_left' => $percentage_left
        ];
        return view('membership/index_v2', $cust_data);
    }

    public function upgrade_menu() 
    {
        // get membership names
        $modelLevel = new MembershipModel();
        $membership_level = $modelLevel->where('is_active', 1)->findAll();

        // get membership detail
        $modelDetailLevel = new LevelDetailModel();
        for($i=0;$i<sizeof($membership_level);$i++) {
            $terms[$i] = $modelDetailLevel->where('level_id', $i+1)->where('benefit', null, false)->where('is_active', 1)->findAll();
        }
        for($i=0;$i<sizeof($membership_level);$i++) {
            $benefit[$i] = $modelDetailLevel->where('level_id', $i+1)->where('terms', null, false)->where('is_active', 1)->findAll();
        }

        $membership_data['membership_data'] = [
            'membership' => $membership_level,
            'terms' => $terms,
            'benefit' => $benefit
        ];

        return view('membership/upgrade', $membership_data);
    }

    public function upgrade($id)
    {
        return view('membership/upgrade');
    }
}
