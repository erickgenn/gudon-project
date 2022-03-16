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

    public function getMostSoldProduct()
    {
        $builder = $this->db->table('mst_gudon.mst_product');
        $builder->select(
            '
            mst_product.name as nama_produk,
            mst_product.id as id_produk,
            count(mst_product.id) as total,
            '
        );
        $builder->join('mst_gudon.mst_detail_order', 'mst_detail_order.product_id = mst_product.id');
        $builder->join('mst_gudon.mst_order', 'mst_detail_order.order_id = mst_order.id');
        $builder->where('mst_order.status', 'SELESAI');
        $builder->where('mst_order.customer_id', $_SESSION['id']);
        $builder->groupBy("mst_product.id");
        $builder->orderBy('total', 'DESC');
        $builder->limit(5);

        return $builder->get();
    }
}
