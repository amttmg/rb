<?php

class Home extends CI_Controller
{
    public function index()
    {
        is_logged_in();
        $data['title'] = "Home";
        $data['content'] = $this->load->view('pages/dashboard', '', true);
        $this->parser->parse('template/page_template', $data);
    }
}