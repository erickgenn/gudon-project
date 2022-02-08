<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table      = 'mst_detail_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}