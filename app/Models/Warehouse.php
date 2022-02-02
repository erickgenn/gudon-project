<?php

namespace App\Models;

use CodeIgniter\Model;

class Warehouse extends Model
{
    protected $table      = 'mst_gudon.mst_warehouse';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'address', 'is_active'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}