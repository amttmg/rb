<?php

class customerpriority extends CI_Controller
{
    function index()
    {
        $this->load->model('mpriority');
        $data['priorities']=$this->mpriority->getPriority();
        $data['title'] = "Customer Priority";
        $data['content'] = $this->load->view('pages/customerpriority/customerpriority', $data, true);
        $this->parser->parse('template/page_template', $data);
    }
}