<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\OrderModel;

class AdminController extends BaseController
{

    public function index()
    {
        $orderModel = new OrderModel();
        $order = $orderModel->findAll();
        $order_confirm = $orderModel->where('status', 'SEDANG DIPROSES')->findAll();
        $order_success = $orderModel->where('status', 'SELESAI')->findAll();
        $order_cancel = $orderModel->where('status', 'BATAL')->findAll();
        $custModel = new Customer();
        $partners = $custModel->findAll();

        $count_partners = count($partners);
        $count_order = count($order);
        $count_order_confirm = count($order_confirm);
        $count_order_success = count($order_success);
        $count_order_cancel = count($order_cancel);
        return view('admin/dashboard', compact('count_order', 'count_order_confirm', 'count_order_success', 'count_order_cancel', 'count_partners'));
    }

    public function forbidden()
    {
        return view('forbidden');
    }
}
