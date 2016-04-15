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
}