<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\DetailOrderModel;
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
        if ($count_order == 0) {
            $percentage_order = 0;
        } else {
            $percentage_order = round($success_order / $count_order * 100);
        }

        // get order sold
        $income = 0;
        for ($i = 0; $i < sizeOf($status_order); $i++) {
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
        for ($i = 0; $i < sizeOf($product); $i++) {
            $total_product += $product[$i]['quantity'];
            $total_weight += $product[$i]['weight'] * $product[$i]['quantity'];
        }

        // get level max_weight
        $modelLevel = new MembershipModel();
        $level = $modelLevel->where('id', $_SESSION['level_id'])->first();
        if ($level['max_weight'] == 0) {
            $percentage_weight = 0;
        } else {
            $percentage_weight = round(($total_weight / $level['max_weight']) * 100);
        }

        $data_per_item = $modelProduct->select('COUNT(id) AS jumlah, name AS nama')->where('customer_id', $_SESSION['id'])
                        ->groupby('id')->findAll();
        
      

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'income' => $income,
            'total_weight' => $percentage_weight,
            'percentage_order' => $percentage_order,
            'data_per_item'=> $data_per_item,
            'product'=> $product
        ];
       

        $date_monday = date("Y-m-d", strtotime("Monday This Week"));
        $date_tuesday = date("Y-m-d", strtotime("Tuesday This Week"));
        $date_wednesday = date("Y-m-d", strtotime("Wednesday This Week"));
        $date_thursday = date("Y-m-d", strtotime("Thurday This Week"));
        $date_friday = date("Y-m-d", strtotime("Friday This Week"));
        $date_saturday = date("Y-m-d", strtotime("Saturday This Week"));
        $date_sunday = date("Y-m-d", strtotime("Sunday This Week"));

        $monday = $orderModel->countOrderDate($date_monday)->getResultArray();
        $tuesday = $orderModel->countOrderDate($date_tuesday)->getResultArray();
        $wednesday = $orderModel->countOrderDate($date_wednesday)->getResultArray();
        $thursday = $orderModel->countOrderDate($date_thursday)->getResultArray();
        $friday = $orderModel->countOrderDate($date_friday)->getResultArray();
        $saturday = $orderModel->countOrderDate($date_saturday)->getResultArray();
        $sunday = $orderModel->countOrderDate($date_sunday)->getResultArray();

        $cust_data['count_order'] = [count($monday), count($tuesday), count($wednesday), count($thursday), count($friday), count($saturday), count($sunday)];

        
      
        return view('dashboard', $cust_data);
    }

    public function searchBestProducts()
    {
        $detailOrderModel = new DetailOrderModel();
        $result = $detailOrderModel->getMostSoldProduct()->getResultArray();
        return json_encode($result);
    }
}
