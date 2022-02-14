<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelDetailModel extends Model
{
    protected $table      = 'mst_level_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = ['level_id', 'terms', 'benefit', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}