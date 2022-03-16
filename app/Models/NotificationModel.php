<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'mst_notification';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'message', 'cust_id', 'is_active', 'link'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}