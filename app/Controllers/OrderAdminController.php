<?php

namespace App\Controllers;

use App\Models\NotificationModel;

use DateTime;
use Exception;

date_default_timezone_set("Asia/Jakarta");

class OrderAdminController extends BaseController
{

    public function index()
    {
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('adm_notified', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            }
            else if(strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            }
            else if(strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            }
            else if(strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            }
            else if(strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            }
            else if(strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }
        $adm_data['admin_data'] = [
            'notification' => $notif
        ];
        return view('admin/order/index', $adm_data);
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->where('is_active', 1)->orderBy('created_at', 'desc')
            ->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
            $order[$i]['created_at'] = date_format(date_create($order[$i]['created_at']), 'Y/m/d H:i');
        }

        return json_encode($order);
    }

    public function confirm($order_id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        try {
            $orderModel->updateNotif($order_id);
            $orderModel->updateConfirm($order_id);
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
            $orderModel->updateNotif($id);
            $detailOrderModel->detailDelete($id);

            $orderModel->deleteOrder($id);

            $session->setFlashdata('msg_success', 'Order Telah Dihapus!');
        } catch (Exception $e) {
            $session->setFlashdata('msg_fail', 'Order Gagal Dihapus!');
        }
        return redirect()->to('admin/order/index');
    }
}
