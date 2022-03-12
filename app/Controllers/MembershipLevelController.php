<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\LevelDetailModel;
use App\Models\MembershipModel;
use App\Models\Subscription;
use DateInterval;
use DateTime;

class MembershipLevelController extends BaseController
{
    public function index()
    {
        // get order count
        $orderModel = new OrderModel();
        $order = $orderModel->where('customer_id', $_SESSION['id'])->findAll();
        $count_order = count($order);

        // get balance
        $userModel = new Customer();
        $user = $userModel->get_balance($_SESSION['id'])->getResultArray();
        $user_balance = $user[0]['balance'];

        // get product count
        $modelProduct = new ProductModel();
        $total_product = 0;
        $product = $modelProduct->where('customer_id', $_SESSION['id'])->findAll();
        for ($i = 0; $i < sizeOf($product); $i++) {
            $total_product++;
        }

        // get membership detail
        $modelLevel = new LevelDetailModel();
        $terms = $modelLevel->where('level_id', $_SESSION['level_id'])->where('benefit', null, false)->where('is_active', 1)->findAll();
        $benefit = $modelLevel->where('level_id', $_SESSION['level_id'])->where('terms', null, false)->where('is_active', 1)->findAll();

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'terms' => $terms,
            'benefit' => $benefit
        ];
        return view('membership/index', $cust_data);
    }

    public function upgrade_menu()
    {
        // get membership names
        $modelLevel = new MembershipModel();
        $membership_level = $modelLevel->where('is_active', 1)->findAll();

        // get membership detail
        $modelDetailLevel = new LevelDetailModel();
        for ($i = 0; $i < sizeof($membership_level); $i++) {
            $terms[$i] = $modelDetailLevel->where('level_id', $i + 1)->where('benefit', null, false)->where('is_active', 1)->findAll();
        }
        for ($i = 0; $i < sizeof($membership_level); $i++) {
            $benefit[$i] = $modelDetailLevel->where('level_id', $i + 1)->where('terms', null, false)->where('is_active', 1)->findAll();
        }

        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('id', $_SESSION['id'])->first();
        $balance = MoneyFormatController::money_format_rupiah($user['balance']);

        $membership_data['membership_data'] = [
            'membership' => $membership_level,
            'terms' => $terms,
            'benefit' => $benefit
        ];

        $membership_data['balance'] = [
            'balance' => $balance
        ];

        return view('membership/upgrade', $membership_data);
    }

    public function upgrade($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $session = session();

        $membershipService = new MembershipModel();
        $modelDetailLevel = new LevelDetailModel();
        $subscriptionModel = new Subscription();

        $subs = $subscriptionModel->where('cust_id', $_SESSION['id'])->where('is_active', 1)->first();
        $subscription_date = $subs['subscription_date'];
        $date = new DateTime($subscription_date);
        $date_end = $date->add(new DateInterval('P30D'));
        $now = new DateTime();

        if ($now < $date_end) {
            $session->setFlashdata('msg_available_sub', '!');
        }

        $membership = $membershipService->where('id', $id)->first();
        $detail_level = $modelDetailLevel->where('level_id', $id)->where('terms !=', null)->findColumn('terms');

        return view('membership/payment', compact('id', 'membership', 'detail_level'));
    }

    public function payment()
    {
        date_default_timezone_set('Asia/Jakarta');
        $session = session();
        $data = $this->request->getPost();
        $password = md5($data['password']);

        $authModel = new \App\Models\AuthModel();
        $membershipService = new MembershipModel();

        $user = $authModel->where('id', $_SESSION['id'])->where('password', $password)->first();

        if (isset($user)) {
            $getBalance = $authModel->where('id', $_SESSION['id'])->findColumn('balance');
            $getPrice = $membershipService->where('id', $data['level_id'])->findColumn('price');
            $balance = (int) $getBalance[0];
            $price =  (int) $getPrice[0];

            if ($balance < $price) {
                $session->setFlashdata('msg_balance_fail', 'Password is incorrect!');
                return redirect()->to('membership/upgrade' . '/' . $data['level_id']);
            } else {
                $subscriptionModel = new Subscription();

                // Update Membership
                $subscribe = $subscriptionModel->where('cust_id', $_SESSION['id'])->where('is_active', 1)->first();
                if (isset($subscribe) || !isset($subscribe)) {
                    $subscriptionModel->where('cust_id', $_SESSION['id'])->where('is_active', 1)->delete();
                    $data_subscription = [
                        'cust_id' => $_SESSION['id'],
                        'level_id'    => $data['level_id'],
                    ];

                    $subscriptionModel->insert($data_subscription);
                }

                // Update Balance
                $new_balance = $balance - $price;

                $data_update = [
                    'balance' => $new_balance,
                ];
                $authModel->update($_SESSION['id'], $data_update);


                $subs = $subscriptionModel->where('cust_id', $user['id'])->where('is_active', 1)->first();
                $user = $authModel->where('id', $_SESSION['id'])->where('password', $password)->first();
                $subscription_date = $subs['subscription_date'];
                $date = new DateTime($subscription_date);
                $date->add(new DateInterval('P30D'));
                $time_left = round((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24));
                $percentage_left = round($time_left / 30 * 100);

                // get user membership level name
                $levelModel = new MembershipModel();
                $level = $levelModel->where('id', $subs['level_id'])->first();
                if (isset($user)) {
                    $session_data = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'level_id' => $subs['level_id'],
                        'level' => $level['name'],
                        'time_left' => $time_left,
                        'percentage_left' => $percentage_left,
                        'isLoggedIn' => TRUE,
                        'role' => 'customer'
                    ];
                    $session->set($session_data);
                }

                $session->setFlashdata('payment_success', 'Payment Successful!');
                return redirect()->to('membership/index');
            }
        } else {
            $session->setFlashdata('msg_password_fail', 'Password is incorrect!');
            return redirect()->to('membership/upgrade' . '/' . $data['level_id']);
        }
    }
}
