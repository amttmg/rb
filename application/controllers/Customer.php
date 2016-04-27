<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/02/2016
 * Time: 4:45 PM
 */
class Customer extends CI_Controller
{

    private $image_name = "default.jpg";
    private $images = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('m_customer', 'customer');
        $this->load->model('mcard', 'card');
        $this->load->model('menquiry', 'enquiry');
        $this->load->model('mpriority');
        $this->load->helper('notification');

    }

    // Display customer entry form
    public function index($offset = 0)
    {
        $data['title'] = "Customers";
        $cust['customers'] = $this->customer->getCustomersWithCard();
        $data['content'] = $this->load->view('pages/customers/customerdisplay', $cust, true);
        $this->parser->parse('template/page_template', $data);
    }

    // Add a new Customer
    public function add()
    {
        if (!checkaccess(currenturl())) {
            show_access_denied();
            return;
        }
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('lname', 'last Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_customers.email]');
        $this->form_validation->set_rules('phone1', 'Phone Number', 'trim|required|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
        $this->form_validation->set_rules('aniversary_date', 'Aniversary date', 'trim|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
        //for family section validation
        for ($i = 1; $i <= 5; $i++) {
            if ($this->input->post('faname' . $i)) {
                $this->form_validation->set_rules('faphoto' . $i, 'Photo', 'callback_validate_image[faphoto' . $i . ']');
            }
        }
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == TRUE) {

            if ($this->input->post('snap_image_code')) 
           {
                define('UPLOAD_DIR', 'uploads/');
                $img = str_replace(' ', '+', $this->input->post('snap_image_code'));
                $data = base64_decode($img);
                 $file_name=uniqid() . '.PNG';
                $file = UPLOAD_DIR .$file_name ;
                $success = file_put_contents($file, $data);
                $this->image_name=$file_name;

           }
           
            $existing_customer = "";
            $inhouse_refer_id = "";
            if ($this->input->post('refered_id')) {
                if ($this->input->post('customer_refer') == 0) {
                    $dt = explode(':', $this->input->post('reference'));
                    $existing_customer = $dt[1];
                } else {
                    $dt = explode(':', $this->input->post('reference'));
                    $inhouse_refer_id = $dt[1];
                }
            }
            $this->db->trans_begin();
            $this->customer->insert($this->image_name);
            $this->customer->insert_family($this->images);
            $this->customer->insert_refer($this->input->post('customer_refer'), $inhouse_refer_id, $existing_customer, $this->session->userdata('customer_id'));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->session->unset_userdata('customer_id');
                $this->session->set_flashdata('message', 'Customer added successfully !');
                //echo("success fully inserted data");
                redirect('customer/index', 'refresh');
            }

        } else {
            $data['priorities'] = $this->mpriority->getPriority();
            $data['title'] = "Create Customer";
            $data['content'] = $this->load->view('pages/customers/newcustomer', $data, true);
            $this->parser->parse('template/page_template', $data);

        }


    }

    //Update one customer
    public function update($id = '')
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        if ($id) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[64]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('phone1', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required');
            $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run() == True) {
                $master['message'] = "Customer updated successfully !";
                $this->customer->update($id);
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
    }

    //Delete one customer
    public function delete($id = NULL)
    {

    }

    public function validate_image($val, $image_name = null)
    {
        if ($image_name) {
            $config['upload_path'] = './uploads/';
            $config['file_name'] = uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($image_name)) {
                if (stristr($this->upload->display_errors(), 'You did not select a file to upload')) {
                    $this->images[] = "";
                    return true;
                } else {
                    $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                    return false;
                }


            } else {
                $this->images[] = $this->upload->data('file_name');
                return true;
            }
        } else {
            $config['upload_path'] = './uploads/';
            $config['file_name'] = uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {
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

    public function test()
    {
        $data = array();
        $this->load->database();
        $this->db->like('fname', $this->input->get('term'));
        $query = $this->db->get('tbl_customers');
        foreach ($query->result() as $customer) {
            $data[$customer->customer_id] = $customer->fname . ":" . $customer->customer_id;
        }
        echo(json_encode($data));

    }

    function customerdetails($id)
    {
        $this->db->where('md5(customer_id)', $id);
        $cust['customer_family'] = $this->db->get("tbl_customerfamily")->result();
        $data['title'] = "Customers Details";
        $cust['customer'] = $this->customer->getCustomers($id);
        $cust['hascard'] = $this->card->hasCard($id);
        $cust['cards'] = $this->card->getAllCards($id);
        $cust['enquiry'] = $this->enquiry->getEnquiry($id);
        $cust['enquiry_type'] = $this->enquiry->getEnquiryType();
        if (count($cust['customer']) > 0) {
            $data['content'] = $this->load->view('pages/customers/customerdetails', $cust, true);
            $this->parser->parse('template/page_template', $data);
        } else {
            show_404();
        }

    }

    public function verify($id = "")
    {
        if (!$id) {
            show_404();
        } else {
            $this->customer->verify_customer($id, "verified");
            $this->session->set_flashdata('message', 'Customer successfully verified !');
            redirect('customer/customerdetails/' . $id, 'refresh');

        }
    }

    public function customer_all_records()
    {
        $this->db->where('customer_id', $this->input->post('customer_id'));
        $query = $this->db->get("tbl_customerfamily");
        $query1['families'] = $query->result();
        $data['priorities'] = array('a' => 'a');
        array_push($query1, $data);
        echo(json_encode($query1));
    }

    public function printCard($customer_id = '')
    {
        if ($customer_id != '') {
            $data['customer'] = $this->customer->getCustomers(md5($customer_id));
            $data['card'] = $this->card->getCard($customer_id);
            echo $this->load->view('pages/customers/printcard', $data, true);
        } else {
            echo "Customer Not Found";
        }
    }

    public function get_customer($id)
    {
        $customer = $this->customer->getCustomers($id);
        echo(json_encode($customer));

    }

    //call when need to add new family member
    public function add_new_family($id)
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('name', 'Family name', 'trim|required|min_length[2]|max_length[64]');
        $this->form_validation->set_rules('address', 'Family address', 'trim|min_length[2]|max_length[64]');
        $this->form_validation->set_rules('phone1', 'Phone 1', 'trim|min_length[2]|max_length[15]');
        $this->form_validation->set_rules('phone2', 'Phone 2', 'trim|min_length[2]|max_length[15]');
        $this->form_validation->set_rules('relation', 'Relation', 'trim|required|min_length[2]|max_length[64]');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == True) {
            $master['message'] = "New family member added successfully !";
            $this->customer->add_new_family($id, $this->image_name);
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

    public function get_customer_by_id($id, $status = true)
    {

        $this->db->where('customer_id', $id);
        $data = $this->db->get('tbl_customers')->result();
        if ($status == true) {
            ?>

            <div class="panel-default panel">
                <div class="panel-heading"><h4 class="panel-title">Customer Details</h4></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <td class="text-bold">Name</td>
                                    <td>:</td>
                                    <td><?php echo $data[0]->fname . ' ' . $data[0]->mname . ' ' . $data[0]->lname ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Address</td>
                                    <td>:</td>
                                    <td> <?php echo $data[0]->address ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Phone</td>
                                    <td>:</td>
                                    <td> <?php echo $data[0]->phone1 ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <img class="img-circle thumbnail pull-right" alt="Cinque Terre" height="136"
                                 src="<?php echo base_url('uploads/' . $data[0]->customer_image) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php

//             $temp='<div class="user-block"><a href="'.base_url('uploads/').'/'.($data[0]->customer_image).'" class="image-link">
//                  <img class="img-circle img-bordered-sm" src="'.base_url("uploads/".$data[0]->customer_image).'" alt="user image"></a>
//                  <span class="username">
//                    <a href="'.site_url("customer/customerdetails/").'/'.md5($data[0]->customer_id).'">'.$data[0]->fname.' '.$data[0]->mname.' '.$data[0]->lname.'</a>
//                    <span class="badge label-primary"><i class="fa fa-phone"></i> '.$data[0]->phone1.'</span>
//                    <br/><address>
//                Address: '.$data[0]->address.'<br/>
//                </address>
//
//                  </span>
//                </div>';
//
//             echo($temp);
        } else {
            echo(json_encode($data));
        }

    }

    public function getCustomerID($card_no)
    {
        $customer_id = $this->customer->getCustomerID($card_no);
        if ($customer_id > 0) {
            echo $customer_id;
        } else {
            echo "0";
        }


    }

}
