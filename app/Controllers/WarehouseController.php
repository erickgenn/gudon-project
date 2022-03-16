<?php

namespace App\Controllers;
use \App\Models\Warehouse;
use \App\Models\Shelf;
use \App\Models\NotificationModel;

use DateTime;

date_default_timezone_set("Asia/Jakarta");

class WarehouseController extends BaseController
{
    public function load_table()
    {
        $model = new Warehouse;
        $warehouse['warehouse'] = $model->findAll();
        
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
            'warehouse' => $warehouse
        ];

        return view('warehouse/index', $cust_data);
    }

    public function search(){
        $model = new Warehouse;

        $warehouse = $model->where('deleted_at', null)->findAll();

        return json_encode($warehouse);
    }

    // ini untuk bagian shelf
    public function view_shelf($id)
    {
        $model = new Shelf;
        $validate = $model->cust_validate()->getResultArray();
        if(!$validate) {
            $session = session();
            $session->setFlashdata('msg', 'Silahkan daftarkan produk anda untuk melihat halaman ini');
            return view('warehouse/index');
        } else {
            $shelf = $model->get_shelf($id)->getResultArray();
            
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
                'shelf' => $shelf
            ];
            return view('warehouse/view', $cust_data);
        }
    }

    public function view_product($id)
    {
        $model = new Shelf;
        $shelf = $model->get_detail($id)->getResultArray();
        return json_encode($shelf);
    }
}
