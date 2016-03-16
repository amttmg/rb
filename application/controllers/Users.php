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
}