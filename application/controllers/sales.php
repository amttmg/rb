<?php

class sales extends CI_Controller
{
    function index()
    {
        $data['title'] = "New Sales";
        $data['content'] = $this->load->view('pages/sales/index', '', true);
        $this->parser->parse('template/page_template', $data);
    }

    function setcard($product_id)
    {

    }
}