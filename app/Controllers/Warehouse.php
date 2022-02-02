<?php

namespace App\Controllers;

class Warehouse extends BaseController
{
    public function load_table()
    {
        $warehouseModel = new \App\Models\Warehouse();
        $warehouse['warehouse'] = $warehouseModel->findAll();
        return view('warehouse/index', $warehouse);
    }

    public function view_detail($id)
    {
        $shelfModel = new \App\Models\Shelf();
        $shelf['shelf'] = $shelfModel->where('id', $id)->findAll();
        return view('warehouse/view', $shelf);
    }
}
