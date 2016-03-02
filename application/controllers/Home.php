<?php

class Home extends CI_Controller
{
    public function index()
    {
        is_logged_in();
        $this->load->library('parser');
        $data['title'] = "Home";
        $this->parser->parse('template/page_template', $data);
    }
}