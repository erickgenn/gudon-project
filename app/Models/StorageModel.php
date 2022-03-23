<?php

namespace App\Models;

use CodeIgniter\Model;

class StorageModel extends Model
{
    protected $table      = 'cms_storage';
    protected $primaryKey = 'id';

    protected $allowedFields = ['shelf_id', 'warehouse_id', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $useSoftDeletes = true;

    public function get_storage() {
        $builder = $this->db->table('mst_gudon.cms_storage');
        $builder->select('
        cms_storage.id as id,
        mst_warehouse.id as warehouse_id,
        mst_warehouse.name as warehouse_name,
        mst_shelf.id as shelf_id,
        mst_shelf.name as shelf_name,
        cms_storage.is_active as is_active
        ');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->join('mst_gudon.mst_shelf', 'mst_shelf.id = cms_storage.shelf_id');
        $builder->where('cms_storage.deleted_at is NULL', NULL, FALSE);

        return $builder->get()->getResultArray();
    }

    public function get_shelf($id) {
        $builder = $this->db->table('mst_gudon.cms_storage');
        $builder->select('
        cms_storage.id as id,
        mst_warehouse.id as warehouse_id,
        mst_warehouse.name as warehouse_name,
        mst_shelf.id as shelf_id,
        mst_shelf.name as shelf_name,
        cms_storage.is_active as is_active
        ');
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = cms_storage.warehouse_id');
        $builder->join('mst_gudon.mst_shelf', 'mst_shelf.id = cms_storage.shelf_id');
        $builder->where('cms_storage.deleted_at is NULL', NULL, FALSE);
        $builder->where('cms_storage.warehouse_id', $id);

        return $builder->get()->getResultArray();
    }
}
