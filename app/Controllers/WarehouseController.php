<?php

namespace App\Controllers;
use \App\Models\Warehouse;
use \App\Models\Shelf;

class WarehouseController extends BaseController
{
    public function load_table()
    {
        $model = new Warehouse;
        $warehouse['warehouse'] = $model->findAll();
        return view('warehouse/index', $warehouse);
    }

    public function search(){
        $model = new Warehouse;

        $warehouse = $model->where('deleted_at', null)->findAll();

        return json_encode($warehouse);
    }

    // ini untuk bagian shelf
    public function view_shelf($id)
    {
        $model = new Shelf;
        $validate = $model->cust_validate()->getResultArray();
        if(!$validate) {
            $session = session();
            $session->setFlashdata('msg', 'Silahkan daftarkan produk anda untuk melihat halaman ini');
            return view('warehouse/index');
        } else {
            $shelf['shelf'] = $model->get_shelf($id)->getResultArray();
            return view('warehouse/view', $shelf);
        }
    }

    public function view_product($id)
    {
        $model = new Shelf;
        $shelf = $model->get_detail($id)->getResultArray();
        return json_encode($shelf);
    }
}
