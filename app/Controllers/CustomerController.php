<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\NotificationModel;

use DateTime;
use Exception;

date_default_timezone_set("Asia/Jakarta");

class CustomerController extends BaseController
{

    public function index() {
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('adm_notified', 1)->orderBy('created_at', 'desc')->findAll();
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
        return view('admin/customer/index', $adm_data);
    }

    public function search()
    {
        $customerModel = new \App\Models\AuthModel();

        $customer = $customerModel
            ->where('is_active', 1)
            ->findAll();

        return json_encode($customer);
    }

    public function update_profile() {
        $session = session();
        $customerModel = new Customer();
        try {
            $data = $this->request->getPost();

            // upload image
            $file = $this->request->getFile('profilepicture');

            $target_dir = "uploads/profile/customer";
            $target_file = $target_dir .'/'. basename($file->getName());
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));  

            // Check if image file is a actual image or fake image
            if(isset($file)) {
                $check = getimagesize($file->getTempName());
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($file->getSize() > 5000000) {
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $session->setFlashdata('ImageFailed', 'Please Try Another Image');
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file->getTempName(),$target_dir.'/'.$file->getName())) {
                    // upload to db
                    $customerModel->updateProfile($data['username'], $file->getName());
                    $session_data = [
                        'name' => $data['username'],
                        'picture' => $file->getName()
                    ];
                    $session->set($session_data);
                    $session->setFlashdata('custUpdateSuccess', 'abc');
                    return redirect()->to(base_url('profile/index'));
                } else {
                    $session->setFlashdata('custUpdateFailed', 'Upload Failed, Please Try Again');
                    return redirect()->to(base_url('profile/index'));
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('custUpdateFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('profile/index'));
        }
        return redirect()->to(base_url('profile/index'));
    }
}
