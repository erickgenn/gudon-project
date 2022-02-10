<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table      = 'mst_detail_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'is_active'];
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function detailDelete($order_id)
    {
        $builder = $this->db->table('mst_gudon.mst_detail_order');

        $builder->set('is_active', 0);
        $builder->where('order_id', $order_id);

        $builder->update();
    }
}
