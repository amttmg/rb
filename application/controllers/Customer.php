<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/02/2016
 * Time: 4:45 PM
 */
class Customer extends CI_Controller
{
    function newCustomer()
    {
        echo "hello";
        $d['d'] = array();
        $data['title'] = "Create Customer";
        $data['content'] = $this->load->view('pages/customers/newcustomer', $d, true);
        $this->parser->parse('template/page_template', $data);
    }
}