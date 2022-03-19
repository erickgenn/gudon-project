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

    public function get_all_data() {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select('
        mst_product.id as id_produk,
        mst_product.name as nama_produk,
        mst_customer.name as nama_customer,
        mst_warehouse.name as nama_warehouse,
        mst_shelf.name as nama_shelf,
        mst_product.is_active as is_active
        ');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_product.customer_id');
        $builder->join('mst_gudon.cms_storage', 'cms_storage.id = mst_product.storage_id');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->join('mst_gudon.mst_shelf', 'mst_shelf.id = cms_storage.shelf_id');
        return $builder->get();
    }

    public function get_not_assigned() {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select('
        mst_product.id as id_produk,
        mst_product.name as nama_produk,
        mst_customer.name as nama_customer,
        mst_product.is_active as is_active
        ');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_product.customer_id');
        $builder->where('mst_product.storage_id is NULL', NULL, FALSE);
        return $builder->get();
    }

    public function get_data_price($id)
    {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select('id, quantity, price');
        $builder->where('id', $id);
        return $builder->get();
    }

    
}
