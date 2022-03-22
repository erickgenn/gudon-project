<?php

namespace App\Models;

use CodeIgniter\Model;

class Delivery extends Model
{
    protected $table      = 'mst_gudon.mst_delivery';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'is_active'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
}