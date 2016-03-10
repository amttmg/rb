<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/10/2016
 * Time: 11:03 AM
 */
class Enquiry extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('m_customer', 'customer');
        $this->load->model('mpriority');
        $this->load->model('menquiry', 'enquiry');
        $this->load->helper('notification');

    }

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
    function addEnquiry(){

    }

    function getCustomer($card_no)
    {
        $customerid = $this->customer->getCustomerID($card_no);
        if ($customerid > 0) {
            $customer['customer'] = $this->customer->getCustomers($customerid);
            $customer['enquiry_type'] = $this->enquiry->getEnquiryType();
            $data = $this->load->view('pages/enquiry/_enquiryform', $customer, true);
            echo $data;
        } else {
            echo "Customer Not Found";
        }

    }
}