<?php

namespace App\Controllers;

use App\Models\NotificationModel;

use DateTime;

date_default_timezone_set("Asia/Jakarta");

class NotificationController extends BaseController
{
    public function index() {
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

        // get all notification
        $notif_all = $modelNotif->where('cust_id', $_SESSION['id'])->where('deleted_at', null)->orderBy('created_at', 'desc')->findAll();
        for ($i = 0; $i < count($notif_all); $i++) {
            $now = new DateTime('NOW');
            $notif_time = new DateTime($notif_all[$i]['created_at']);
            $interval = $now->diff($notif_time);
            if(strcmp($interval->format("%y"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%y year(s) ago");
            }
            else if(strcmp($interval->format("%m"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%m month(s) ago");
            }
            else if(strcmp($interval->format("%d"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%d day(s) ago");
            }
            else if(strcmp($interval->format("%h"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%h hour(s) ago");
            }
            else if(strcmp($interval->format("%i"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%i minute(s) ago");
            }
            else if(strcmp($interval->format("%s"), "0") == 1) {
                $notif_all[$i]['created_at'] = $interval->format("%s second(s) ago");
            }
        }

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'all_notif' => $notif_all
        ];
        
        // deactivate all new notification after opening page
        $modelNotif->readAll();

        return view('notification/index', $cust_data);
    }

    public static function updateNotification($id, $group, $href)
    {
        $modelNotif = new NotificationModel();
        $data = [
            'is_active' => 0
        ];
        $modelNotif->update($id, $data);
        return redirect()->to($group.'/'.$href);
    }

    public static function delete($id)
    {
        $modelNotif = new NotificationModel();
        $modelNotif->where('id', $id)->delete();
        return redirect()->to('notification/index');
    }
}
