<?php

namespace App\Controllers;

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
}
