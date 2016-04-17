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
        $this->load->model('M_customer', 'customer');
        $this->load->model('m_product', 'product');

    }

    function index()
    {
        $data['title'] = "New Sales";
        $selected_products['products'] = $this->cart->contents();
        $data['content'] = $this->load->view('pages/sales/index', $selected_products, true);
        $this->parser->parse('template/page_template', $data);
    }

    public function add()
    {
        $master['status'] = false;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('customer', 'Customer', 'callback_dropdown_fun');
        //$this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('billno', 'Bill No', 'trim|required|min_length[1]|max_length[20]');
        if ($this->form_validation->run() == True)
        {

            $this->db->trans_start();

            $sales_id = $this->sales->insert();
            $discount = $this->input->post('discount');
            $model_no = $this->input->post('model_no');
            $price    = $this->input->post('price');
            $net_price= $this->input->post('net_price');

            if (is_array($model_no))
            {
                foreach ($model_no as $key => $value)
                {
                    $data=array(
                        'sales_id'=>$sales_id,
                        'product_id'=>$value,
                        'dis_per'=>$discount[$key],
                        'price'=>$price[$key],
                        'net_price'=>$net_price[$key],
                        'status'=>1
                    );
                    $this->db->insert('tbl_sales_details',$data);
                }
            }

            $this->db->trans_complete();


            $master['status'] = True;
        }
        else
        {
            $master['status'] = false;
            foreach ($_POST as $key => $value)
            {
                if (form_error($key) != '')
                {
                    $data['error_string'] = $key;
                    $data['input_error'] = form_error($key);
                    array_push($master, $data);
                }
            }
        }
        echo(json_encode($master));
    }

    public function dropdown_fun($value)
    {
        if ($value == '0') {
            $this->form_validation->set_message('dropdown_fun', 'Please select product category');
            return false;
        }
        return true;
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
        $data['title'] = "Sales View";
        $data['content'] = $this->load->view('pages/sales/viewsales', $data, true);
        $this->parser->parse('template/page_template', $data);
    }

    function salesdetails()
    {
        $salesid = $this->input->get('salesid');
        $sales['sales'] = $this->sales->getSales(array("md5(sales_id)" => $salesid));
        if (count($sales['sales'])) {
            $sales['sales_details'] = $this->sales->getSalesDetails(array("md5(sales_id)" => $salesid));
            $sales['customer'] = $this->customer->getCustomers(md5($sales['sales'][0]->customer_id));
            $data['title'] = "Sales View";
            $data['content'] = $this->load->view('pages/sales/viewsalesdetails', $sales, true);
            $this->parser->parse('template/page_template', $data);
        } else {
            show_404();
        }
    }
}