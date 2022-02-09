<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'mst_product';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'name', 'quantity', 'price', 'picture', 'description', 'weight','volume','is_active','storage_id','customer_id'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}