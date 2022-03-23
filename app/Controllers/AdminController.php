<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\NotificationModel;
use App\Models\ProductModel;
use App\Models\Subscription;

use DateTime;

date_default_timezone_set("Asia/Jakarta");

class AdminController extends BaseController
{

    public function index()
    {
        $orderModel = new OrderModel();
        $order = $orderModel->findAll();
        $order_confirm = $orderModel->where('status', 'SEDANG DIPROSES')->findAll();
        $order_success = $orderModel->where('status', 'SELESAI')->findAll();
        $order_cancel = $orderModel->where('status', 'BATAL')->findAll();

        $custModel = new Customer();
        $partners = $custModel->findAll();

        $count_partners = count($partners);
        $count_order = count($order);
        $count_order_confirm = count($order_confirm);
        $count_order_success = count($order_success);
        $count_order_cancel = count($order_cancel);

        $subsModel = new Subscription();
        $countSubs = $subsModel->where('is_active', '1')->findAll();

        $productModel = new ProductModel();
        $product = $productModel->where('is_active', 1)->where('deleted_at', null)->findAll();

        $active_cust = count($partners) - count($countSubs);
        $nonactive_cust = count($partners) - $active_cust;

        $date_monday = date("Y-m-d", strtotime("Monday This Week"));
        $date_tuesday = date("Y-m-d", strtotime("Tuesday This Week"));
        $date_wednesday = date("Y-m-d", strtotime("Wednesday This Week"));
        $date_thursday = date("Y-m-d", strtotime("Thurday This Week"));
        $date_friday = date("Y-m-d", strtotime("Friday This Week"));
        $date_saturday = date("Y-m-d", strtotime("Saturday This Week"));
        $date_sunday = date("Y-m-d", strtotime("Sunday This Week"));

        $monday = $custModel->countRegistrationDate($date_monday)->getResultArray();
        $tuesday = $custModel->countRegistrationDate($date_tuesday)->getResultArray();
        $wednesday = $custModel->countRegistrationDate($date_wednesday)->getResultArray();
        $thursday = $custModel->countRegistrationDate($date_thursday)->getResultArray();
        $friday = $custModel->countRegistrationDate($date_friday)->getResultArray();
        $saturday = $custModel->countRegistrationDate($date_saturday)->getResultArray();
        $sunday = $custModel->countRegistrationDate($date_sunday)->getResultArray();

        $adm_data['count_partner'] = [count($monday), count($tuesday), count($wednesday), count($thursday), count($friday), count($saturday), count($sunday)];

        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('adm_notified', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }
        $adm_data['count_product'] = count($product);
        $adm_data['active_cust'] = $active_cust;
        $adm_data['nonactive_cust'] = $nonactive_cust;

        $adm_data['admin_data'] = [
            'count_order' => $count_order,
            'count_order_confirm' => $count_order_confirm,
            'count_order_success' => $count_order_success,
            'count_order_cancel' => $count_order_cancel,
            'count_partners' => $count_partners,
            'notification' => $notif,
        ];

        return view('admin/dashboard', $adm_data);
    }

    public function notification_index()
    {
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('adm_notified', 1)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        // get all notification
        $notif_all = $modelNotif->where('adm_message !=', NULL)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif_all); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif_all[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if (strcmp($interval->format("%y"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%y year(s) ago");
            } else if (strcmp($interval->format("%m"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%m month(s) ago");
            } else if (strcmp($interval->format("%d"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%d day(s) ago");
            } else if (strcmp($interval->format("%h"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%h hour(s) ago");
            } else if (strcmp($interval->format("%i"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%i minute(s) ago");
            } else if (strcmp($interval->format("%s"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        $adm_data['admin_data'] = [
            'notification' => $notif,
            'all_notif' => $notif_all
        ];

        // deactivate all new notification after opening page
        $modelNotif->adminReadAll();

        return view('admin/notification/index', $adm_data);
    }

    public static function updateAdminNotification($id, $group, $href)
    {
        $modelNotif = new NotificationModel();
        $data = [
            'adm_notified' => 0
        ];
        $modelNotif->update($id, $data);
        return redirect()->to('admin/' . $group . '/' . $href);
    }


    public function forbidden()
    {
        return view('forbidden');
    }
}
