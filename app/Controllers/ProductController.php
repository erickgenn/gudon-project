<?php

namespace App\Controllers;
use \App\Models\ProductModel;


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

}