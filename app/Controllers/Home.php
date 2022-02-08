<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->findAll();
        $count_order = count($order);

        return view('dashboard', compact('count_order'));
    }
}
