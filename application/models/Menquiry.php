<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/10/2016
 * Time: 3:28 PM
 */
class Menquiry extends CI_Model
{
    function getEnquiryType()
    {
        $qry = $this->db->get('tbl_enquirytype');
        return $qry->result();
    }
}