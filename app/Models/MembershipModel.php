<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model
{
    protected $table      = 'mst_level';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'max_weight', 'max_volume', 'price', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $useSoftDeletes = true;
}