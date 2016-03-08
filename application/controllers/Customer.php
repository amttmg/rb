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
        $this->load->model('mpriority');

    }

    // Display customer entry form
    public function index( $offset = 0 )
    {
        $data['priorities']=$this->mpriority->getPriority();
        $data['title'] = "Create Customer";
        $data['content'] = $this->load->view('pages/customers/newcustomer',$data, true);
        $this->parser->parse('template/page_template', $data);
    }

    // Add a new Customer
    public function add()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('lname', 'last Name', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_customers.email]');
        $this->form_validation->set_rules('phone1', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
        $this->form_validation->set_rules('aniversary_date', 'Aniversary date', 'trim|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() ==TRUE) 
        {
            $this->customer->insert($this->image_name);
            $this->session->set_flashdata('message', 'Customer added successfully !');
            //echo("success fully inserted data");
            redirect('customer/index','refresh');
        } 
        else 
        {
            $data['priorities']=$this->mpriority->getPriority();
            $data['title'] = "Create Customer";
            $data['content'] = $this->load->view('pages/customers/newcustomer',$data, true);
            $this->parser->parse('template/page_template', $data); 
            echo("validtaion false");
        }
    }

    //Update one customer
    public function update( $id = NULL )
    {
        if ($id) 
        {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[5]|max_length[100]');
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

    public function insert_family()
    {
        $count=0;
        $data=array();
        for ($i=1; $i <=5 ; $i++) 
        { 
            if ($this->input->post('faname'.$i)) 
            {
                $count++;
                $this->form_validation->set_rules('faname'.$i, 'Name', 'trim|required|min_length[2]|max_length[100]');
                $this->form_validation->set_rules('faaddress'.$i, 'Address', 'trim|required|min_length[2]|max_length[100]');
                $this->form_validation->set_rules('faphone'.$i, 'Name', 'trim|required|min_length[8]|max_length[15]');
                $this->form_validation->set_rules('faphone2'.$i, 'Name', 'trim|min_length[8]|max_length[15]');
                $this->form_validation->set_rules('farelation'.$i, 'Relation', 'trim|required|min_length[5]|max_length[15]');
            }  
        }
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
       if ($this->form_validation->run() == FALSE) 
       {
            $data['priorities']=$this->mpriority->getPriority();
            $data['title'] = "Create Customer";
            $data['content'] = $this->load->view('pages/customers/newcustomer',$data, true);
            $this->parser->parse('template/page_template', $data); 
       } 
       else 
       {
          echo("successfully validate");
       }

    }

    public function test()
    {
        /*$data=1;
        $checkbox=$_POST["$data"];
        foreach ($checkbox as $key => $value) {
            echo($value);
        }*/

        echo($this->input->post('2'));
    }
}
