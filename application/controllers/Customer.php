<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/02/2016
 * Time: 4:45 PM
 */

class Customer extends CI_Controller {

    private $image_name="default.jpg";
    private $images=array();

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
        for ($i=1; $i <=5 ; $i++) 
        { 
            if ($this->input->post('faname'.$i)) 
            {
                $this->form_validation->set_rules('faphoto'.$i, 'Photo', 'callback_validate_image[faphoto'.$i.']');
            }  
        }
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() ==TRUE) 
        {
                    $this->db->trans_begin();
                    $this->customer->insert($this->image_name);
                    $this->customer->insert_family($this->images);
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $this->session->unset_userdata('customer_id');
                        $this->session->set_flashdata('message', 'Customer added successfully !');
                        //echo("success fully inserted data");
                        redirect('customer/index','refresh');
                    }
        
        } 
        else 
        {
            $data['priorities']=$this->mpriority->getPriority();
            $data['title'] = "Create Customer";
            $data['content'] = $this->load->view('pages/customers/newcustomer',$data, true);
            $this->parser->parse('template/page_template', $data); 

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
    public function validate_image($val,$image_name=null)
    {
        if($image_name)
        {
            $config['upload_path'] = './uploads/';
            $config['file_name']=uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload($image_name))
            {
                if(stristr($this->upload->display_errors(),'You did not select a file to upload'))
                {
                    $this->images[]=$this->image_name;
                    return true;
                }
                else
                {
                    $this->form_validation->set_message('validate_image',$this->upload->display_errors());
                    return false;
                }

                
            }
            else
            {
                $this->images[]=$this->upload->data('file_name');
               return true;
            }
        }
        else
        {
            $config['upload_path'] = './uploads/';
            $config['file_name']=uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('photo'))
            {
                if(stristr($this->upload->display_errors(),'You did not select a file to upload'))
                {
                    
                    return true;
                }
                else
                {
                    $this->form_validation->set_message('validate_image',$this->upload->display_errors());
                    return false;
                }
                
            }
            else
            {
                $this->image_name=$this->upload->data('file_name');
               return true;
            }
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

    //customer display
    function customers(){
        $data['title'] = "Customers";
        $cust['customers']=$this->customer->getCustomers();
        $data['content'] = $this->load->view('pages/customers/customerdisplay',$cust, true);
        $this->parser->parse('template/page_template', $data);
    }

    function customerdetails($id){
        $data['title'] = "Customers Details";
        $cust['customer']=$this->customer->getCustomers($id);
        $data['content'] = $this->load->view('pages/customers/customerdetails',$cust, true);
        $this->parser->parse('template/page_template', $data);
    }
}
