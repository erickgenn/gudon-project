<?php

namespace App\Models;

use CodeIgniter\Model;

class Subscription extends Model
{
    protected $table      = 'mst_gudon.mst_subscription';
    protected $primaryKey = 'id';
    protected $allowedFields = ['subscription_date', 'cust_id', 'level_id', 'is_active'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}