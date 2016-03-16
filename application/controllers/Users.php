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
    }

    function index()
    {

    }

    function group()
    {
        $groups['groups']=$this->ion_auth->groups()->result();
        $content['content']=$this->load->view('pages/users/group', $groups, true);
        $content['title']='Group management';
        $this->parser->parse('template/page_template', $content);
    }
}