<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\LevelDetailModel;
use App\Models\MembershipModel;
use App\Models\Subscription;
use App\Models\NotificationModel;

use DateInterval;
use DateTime;

date_default_timezone_set("Asia/Jakarta");

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

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'total_product' => $total_product,
            'count_order' => $count_order,
            'user_balance' => $user_balance,
            'terms' => $terms,
            'benefit' => $benefit,
            'notification' => $notif
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

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'membership_data' => [
                'membership' => $membership_level,
                'terms' => $terms,
                'benefit' => $benefit
            ],
            'balance' => $balance,
            'notification' => $notif
        ];

        return view('membership/upgrade', $cust_data);
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

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active',1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'id' => $id,
            'membership' => $membership,
            'detail_level' => $detail_level,
            'notification' => $notif
        ];

        return view('membership/payment', $cust_data);
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
                    $subscriptionModel->deleteSubs();
                    $subscriptionModel->where('cust_id', $_SESSION['id'])->where('is_active', 0)->delete();
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
                $time_left = ceil((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24));
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
                return redirect()->to('profile/index');
            }
        } else {
            $session->setFlashdata('msg_password_fail', 'Password is incorrect!');
            return redirect()->to('membership/upgrade' . '/' . $data['level_id']);
        }
    }

    public static function check_subscription_notification() {
        $modelSubscription= new Subscription();
        $all_subs = $modelSubscription->getSubscriptions();


        for($i=0;$i<count($all_subs);$i++) {
            $date = new DateTime($all_subs[$i]['subscription_date']);
            $date->add(new DateInterval('P30D'));
            $all_subs[$i]['subscription_date'] = $date->format('Y-m-d');
            if(ceil((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24)) <= 5) {
                $low_subs[] = $all_subs[$i];
            } 
        }
        if(isset($low_subs)) {
            for($i=0;$i<count($low_subs);$i++) {
                $email = \Config\Services::email();
                $url_changepass = base_url('membership/upgrade');
                $email->setFrom('gudon.adm@gmail.com', "GuDon Admin");
                $email->setTo($low_subs[$i]['cust_email']);
                $email->setSubject('Subscription Renewal GUDON');
                $email->setMessage('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
                    <html>
                        <head>
                            <!-- Compiled with Bootstrap Email version: 1.1.2 --><meta http-equiv="x-ua-compatible" content="ie=edge">
                            <meta name="x-apple-disable-message-reformatting">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <style type="text/css">
                                body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.p-4:not(table),.p-4:not(.btn)>tbody>tr>td,.p-4.btn td a{padding:16px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}}
                            </style>
                            <link rel="preconnect" href="https://fonts.googleapis.com">
                            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                        </head>
                        <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                            <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                                <tbody>
                                    <tr>
                                    <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
                                        <table class="container-fluid" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                            <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 0 16px;" align="left">
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                        &#160;
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">
                                                        <table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                            <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">
                                                                <div style="background-color: #5cc5e6; color: #FFFFFF; padding: 20px 0px 20px 20px;">
                                                                <div class="row" style="margin-right: -24px;">
                                                                    <table class="" role="presentation" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; width: 100%;" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                        <div style="display: flex;">
                                                                            <img class="img-fluid" src="https://drive.google.com/uc?export=view&id=1MhwB2pLXtUv4oejYg30KB7_vmo7X3CPy" allow="autoplay" alt="GuDon" style="display: block; width: auto; height: 100px; max-width: 100%; max-height: 90%; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">
                                                                            <div style="margin: auto 0; width: 50%; padding:25px">
                                                                            <h2 style="font-weight: bold; font-size: 4vmin; padding-top: 0; padding-bottom: 0; vertical-align: center; line-height: 38.4px; margin: 0;" align="LEFT">GUDON</h2>
                                                                            </div>
                                                                        </div>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                                <table class="p-4" role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody style="font-family: Roboto, sans-serif;">
                                                                    <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; margin: 0; padding: 16px;" align="left">
                                                                        <div class="">
                                                                        <h5 class="text-muted" style="font-size: 2vmin; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="left">Subscription Renewal</h5>
                                                                        <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                                &#160;
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p style="font-size: 1.8vmin; line-height: 24px; width: 100%; margin: 0;" align="left">Hello  '.ucwords($low_subs[$i]['cust_name']).', Your GuDon account subscription is about to end! Your subscription is still valid until '.$low_subs[$i]['subscription_date'].'. Please click the button below to extend your subscription.</p>
                                                                        <br>
                                                                        <table class="btn" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center">
                                                                                <a href='.$url_changepass.' style="font-size: 2vh; background-color: #5cc5e6; color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; padding: 8px 12px; border: 1px solid transparent;">
                                                                                    Renew Your Subscription
                                                                                </a>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                                <h5 class="text-muted  text-center" style="font-size: 1.5vh; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="center">&#169; GuDon</h5>
                                                                <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                    <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                        &#160;
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                        &#160;
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </body>
                        </html>
                    ');
                    if ($email->send()) {
                        // notify
                        $modelNotif = new NotificationModel();
                        $data_notif = [
                            'title' => 'Low Subscription Notification Sent',
                            'message' => NULL,
                            'cust_id' => NULL,
                            'link' => 'order/index',
                            'adm_notified' => 1,
                            'adm_message' => 'Email Subscription Renewal for '.ucwords($low_subs[$i]['cust_name']).' ('.$low_subs[$i]['cust_email'].') Successful'
                        ];
                        $modelNotif->insert($data_notif);
                        $data =[
                            'subs_notified' => 1
                        ];
                        $modelSubscription->update($low_subs[$i]['subs_id'], $data);
                    } else {
                        // notify
                        $modelNotif = new NotificationModel();
                        $data_notif = [
                            'title' => 'Low Subscription Notification Failed',
                            'message' => NULL,
                            'cust_id' => NULL,
                            'link' => 'order/index',
                            'adm_notified' => 1,
                            'adm_message' => 'Email Subscription Renewal for '.ucwords($low_subs[$i]['cust_name']).' ('.$low_subs[$i]['cust_email'].') Failed'
                        ];
                        $modelNotif->insert($data_notif);
                    }
            }
        }
    }
}
