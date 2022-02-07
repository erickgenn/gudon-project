<?php

namespace App\Controllers;
use \App\Models\Warehouse;

class WarehouseController extends BaseController
{
    public function load_table()
    {
        $model = new Warehouse;
        $warehouse['warehouse'] = $model->findAll();
        return view('warehouse/index', $warehouse);
    }

    public function view_detail($id)
    {
        $model = new Warehouse;
        $shelf['shelf'] = $model->get_detail($id)->getResultArray();
        return view('warehouse/view', $shelf);
    }
}
