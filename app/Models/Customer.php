<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table      = 'mst_customer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone', 'password', 'is_active', 'level_id', 'balance'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_balance($id) {
        $builder = $this->db->table('mst_gudon.mst_customer');
        $builder->select('balance');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function updateConfirm($id, $username, $picture)
    {
        $builder = $this->db->table('mst_gudon.mst_customer');
        $builder->set('name', $username);
        $builder->set('picture', $picture);
        $builder->where('id', $id);

        $builder->update();
    }
}