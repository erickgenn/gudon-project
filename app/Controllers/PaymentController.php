<?php

namespace App\Controllers;

use App\Models\NotificationModel;

use DateTime;

date_default_timezone_set("Asia/Jakarta");

class PaymentController extends BaseController
{


    public function method()
    {
        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('id', $_SESSION['id'])->first();
        $balance = MoneyFormatController::money_format_rupiah($user['balance']);
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%d"), "0") == 1) {
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

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'balance' => $balance
        ];
        return view('topup/method', $cust_data);
    }

    public function view($method)
    {
        if ($method == 'ovo') {
            $method = "OVO";
        }
        if ($method == 'gopay') {
            $method = "GoPay";
        }
        if ($method == 'mbca') {
            $method = "M-BCA";
        }
        if ($method == 'qris') {
            $method = "QRIS";
        }
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%d"), "0") == 1) {
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

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'method' => $method
        ];

        return view('topup/payment', $cust_data);
    }

    public function store()
    {
        $session = session();
        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('id', $_SESSION['id'])->first();
        $data = $this->request->getPost();

        $new_balance = (int) $user['balance'] + (int)$data['amount'];

        $data = [
            'balance' => $new_balance,
        ];
        $authModel->update($_SESSION['id'], $data);

        $user = $authModel->where('id', $_SESSION['id'])->first();
        $balance = $user['balance'];

        // notify
        $modelNotif = new NotificationModel();
        $data_notif = [
            'title' => 'Topup Successfully',
            'message' => 'Hey '.$_SESSION["name"].', your topup was successful. Use your balance wisely 💰',
            'cust_id' => $_SESSION['id'],
            'link' => 'topup/method'
        ];
        $modelNotif->insert($data_notif);
        $session->setFlashdata('msg_success_topup', '!');
        return redirect()->to('topup/method');
    }
}
