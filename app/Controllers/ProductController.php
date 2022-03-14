<?php

namespace App\Controllers;
use \App\Models\ProductModel;
use Exception;


class ProductController extends BaseController
{
    

    public function add_product()
    {
        return view('product/add_product');
    }

    public function index()
    {
        $model = new ProductModel;
        $product['product'] = $model->where('customer_id', $_SESSION['id'])->where('deleted_at', null)->orderBy('created_at', 'asc')->findAll();
        return view('product/index', $product);
    }

    public function search(){
        $model = new ProductModel;

        $product = $model->where('customer_id', $_SESSION['id'])->where('deleted_at', null)->findAll();
    
        return json_encode($product);
    }

    public function view_detail($id)
    {
        $model= new ProductModel;
        $product = $model->where('id', $id)->where('deleted_at', null)->first();


        return view('product/view',compact('product'));
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

        return redirect()->to(base_url('product/index'));
    }

}