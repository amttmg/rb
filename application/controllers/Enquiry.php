<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/10/2016
 * Time: 11:03 AM
 */
class Enquiry extends CI_Controller
{
    private $image_name = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('m_customer', 'customer');
        $this->load->model('mpriority');
        $this->load->model('menquiry', 'enquiry');
        $this->load->helper('notification');
        $this->load->library('form_validation');

    }

    function index()
    {
        $data['enquirydetails'] = $this->enquiry->get_details();
        $data['title'] = "Enquiry deatails";
        $data['content'] = $this->load->view('pages/enquiry/enquirydetails', $data, true);
        $this->parser->parse('template/page_template', $data);
    }

    function newEnquiry()
    {
        $data['title'] = "Create Customer";
        $data['content'] = $this->load->view('pages/enquiry/newenquiry', '', true);
        $this->parser->parse('template/page_template', $data);
    }

    function addEnquiry()
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('enquiry_date', 'Enquiry date', 'trim|required');
        $this->form_validation->set_rules('enquiry_time', 'Enquiry time', 'trim|required');
        $this->form_validation->set_rules('enquiry_type', 'Enquiry type', 'trim|required');
        $this->form_validation->set_rules('followup_date', 'Followup date', 'trim|required');
        $this->form_validation->set_rules('enquiry_items', 'Enquiry items', 'trim|required|min_length[2]|max_length[200]');
        $this->form_validation->set_rules('intended_purchasemode', 'Intended purchasemode', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('price_range_min', 'Price range min', 'trim');
        $this->form_validation->set_rules('price_range_max', 'Price range max', 'trim');
        $this->form_validation->set_rules('reference_img', 'Reference image', 'callback_validate_image');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|min_length[2]|max_length[200]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == True) {
            $master['message'] = "Customer enquiry saved successfully !";
            $this->enquiry->insert($this->image_name);
        } else {
            $master['status'] = false;
            foreach ($_POST as $key => $value) {
                if (form_error($key) != '') {
                    $data['error_string'] = $key;
                    $data['input_error'] = form_error($key);
                    array_push($master, $data);
                }
            }
        }
        echo(json_encode($master));

    }

    function getCustomer($card_no = '')
    {
        if ($card_no != '') {
            $customerid = $this->customer->getCustomerID($card_no);
            if ($customerid > 0) {
                $customer['customer'] = $this->customer->getCustomers(md5($customerid));
                $customer['enquiry_type'] = $this->enquiry->getEnquiryType();
                $data = $this->load->view('pages/enquiry/_enquiryform', $customer, true);
                echo $data;
            } else {
                echo "<p>Customer Not Found</p>";
            }
        }else{
            echo "<p>Customer Not Found</p>";
        }

    }

    public function validate_image()
    {

        $config['upload_path'] = './uploads/';
        $config['file_name'] = uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('reference_img')) {
            if (stristr($this->upload->display_errors(), 'You did not select a file to upload')) {

                return true;
            } else {
                $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                return false;
            }

        } else {
            $this->image_name = $this->upload->data('file_name');
            return true;
        }

    }
}