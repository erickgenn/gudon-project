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

    protected $useSoftDeletes = true;

    public function deleteSubs()
    {
        $builder = $this->db->table('mst_gudon.mst_subscription');

        $builder->set('is_active', 0);
        $builder->where('cust_id', $_SESSION['id']);
        $builder->update();
    }

    public function getSubscriptions() {
        $builder = $this->db->table('mst_gudon.mst_subscription');
        $builder->select('
        mst_subscription.subscription_date as subscription_date,
        mst_subscription.cust_id as cust_id,
        mst_subscription.level_id as level_id,
        mst_subscription.is_active as is_active,
        mst_customer.name as cust_name,
        mst_customer.email as cust_email
        ');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_subscription.cust_id');
        $builder->where('mst_subscription.is_active', 1);
        $builder->where('mst_subscription.subs_notified', 0);
        return $builder->get()->getResultArray();
    }
}
