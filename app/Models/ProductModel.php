<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'mst_product';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'quantity', 'price', 'picture', 'description', 'weight', 'volume', 'is_active', 'storage_id', 'customer_id'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;

    public function get_product_storage($id)
    {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select('
        mst_product.id as id,
        mst_product.name as name,
        mst_product.quantity as quantity,
        mst_product.price as price,
        mst_product.picture as picture,
        mst_product.description as description,
        mst_product.weight as weight,
        mst_product.volume as volume,
        mst_product.is_active as is_active,
        mst_warehouse.id as warehouse_id,
        mst_warehouse.name as warehouse_name,
        mst_shelf.id as shelf_id,
        mst_shelf.name as shelf_name,
        mst_product.customer_id as customer_id
        ');
        $builder->join('mst_gudon.cms_storage', 'cms_storage.id = mst_product.storage_id');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->join('mst_gudon.mst_shelf', 'mst_shelf.id = cms_storage.shelf_id');
        $builder->where('mst_product.id', $id);

        return $builder->get()->getResultArray();
    }

    public function get_all_data()
    {
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

    public function get_not_assigned()
    {
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
        $builder->select('id, quantity, price, weight');
        $builder->where('id', $id);
        return $builder->get();
    }
}
