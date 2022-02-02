<?php

namespace App\Models;

use CodeIgniter\Model;

class Shelf extends Model
{
    protected $table      = 'mst_gudon.mst_shelf';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'max_weight', 'max_volume', 'is_active'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}