<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/10/2016
 * Time: 11:03 AM
 */
class Enquiry extends CI_Controller
{
    function index()
    {
        echo "hello";
    }

    function newEnquiry()
    {
        $data['title'] = "Create Customer";
        $data['content'] = $this->load->view('pages/enquiry/newenquiry', '', true);
        $this->parser->parse('template/page_template', $data);
    }
}