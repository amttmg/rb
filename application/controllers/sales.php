<?php

class sales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('m_order', 'order');
        $this->load->model('m_sales', 'sales');
        $this->load->model('m_product', 'product');

    }

    function index()
    {
        $data['title'] = "New Sales";
        $selected_products['products'] = $this->cart->contents();
        $data['content'] = $this->load->view('pages/sales/index', $selected_products, true);
        $this->parser->parse('template/page_template', $data);
    }

    function setcard($product_id)
    {
        $product = $this->product->getProduct($product_id);
        $data = array(
            'id' => $product->product_id,
            'qty' => 1,
            'price' => $product->price,
            'name' => $product->model_no,
            'options' => array('Discount' => '0', 'net_price' => '0')
        );
        print_r($product);
        $this->cart->insert($data);
    }

    function viewSales()
    {
        $data['sales'] = $this->sales->getSales();
        print_r($data);
    }
}