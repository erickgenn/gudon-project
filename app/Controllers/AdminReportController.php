<?php

namespace App\Controllers;

use App\Models\AuthModel;
use \App\Models\CreateOrderTemp;
use App\Models\Customer;
use App\Models\DetailOrderModel;
use \App\Models\ProductModel;
use App\Models\StorageModel;
use \App\Models\Warehouse;
use \App\Models\NotificationModel;
use App\Models\OrderModel;
use DateTime;
use Exception;

date_default_timezone_set("Asia/Jakarta");

class AdminReportController extends BaseController
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

        $adm_data['admin_data'] = [
            'notification' => $notif
        ];

        return view('admin/report/index', $adm_data);
    }

    public function view($id)
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->get_detail($id)->getResultArray();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_harga'] = MoneyFormatController::money_format_rupiah($order[$i]['total_harga']);
            $order[$i]['ongkos_kirim'] = MoneyFormatController::money_format_rupiah($order[$i]['ongkos_kirim']);
        }

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

        $cust_data['admin_data'] = [
            'notification' => $notif
        ];

        $cust_data['customer_data'] = [
            'order' => $order
        ];

        return view('admin/report/view', $cust_data);
    }

    public function search()
    {
        $orderModel = new OrderModel();
        $start_date = $this->request->getGet("start_date");
        $end_date = $this->request->getGet("end_date");
        $status = $this->request->getGet("status");
        $cust_id = $this->request->getGet("cust_id");

        $order = 0;
        if ($status == "0") {
            if ($cust_id == "0") {
                $order = $orderModel->getReportAdminDate($start_date, $end_date)->getResultArray();
            } else {
                $order = $orderModel->getReportAdminCustomer($start_date, $end_date, $cust_id)->getResultArray();
            }
        } else {
            if ($cust_id == "0") {
                $order = $orderModel->getReportAdminStatus($start_date, $end_date, $status)->getResultArray();
            } else {
                $order = $orderModel->getReportAdminCustomerStatus($start_date, $end_date, $status, $cust_id)->getResultArray();
            }
        }

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
        }

        return json_encode($order);
    }

    public function searchAll()
    {
        $orderModel = new OrderModel();

        $order = $orderModel->orderBy('created_at', 'desc')
            ->findAll();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
            $order[$i]['created_at'] = date_format(date_create($order[$i]['created_at']), 'Y/m/d H:i');
        }

        return json_encode($order);
    }

    public function searchCustomer()
    {
        $custModel = new Customer();


        if (!isset($_GET['search'])) {
            $customer = $custModel->where("is_active", 1)->findAll();
        } else {
            $field = "name";
            $customer = $custModel->where("is_active", 1)->like('LOWER(' . $field . ')', strtolower($_GET['search']))->findAll();
        }

        $list = array();
        for ($i = 0; $i < count($customer); $i++) {
            $list[$i]['id'] = $customer[$i]['id'];
            $list[$i]['text'] = $customer[$i]['name'];
        }

        return json_encode($list);
    }
}
