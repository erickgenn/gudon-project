<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table      = 'mst_order_temp';
    protected $primaryKey = 'id';

    protected $allowedFields = ['cust_name','cust_address', 'quantity', 'warehouse','barang'];

    public function tampilDataTemp($order_id){
        return $this->table('mst_order_temp')->join('ms_detail_order','')
    }
}