<?php

namespace App\Controllers;

class PaymentController extends BaseController
{


    public function method()
    {
        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('id', $_SESSION['id'])->first();
        $balance = MoneyFormatController::money_format_rupiah($user['balance']);
        return view('topup/method', compact('balance'));
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

        return view('topup/payment', compact('method'));
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
        $session->setFlashdata('msg_success_topup', '!');
        return redirect()->to('topup/method');
    }
}
