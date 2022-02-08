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

    public function search(){
        $model = new Warehouse;

        $warehouse = $model->where('deleted_at', null)->findAll();

        return json_encode($warehouse);
    }

    public function warehouse_detail($id)
    {
        $model = new Warehouse;
        $shelf['d'] = $model->get_detail($id)->getResultArray();
        return $shelf;
    }

    public function view_detail_v2($id)
    {
        $model = new Warehouse;
        $shelf['shelf'] = $model->get_detail($id)->getResultArray();
        return view('warehouse/view_v2', $shelf);
    }
}
