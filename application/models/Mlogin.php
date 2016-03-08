<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/02/2016
 * Time: 12:55 PM
 */
class Mlogin extends CI_Model
{
    public function validate()
    {

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $this->db->where('user_name', $username);
        $this->db->where('user_password', $password);

        $query = $this->db->get('tbl_users');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $data = array(
                'userid' => $row->user_id,
                'username' => $row->user_name,
                'role' => $row->user_role,
                'logged_in' => true
            );

            $this->session->set_userdata($data);
            return true;
        }

        return false;
    }
}
