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
        $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
        return $new_group_id;
    }
}