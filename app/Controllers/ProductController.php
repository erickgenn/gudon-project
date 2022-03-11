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
        $productModel = new ProductModel();

            $data = $this->request->getPost();

            if(!$this->validate([
                'customFile' => [
                    'rules' => 'uploaded[customFile]|max_size[customFile,1024]|is_image[customFile]|mime_in[customFile,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Please upload a picture',
                        'max_size' => 'Picture is too large, please try another file',
                        'is_image' => 'This file is not a picture, please try another file',
                        'mime_in' => 'This file is not a picture, please try another file'
                    ]
                ]
            ])) {
                $data['validation'] = $this->validator;
                return view('product/add_product', $data);
            }

            $file = $this->request->getFile('customFile');
            dd($file);die();            

            $target_dir = base_url("uploads/product");
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            dd($target_file);die();
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG & PNG files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        // return redirect()->to(base_url('order/index'));
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

        return view('product/index');
    }

}