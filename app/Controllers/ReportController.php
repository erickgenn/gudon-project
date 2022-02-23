<?php

namespace App\Controllers;

use \App\Models\CreateOrderTemp;
use App\Models\Delivery;
use App\Models\DetailOrderModel;
use \App\Models\ProductModel;
use App\Models\StorageModel;
use \App\Models\Warehouse;

use Exception;

class ReportController extends BaseController
{


    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }

    public function index()
    {
        return view('report/index');
    }

    public function view($id)
    {
        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->get_detail($id)->getResultArray();

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_harga'] = MoneyFormatController::money_format_rupiah($order[$i]['total_harga']);
            $order[$i]['ongkos_kirim'] = MoneyFormatController::money_format_rupiah($order[$i]['ongkos_kirim']);
        }

        return view('report/view', compact('order'));
    }

    public function search()
    {
        $orderModel = new \App\Models\OrderModel();
        $start_date = $this->request->getGet("start_date");
        $end_date = $this->request->getGet("end_date");
        $status = $this->request->getGet("status");

        $order = 0;
        if ($status == "0") {
            $order = $orderModel->getReportDate($start_date, $end_date)->getResultArray();
        } else {
            $order = $orderModel->getReportStatus($start_date, $end_date, $status)->getResultArray();
        }

        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['total_price'] = MoneyFormatController::money_format_rupiah($order[$i]['total_price']);
            $order[$i]['delivery_price'] = MoneyFormatController::money_format_rupiah($order[$i]['delivery_price']);
        }

        return json_encode($order);
    }
}
