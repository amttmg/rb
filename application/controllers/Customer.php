<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/02/2016
 * Time: 4:45 PM
 */

class Customer extends CI_Controller {

    private $image_name="";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('m_customer','customer');

    }

    // Display customer entry form
    public function index( $offset = 0 )
    {
        $data['title'] = "Create Customer";
        $data['content'] = $this->load->view('pages/customers/newcustomer', '', true);
        $this->parser->parse('template/page_template', $data);
    }

    // Add a new Customer
    public function add()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_customers.email]');
        $this->form_validation->set_rules('phone1', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
        $this->form_validation->set_rules('aniversary_date', 'Aniversary date', 'trim|required');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() ==TRUE) 
        {
            $this->customer->insert($this->image_name);
            $this->session->set_flashdata('message', 'Customer added successfully !');
            redirect('customer/index','refresh');
        } 
        else 
        {
            $data['title'] = "Create Customer";
            $data['content'] = $this->load->view('pages/customers/newcustomer', '', true);
            $this->parser->parse('template/page_template', $data); 
        }
    }

    //Update one customer
    public function update( $id = NULL )
    {
        if ($id) 
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_customers.email]');
            $this->form_validation->set_rules('phone1', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
            $this->form_validation->set_rules('aniversary_date', 'Aniversary date', 'trim|required');
            $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run() ==TRUE) 
            {
                $this->customer->update($id);
                $this->session->set_flashdata('message', 'Customer added successfully !');
                //redirect('customer/index','refresh');
            } 
            else 
            {
                $data['title'] = "Create Customer";
                $data['content'] = $this->load->view('pages/customers/newcustomer', '', true);
                $this->parser->parse('template/page_template', $data); 
            }
        }
        else
        {
            show_404();
        }
    }

    //Delete one customer
    public function delete( $id = NULL )
    {

    }
    public function validate_image()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
            
            $this->form_validation->set_message('validate_image',$this->upload->display_errors());
            return false;
        }
        else
        {
            $this->image_name=$this->upload->data('file_name');
           return true;
        }
    }
}
