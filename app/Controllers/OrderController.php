<?php namespace App\Controllers;


class OrderController extends BaseController
{

    //forms
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

    public function search(){
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->where('status !=', 'CANCELLED')->where('deleted_at', null)->findAll();

        return json_encode($order);
    }

    public function create()
    {
        return view('order/create_order');
    }
}
