<?php

namespace App\Controllers;

class Warehouse extends BaseController
{
    
    public function index()
    {
        return view('warehouse');
    }

    public function load_table()
    {
        $warehouseModel = new \App\Models\Warehouse();
        $warehouse = $warehouseModel->findAll();
        dd($warehouse);
        die();
        return view('warehouse', $warehouse);
    }
}
