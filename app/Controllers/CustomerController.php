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
