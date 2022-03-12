<?php

namespace App\Controllers;

use App\Models\Customer;
use Exception;

class CustomerController extends BaseController
{

    public function index()
    {

        return view('admin/customer/index');
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
            dd($data);die();

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
                    // echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    // echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                // echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($file->getSize() > 5000000) {
                // echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                // echo "Sorry, only JPG, JPEG & PNG files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file->getTempName(),$target_dir.$file->getName())) {
                    // upload to db
                    $cust_update = $customerModel->updateProfile($_SESSION['name'], $data['name'], $file->getName());
                    if ($cust_update) {
                        $session->setFlashdata('custUpdateSuccess', '');
                    } else {
                        $session->setFlashdata('custUpdateFailed', '');
                        redirect()->to(base_url('membership/index'));
                    }
                } else {
                    // echo "Sorry, there was an error uploading your file.";
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('update_fail', 'Order Gagal Dikonfirmasi!');
        }
        return redirect()->to('membership/index');
    }
}
