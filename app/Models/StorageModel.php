<?php

namespace App\Models;

use CodeIgniter\Model;

class StorageModel extends Model
{
    protected $table      = 'cms_storage';
    protected $primaryKey = 'id';

    protected $allowedFields = ['shelf_id', 'warehouse_id', 'is_active'];
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
