<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 4/15/2016
 * Time: 2:25 PM
 */
class M_sales extends CI_Model
{
    function getSales($parameters = '')
    {
        $sql = "select * from tbl_sales where 1=1";
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $sql .= " and " . $key . "='" . $value."'";
            }
        }
        $query = $this->db->query($sql);
        $data = $query->result();
        return $data;
    }
    function getSalesDetails($parameters = '')
    {
        $sql = "select * from tbl_sales_details where 1=1";
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $sql .= " and " . $key . "='" . $value."'";
            }
        }
        $query = $this->db->query($sql);
        $data = $query->result();
        return $data;
    }
    public function insert()
    {
        $data=array(
            'bill_no'=>$this->input->post('billno'),
            'customer_id'=>$this->input->post('customer'),
            'sales_date'=>$this->input->post('saledate'),
            'entry_date'=> getCurrentDate(),
            'total_amount'=>$this->input->post('sub_total'),
            'vat_amount'=>$this->input->post('vat'),
            'gtotal_amount'=>$this->input->post('grand_total'),
            'status'=>1,
            'user_id'=>$this->ion_auth->get_user_id()
        );
        $this->db->insert('tbl_sales',$data);
        return $this->db->insert_id();
    }
}