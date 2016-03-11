<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/09/2016
 * Time: 11:52 AM
 */
class Card extends CI_Controller
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
        $card['cards'] = $this->card->getCard();
        $data['title'] = "Cards";
        $data['content'] = $this->load->view('pages/customers/newcustomer',$data, true);
        $this->parser->parse('template/page_template', $data);

    }

    function addCard()
    {
        $result = $this->card->addCard();
        if ($result) {
            $this->session->set_flashdata('message', 'Card added successfully !');
        } else {
            $this->session->set_flashdata('message', 'Card added not successfully !');
        }
        redirect('customer/customerdetails/' . md5($_POST['customer_id']));
    }
}