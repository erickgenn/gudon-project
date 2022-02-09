<?php

namespace App\Controllers;

use Exception;

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

        $order = $orderModel->where('customer_id', $_SESSION['id'])
            ->where('is_active', 1)
            ->where('status !=', 'CANCELLED')
            ->where('deleted_at', null)
            ->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
        }

        return json_encode($order);
    }

    public function delete($id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        $detailOrderModel = new \App\Models\DetailOrderModel();
        try {
            $data = [
                'is_active' => 0,
            ];

            $detailOrderModel->detailDelete($id);
            $detailOrderModel->where('order_id', $id)->delete();

            $orderModel->update($id, $data);
            $orderModel->where('id', $id)->delete();

            $session->setFlashdata('msg_success', 'Order Telah Dihapus!');
        } catch (Exception $e) {
            $session->setFlashdata('msg_fail', 'Order Gagal Dihapus!');
        }
        return redirect()->to('order/index');
    }
}
