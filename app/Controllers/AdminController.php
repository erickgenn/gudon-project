<?php

namespace App\Controllers;

class AdminController extends BaseController
{

    public function index()
    {
        return view('admin/dashboard');
    }

    public function forbidden()
    {
        return view('forbidden');
    }
}
