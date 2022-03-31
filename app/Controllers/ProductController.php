<?php

namespace App\Controllers;

use \App\Models\ProductModel;
use \App\Models\NotificationModel;

use Exception;
use DateTime;

date_default_timezone_set("Asia/Jakarta");

class ProductController extends BaseController
{


    public function add_product()
    {
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'notification' => $notif
        ];
        return view('product/add_product', $cust_data);
    }

    public function index()
    {
        $model = new ProductModel;
        $product = $model->where('customer_id', $_SESSION['id'])->where('deleted_at', null)->orderBy('created_at', 'asc')->findAll();
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'product' => $product
        ];
        return view('product/index', $cust_data);
    }

    public function search()
    {
        $model = new ProductModel;

        $product = $model->where('customer_id', $_SESSION['id'])->where('deleted_at', null)->findAll();

        return json_encode($product);
    }

    public function view_detail($id)
    {
        $model = new ProductModel;
        $product = $model->where('id', $id)->where('deleted_at', null)->first();
        // get notification
        $modelNotif = new NotificationModel();
        $notif = $modelNotif->where('cust_id', $_SESSION['id'])->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
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

        $cust_data['customer_data'] = [
            'notification' => $notif,
            'product' => $product
        ];

        return view('product/view', $cust_data);
    }

    public function store()
    {
        $session = session();
        $productModel = new ProductModel();

        $data = $this->request->getPost();

        // upload image
        $file = $this->request->getFile('productpicture');

        $target_dir = "uploads/product/";

        $target_file = $target_dir . '/' . basename($file->getName());
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($file)) {
            $check = getimagesize($file->getTempName());
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($file->getSize() > 5000000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            // echo "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file->getTempName(), $target_dir . $file->getName())) {
                // upload to db
                $data_product = [
                    'name' => $data['productname'],
                    'quantity' => $data['productquantity'],
                    'price' => $data['productprice'],
                    'picture' => $file->getName(),
                    'description' => $data['productdesc'],
                    'weight' => $data['productweight'],
                    'volume' => $data['productvolume'],
                    'customer_id' => $_SESSION['id']
                ];

                $product_insert = $productModel->insert($data_product); //insert mst_order
                if ($product_insert) {
                    $product_id = $productModel->getInsertID();
                    // notify
                    $modelNotif = new NotificationModel();
                    $data_notif = [
                        'title' => 'New Product Added',
                        'message' => 'Hey ' . $_SESSION["name"] . ', your product was successfully added. Dont forget to take your products to our nearest warehouse 💃',
                        'cust_id' => $_SESSION['id'],
                        'link' => 'product/index',
                        'adm_notified' => 1,
                        'adm_message' => $_SESSION["name"] . '#' . $_SESSION['id'] . ' recently inserted new product #' . $product_id . '. Please wait or contact partners to proceed this new product.'
                    ];
                    $modelNotif->insert($data_notif);
                    $session->setFlashdata('insertProductSuccess', '');
                } else {
                    $session->setFlashdata('insertProductFailed', '');
                    redirect()->to(base_url('product/add_product'));
                }
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
        return redirect()->to(base_url('product/index'));
    }

    public function update($id)
    {
        $model = new ProductModel();

        $data = $this->request->getPost();
        $data = [
            'name' => $data['name'],
            'price'  => $data['price'],
            'description'  => $data['description'],
        ];
        $model->update($id, $data);
        // notify
        $modelNotif = new NotificationModel();
        $data_notif = [
            'title' => 'Product Updated',
            'message' => 'Hey ' . $_SESSION["name"] . ', your product ' . $data['name'] . ' was recently updated. Sometimes we just need a little update, right 😎',
            'cust_id' => $_SESSION['id'],
            'link' => 'product/index',
            'adm_notified' => 1,
            'adm_message' => $_SESSION["name"] . '#' . $_SESSION['id'] . ' recently updated product #' . $id . '. Please check carefully'
        ];
        $modelNotif->insert($data_notif);

        return redirect()->to(base_url('product/index'));
    }

    public function updatePicture($id)
    {
        $session = session();
        $productModel = new ProductModel();
        try {
            $data = $this->request->getPost();

            // upload image
            $file = $this->request->getFile('productpicture');

            $target_dir = "uploads/product/temp";
            $target_file = $target_dir . '/' . basename($file->getName());
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($file)) {
                $check = getimagesize($file->getTempName());
                if ($check !== false) {
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
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $session->setFlashdata('ImageFailed', 'Please Try Another Image');
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file->getTempName(), $target_dir . '/' . $file->getName())) {
                    // upload to db
                    $data = [
                        'temp_picture'  => $file->getName(),
                    ];
                    // notify
                    $modelNotif = new NotificationModel();
                    $data_notif = [
                        'title' => 'Product Picture Change Request',
                        'message' => 'Hey ' . $_SESSION["name"] . ', your product picture was recently requested update. PLease wait until we approved it 😊',
                        'cust_id' => $_SESSION['id'],
                        'link' => 'product/index',
                        'adm_notified' => 1,
                        'adm_message' => $_SESSION["name"] . '#' . $_SESSION['id'] . ' recently request product picture change #' . $id . '. Please check carefully'
                    ];
                    $modelNotif->insert($data_notif);
                    $productModel->sendNotif($id);
                    $productModel->update($id, $data);

                    return redirect()->to(base_url('/product/index'));
                } else {
                    $session->setFlashdata('custUpdateFailed', 'Upload Failed, Please Try Again');
                    return redirect()->to(base_url('/product/index'));
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('custUpdateFailed', 'Upload Failed, Please Try Again');
            return redirect()->to(base_url('/product/index'));
        }
        return redirect()->to(base_url('/product/index'));
    }
}
