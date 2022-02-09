<?php namespace App\Controllers;

use \App\Models\OrderModel;
use \App\Models\CreateOrderTemp;
use \App\Models\ProductModel;
use \App\Models\Warehouse;


class OrderController extends BaseController
{

    //forms
    function __construct(){
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

    public function search(){
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->where('status !=', 'CANCELLED')->where('deleted_at', null)->findAll();

        return json_encode($order);
    }

    public function create()
    {
        $orderModel = new ProductModel();
        $orderModel1 = new Warehouse();
        $data['groupproduct'] = $orderModel->findAll();
        $data['groupwarehouse'] = $orderModel1->findAll();
        
        return view('order/create_order', $data);
    }

    // public function tampilDataOrder()
    // {
    //     if($this->request->isAJAX()){
    //         $nama = $this->request->getPost('nama')

    //         // $modalCreateOrderTemp = new CreateOrderTemp;
    //     }
    // }
}
