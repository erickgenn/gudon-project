<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'mst_notification';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'message', 'cust_id', 'is_active', 'link'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    public function readAll() {
        $builder = $this->db->table('mst_gudon.mst_notification');
        $builder->set('is_active', 0);
        $builder->where('is_active', 1);

        $builder->update();
    }

    public function adminReadAll() {
        $builder = $this->db->table('mst_gudon.mst_notification');
        $builder->set('adm_notified', 0);
        $builder->where('adm_notified', 1);

        $builder->update();
    }

    public function deleteNotif($id)
    {
        $builder = $this->db->table('mst_gudon.mst_notification');

        $builder->set('is_active', 0);
        $builder->where('id', $id);

        $builder->update();
    }
}