<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/16/2016
 * Time: 10:26 AM
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Mcard', 'card');
        $this->load->model('Musers', 'users');
    }

    function index()
    {
        $users['users'] = $this->ion_auth->users()->result();
        $content['content'] = $this->load->view('pages/users/users', $users, true);
        $content['title'] = 'User management';
        $this->parser->parse('template/page_template', $content);
    }

    function group()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $this->db->trans_begin();
                $this->users->createGroup();
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }
            }
        }
        $groups['groups'] = $this->ion_auth->groups()->result();
        $groups['functions'] = $this->users->getFunctions();
        $content['content'] = $this->load->view('pages/users/group', $groups, true);
        $content['title'] = 'Group management';
        $this->parser->parse('template/page_template', $content);

    }

    function getGroup($id)
    {
        $group = $this->ion_auth->group($id)->row();
        echo json_encode($group);
    }

    function getGroupFunctions($id)
    {
        $this->db->where('group_id', $id);
        $functions = $this->db->get('function_group')->result();
        echo json_encode($functions);
    }

    function editGroup()
    {
        $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() == TRUE) {
            $this->db->trans_begin();
            $this->users->editGroup();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
       redirect("users/group");
    }

    function createUser(){

    }
}