<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/16/2016
 * Time: 12:04 PM
 */
class Musers extends CI_Model
{
    function createGroup()
    {
        $function = $this->input->post('functions');
        $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
        foreach ($function as $fun) {
            $newfunctiongroup = array(
                'group_id' => $new_group_id,
                'function_id' => $fun,
                'status' => 1
            );
            $this->db->insert('function_group', $newfunctiongroup);
        }
        return $new_group_id;
    }

    function getFunctions()
    {
        $this->db->where('status', '1');
        return $this->db->get('tbl_functions')->result();
    }
}