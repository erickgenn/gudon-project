<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table      = 'mst_customer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone', 'password', 'is_active', 'level_id', 'balance', 'picture', 'created_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $useSoftDeletes = true;

    public function get_balance($id)
    {
        $builder = $this->db->table('mst_gudon.mst_customer');
        $builder->select('balance, picture');
        $builder->where('id', $id);
        return $builder->get();
    }

    public function updateProfile($username, $picture)
    {
        $builder = $this->db->table('mst_gudon.mst_customer');
        $builder->set('name', $username);
        $builder->set('picture', $picture);
        $builder->where('id', $_SESSION['id']);

        $builder->update();
    }
    public function countRegistrationDate($date)
    {
        $builder = $this->db->table('mst_gudon.mst_customer');
        $builder->where('created_at >=', $date . " 00:00:00.000");
        $builder->where('created_at <=', $date . " 23:59:59.999");
        return $builder->get();
    }
}
