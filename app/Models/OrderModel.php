<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'mst_order';
    protected $primaryKey = 'id';


    protected $allowedFields = ['customer_id', 'warehouse_id', 'delivery_courier', 'destination_name', 'destination_address', 'destination_phone', 'total_price', 'delivery_price', 'delivery_name', 'status', 'delivery_status', 'is_active', 'notified'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;

    public function get_detail($id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->select(
            '
            mst_order.id as order_id,
            mst_warehouse.name as nama_warehouse,
            mst_customer.name as nama_customer,
            mst_product.name as nama_produk,
            mst_product.weight as berat_produk,
            mst_product.volume as volume_produk,
            mst_product.quantity as kuantitas_produk,
            mst_order.is_active as is_active,
            mst_order.destination_name as nama_tujuan,
            mst_order.destination_address as alamat_tujuan,
            mst_order.total_price as total_harga,
            mst_order.status as status_order,
            mst_order.delivery_courier as nama_pengiriman,
            mst_order.delivery_price as ongkos_kirim,
            mst_order.delivery_status as status_pengiriman,
        '
        );
        $builder->join('mst_gudon.mst_warehouse', 'mst_warehouse.id = mst_order.warehouse_id');
        $builder->join('mst_gudon.mst_detail_order', 'mst_detail_order.order_id = mst_order.id');
        $builder->join('mst_gudon.mst_product', 'mst_product.id = mst_detail_order.product_id');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_order.customer_id');
        $builder->where('mst_detail_order.order_id', $id);
        $builder->where('mst_order.id', $id);

        return $builder->get();
    }

    public function updateConfirm($id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->set('status', 'TELAH DIKONFIRMASI');
        $builder->where('id', $id);

        $builder->update();
    }

    public function updateNotif($id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->set('notified', 0);
        $builder->where('id', $id);

        $builder->update();
    }

    public function getReportStatus($start_date, $end_date, $status)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        $builder->where('status', $status);
        $builder->where('customer_id', $_SESSION['id']);
        return $builder->get();
    }

    public function getReportDate($start_date, $end_date)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        $builder->where('customer_id', $_SESSION['id']);
        return $builder->get();
    }

    public function getReportAdminDate($start_date, $end_date)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        return $builder->get();
    }

    public function getReportAdminStatus($start_date, $end_date, $status)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        $builder->where('status', $status);
        return $builder->get();
    }

    public function getReportAdminCustomer($start_date, $end_date, $cust_id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        $builder->where('customer_id', $cust_id);
        return $builder->get();
    }

    public function getReportAdminCustomerStatus($start_date, $end_date, $status, $cust_id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $start_date . " 00:00:00.000");
        $builder->where('created_at <=', $end_date . " 23:59:59.999");
        $builder->where('status', $status);
        $builder->where('customer_id', $cust_id);
        return $builder->get();
    }

    public function countOrderDate($date)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->where('created_at >=', $date . " 00:00:00.000");
        $builder->where('created_at <=', $date . " 23:59:59.999");
        $builder->where('customer_id', $_SESSION['id']);
        $builder->where('status', "SELESAI");
        return $builder->get();
    }

    public function deleteOrder($id)
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->set('is_active', 0);
        $builder->set('status', 'BATAL');
        $builder->set('delivery_status', 'BATAL');
        $builder->where('id', $id);

        $builder->update();
    }

    public function check_notified()
    {
        $builder = $this->db->table('mst_gudon.mst_order');
        $builder->select('
            mst_order.id as order_id,
            mst_customer.name as nama_customer,
            mst_customer.email as email_customer,
            mst_order.is_active as is_active,
            mst_order.destination_name as nama_tujuan,
            mst_order.destination_address as alamat_tujuan,
            mst_order.total_price as total_harga,
            mst_order.status as status_order,
            mst_order.created_at as created_at
        ');
        $builder->join('mst_gudon.mst_customer', 'mst_customer.id = mst_order.customer_id');
        $builder->where('mst_order.is_active', 1);
        $builder->where('mst_order.cancel_notified', 0);
        $builder->where('mst_order.status', 'ON PROGRESS');

        return $builder->get();
    }
}
