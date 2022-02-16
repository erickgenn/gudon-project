<?php

namespace App\Controllers;

use Exception;

class OrderAdminController extends BaseController
{

    public function index()
    {
        return view('admin/order/index');
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel
            ->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
        }

        return json_encode($order);
    }

    public function confirm($order_id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        try {
            $order = $orderModel->updateConfirm($order_id);
            $session->setFlashdata('update_success', 'Order Telah Dikonfirmasi!');
        } catch (Exception $e) {
            $session->setFlashdata('update_fail', 'Order Gagal Dikonfirmasi!');
        }
        return redirect()->to('admin/order/index');
    }

    public function delete($id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        $detailOrderModel = new \App\Models\DetailOrderModel();
        try {

            $detailOrderModel->detailDelete($id);

            $orderModel->deleteOrder($id);

            $session->setFlashdata('msg_success', 'Order Telah Dihapus!');
        } catch (Exception $e) {
            $session->setFlashdata('msg_fail', 'Order Gagal Dihapus!');
        }
        return redirect()->to('admin/order/index');
    }
}
