<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/03/2016
 * Time: 12:13 PM
 */
class Mpriority extends CI_Model
{
    function getPriority()
    {
        $sql = "select * from tbl_customerspriority";
        $qry = $this->db->query($sql);
        $result = $qry->result();
        $data = array();
        $master = array();
        foreach ($result as $r) {
            $opt = $this->getOptions($r->priority_id);
            $data['priority'] = $r;
            $data['options'] = $opt;
            array_push($master, $data);
        }
       return $master;
    }

    function getOptions($priority_id)
    {
        $sql = "select * from tbl_priorityoptions where priority_id=$priority_id";
        $qry = $this->db->query($sql);
        $result = $qry->result();
        return $result;
    }


}
