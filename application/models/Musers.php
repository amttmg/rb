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

    function editGroup()
    {
        $function = $this->input->post('functions');
        $group_id = $this->input->post('group_id');
        $group_update = $this->ion_auth->update_group($group_id, $this->input->post('group_name'), $this->input->post('description'));
        $this->removeFunctions($group_id);
        if ($group_update) {
            foreach ($function as $fun) {
                $newfunctiongroup = array(
                    'group_id' => $group_id,
                    'function_id' => $fun,
                    'status' => 1
                );
                $this->db->insert('function_group', $newfunctiongroup);
            }
        }

    }

    function removeFunctions($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->delete('function_group');
    }

    function getUser($identity)
    {
        $this->db->where('username', $identity);
        return $this->db->get('users')->row();
    }
    function getUserByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }
    function checkCode($id, $code){
        $this->db->where('id', $id);
        $this->db->where('activation_code', $code);
        $result= $this->db->get('users');
        if($result->num_rows()>0){
            return true;
        }else{
            return false;
        }

    }

    function update_user($id, $data){
        $this->db->where('id', $id);
        if($this->db->update('users', $data))
        {
            return true;
        }else{
            return false;
        }
    }
}