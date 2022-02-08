<?php

namespace App\Controllers;


class OrderController extends BaseController
{

    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }

    public function index()
    {
        return view('order/index');
    }

    public function view($id)
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->get_detail($id)->getResultArray();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_harga'] = MoneyFormatController::money_format_rupiah($order[$i]['total_harga']);
            $order[$i]['ongkos_kirim'] = MoneyFormatController::money_format_rupiah($order[$i]['ongkos_kirim']);
        }

        return view('order/view', compact('order'));
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('customer_id', $_SESSION['id'])->where('status !=', 'CANCELLED')->where('deleted_at', null)->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
        }

        return json_encode($order);
    }
}
