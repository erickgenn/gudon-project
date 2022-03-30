<?php

namespace App\Controllers;
use \App\Models\ProductModel;
use \App\Models\NotificationModel;
use App\Models\StorageModel;
use App\Models\Warehouse;
use DateTime;

date_default_timezone_set("Asia/Jakarta");

class ProductAdminController extends BaseController
{
    public function index()
    {
        // check order cancellation
        OrderController::checkOrderCancelation();
        // check low subscription
        MembershipLevelController::check_subscription_notification();

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
        $model = new ProductModel;
        $product = $model->get_not_assigned()->getResultArray();

        $adm_data['admin_data'] = [
            'notification' => $notif,
            'not_assigned' => $product
        ];
        
        return view('admin/product/index', $adm_data);
    }

    public function search(){
        $model = new ProductModel;

        $product = $model->get_all_data()->getResultArray();
    
        return json_encode($product);
    }

    public function search_not_assigned(){
        $model = new ProductModel;

        $product = $model->get_not_assigned()->getResultArray();
    
        return json_encode($product);
    }

    public function view_detail($id)
    {
        $modelProduct= new ProductModel;
        $valid = $modelProduct->where('id',$id)->where('storage_id is NULL', NULL, FALSE)->first();
        if($valid) {
            $product[] = $modelProduct->where('id', $id)->first();
            $product[0]['warehouse_id'] = 1;
            $product[0]['shelf_id'] = 1;
        }
        else {$product = $modelProduct->get_product_storage($id);}

        $modelWarehouse = new Warehouse();
        $warehouse = $modelWarehouse->where('deleted_at is NULL', NULL, FALSE)->findAll();

        $modelStorage = new StorageModel();
        $storage = $modelStorage->get_storage();

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
            'notification' => $notif,
            'product' => $product,
            'storage' => $storage,
            'warehouse' => $warehouse
        ];

        return view('admin/product/view', $adm_data);
    }

    public function get_shelf($id) {
        $modelStorage = new StorageModel();
        $storage = $modelStorage->get_shelf($id);

        return json_encode($storage);
    }

    public function store()
    {
        $session = session();
        $productModel = new ProductModel();

            $data = $this->request->getPost();

            // upload image
            $file = $this->request->getFile('productpicture');

            $target_dir = "uploads/product/";
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
                            'message' => 'Hey '.$_SESSION["name"].', your product was successfully added. Dont forget to take your products to our nearest warehouse 💃',
                            'cust_id' => $_SESSION['id'],
                            'link' => 'product/index',
                            'adm_notified' => 1,
                            'adm_message' => $_SESSION["name"].'#'.$_SESSION['id'].' recently inserted new product #'.$product_id.'. Please wait or contact partners to proceed this new product.'
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
        return redirect()->to(base_url('admin/product/index'));
    }

    public function update($id)
    {   
        $modelProduct = new ProductModel();

        $modelStorage = new StorageModel();

        $data = $this->request->getPost();
        $storage_id = NULL;
        if($data['warehouse'] && $data['shelf']) {
            $storage_id = $modelStorage->where('warehouse_id', $data['warehouse'])->where('shelf_id', $data['shelf'])->first();
        }

        $modified_data = [
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'price'  => $data['price'],
            'description'  => $data['description'],
            'weight' => $data['weight'],
            'volume' => $data['volume'],
            'storage_id' => $storage_id['id']
        ];  
        $modelProduct->update($id, $modified_data);
        // notify
        $modelNotif = new NotificationModel();
        $data_notif = [
            'title' => 'Product Updated',
            'message' => 'Hello, your product '.$data['name'].' was recently updated by GuDon Admin. We hope the product updated just like what you wanted 🤗',
            'cust_id' => $data['custid'],
            'link' => 'product/index',
            'adm_notified' => 1,
            'adm_message' => 'You just recently updated #'.$data['custid'].' \'s product #'.$data['produkid'].'. Please check carefully'
        ];
        $modelNotif->insert($data_notif);

        return redirect()->to(base_url('admin/product/index'));
    }

}