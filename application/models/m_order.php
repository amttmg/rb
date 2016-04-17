<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert()
    {
        $reference = false;

        if ($this->input->post('remarks')) {
            $reference = true;
        }
        $data = array(
            'customer_id' => $this->input->post('customer'),
            'order_date' => $this->input->post('order_date'),
            'deadline_date' => $this->input->post('deadline_date'),
            'remarks' => $this->input->post('remarks'),
            'is_reference' => $reference
        );
        $this->db->insert('tbl_orders', $data);
        return $this->db->insert_id();
    }

    public function getActiveOrdersByCustomer($customer_id)
    {
        $sql = "SELECT * FROM (tbl_order_details INNER JOIN tbl_orders on tbl_orders.order_id=tbl_order_details.order_id) inner JOIN tbl_products on tbl_products.order_no=tbl_order_details.order_no WHERE tbl_orders.customer_id='$customer_id' and tbl_order_details.status=1 and tbl_products.status!='sold'";
        $qry = $this->db->query($sql);
        $result = $qry->result();
        return $result;
    }

    public function getActiveOrdersByModelNo($model_no)
    {
       
        $this->db->select('tbl_products.*,tbl_product_category.category');
        $this->db->from('tbl_products');
        $this->db->join('tbl_product_category','tbl_product_category.category_id=tbl_products.category_id');
        $this->db->where('tbl_products.model_no',$model_no);
        /*$this->db->where('tbl_products.status !=sold',null);*/
        $result = $this->db->get()->result();
        return $result;
    }


}

/* End of file m_order.php */
/* Location: ./application/models/m_order.php */