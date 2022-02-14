<?php

namespace App\Controllers;

class AdminController extends BaseController
{

    public function index()
    {
        $count_order = $_SESSION['role'];
        return view('dashboard', compact('count_order'));
    }

    public function forbidden()
    {
        return view('forbidden');
    }
}
