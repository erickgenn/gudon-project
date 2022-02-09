<?php

namespace App\Models;

use CodeIgniter\Model;

class Warehouse extends Model
{
    protected $table      = 'mst_warehouse';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'address', 'is_active'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_detail($id)
    {
        $builder = $this->db->table('mst_gudon.cms_storage');
        $builder->select('mst_warehouse.id as id_warehouse,
        mst_shelf.id as id_shelf,
        cms_storage.id as id_storage,
        mst_product.id as id_product,
        mst_customer.id as id_customer,
        mst_warehouse.name as nama_warehouse,
        mst_customer.name as nama_customer,
        mst_shelf.name as nama_rak,
        mst_product.name as nama_produk,
        mst_shelf.max_weight as berat_maks,
        mst_shelf.max_volume as volume_maks,
        mst_product.weight as berat_produk,
        mst_product.volume as volume_produk,
        mst_product.quantity as kuantitas_produk,
        cms_storage.is_active as is_active');
        $builder->join('mst_gudon.mst_shelf', 'mst_shelf.id = cms_storage.shelf_id');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->join('mst_gudon.mst_product', 'mst_product.storage_id = cms_storage.id');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_product.customer_id');
        $builder->where('cms_storage.warehouse_id', $id);
        $builder->orderBy('cms_storage.id', 'ASC');
        return $builder->get();
    }
    public function get_warehouse_id()
    {
        $builder = $this->db->table('mst_gudon.cms_storage');
        $builder->select('mst_warehouse.id as warehouse_id, mst_warehouse.name as warehouse_name');
        $builder->join('mst_gudon.mst_product', 'mst_product.storage_id = cms_storage.id');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->where('mst_product.customer_id', $_SESSION["id"]);
        return $builder->get();
    }
}