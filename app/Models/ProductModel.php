<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'mst_product';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'quantity', 'price', 'picture', 'description', 'weight', 'volume', 'is_active', 'storage_id', 'customer_id'];
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_data_price($id)
    {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select('id, quantity, price');
        $builder->where('id', $id);
        return $builder->get();
    }

    
}
