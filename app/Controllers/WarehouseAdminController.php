<?php

namespace App\Controllers;
use \App\Models\Warehouse;
use \App\Models\Shelf;
use \App\Models\NotificationModel;
use App\Models\StorageModel;

use DateTime;
use Exception;

date_default_timezone_set("Asia/Jakarta");

class WarehouseAdminController extends BaseController
{
    public function index()
    {
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

        $adm_data['admin_data'] = [
            'notification' => $notif
        ];

        return view('admin/warehouse/index', $adm_data);
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
        $shelf = $model->get_shelf($id)->getResultArray();
            
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

        $adm_data['admin_data'] = [
            'notification' => $notif,
            'shelf' => $shelf
        ];
        return view('admin/warehouse/view', $adm_data);
    }

    public function view_product($id)
    {
        $model = new Shelf;
        $shelf = $model->get_all_detail($id)->getResultArray();
        return json_encode($shelf);
    }

    public function create()
    {
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

        $adm_data['admin_data'] = [
            'notification' => $notif
        ];
        return view('admin/warehouse/new_warehouse', $adm_data);
    }

    public function store()
    {
        $warehouseModel = new Warehouse();
        $shelfModel = new Shelf();
        $storageModel = new StorageModel();

        try {
            $data = $this->request->getPost();

            $temp_data_shelf = $this->request->getPost('data_shelf');

            $data_order = [
                'name' => $data['namawarehouse'],
                'address' => $data['alamat']
            ];

            $warehouse_insert = $warehouseModel->insert($data_order); //insert mst_order
            if ($warehouse_insert) {
                $warehouse_id = $warehouseModel->getInsertID();
            }
            foreach ($temp_data_shelf as $a) {
                $shelf_name = $this->request->getPost('namashelf' . $a);
                $max_weight = $this->request->getPost('maxweight' . $a);
                $max_volume = $this->request->getPost('maxvolume' . $a);
                $data_detail = [
                    'name' => $shelf_name,
                    'max_weight' => $max_weight,
                    'max_volume' => $max_volume
                ];
                $shelf_insert = $shelfModel->insert($data_detail);
                if ($shelf_insert) {
                    $shelf_id = $shelfModel->getInsertID();
                }
                $storage_detail = [
                    'shelf_id' => $shelf_id,
                    'warehouse_id' => $warehouse_id
                ];
                $storageModel->insert($storage_detail);
            }

            // notify
            $modelNotif = new NotificationModel();
            $data_notif = [
                'title' => 'New Warehouse',
                'message' => 'Our new Warehouse '.$data['namawarehouse'].' is finally here! 😊 See you in our new branch 👋',
                'cust_id' => '*',
                'link' => 'warehouse/index',
                'adm_notified' => 1,
                'adm_message' => 'New Warehouse '.$data['namawarehouse'].'#'.$warehouse_id.' was successfully created'
            ];
            $modelNotif->insert($data_notif);
        } catch (Exception $e) {
        }
        return redirect()->to(base_url('admin/warehouse/index'));
    }
}
