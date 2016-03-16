<?php

class Home extends CI_Controller
{
    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('welcome');
        }
        $data['title'] = "Home";
        $data['content'] = $this->load->view('pages/dashboard', '', true);
        $this->parser->parse('template/page_template', $data);
    }
}