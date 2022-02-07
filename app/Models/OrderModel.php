<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'mst_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['customer_id', 'warehouse_id', 'destination_address', 'destination_phone', 'total_price', 'delivery_price', 'delivery_id', 'status', 'delivery_status', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}