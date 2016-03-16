<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_customer extends CI_Model
{

    private $customer_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function insert($image_name = 'default_customer.jpeg')
    {
        $customer_code = 'RB-100'.($this->getMaxCustomerid()+1);
        $data = array(
            'fname' => $this->input->post('fname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone1' => $this->input->post('phone1'),
            'phone2' => $this->input->post('phone2'),
            'gender' => $this->input->post('gender'),
            'marital_status' => $this->input->post('marital_status'),
            'anniversary_date' => $this->input->post('aniversary_date'),
            'dob' => $this->input->post('dob'),
            'user_id' => 1,
            'entry_datetime' => date('Y-m-d'),
            'customer_image' => $image_name,
            'customer_code'=>$customer_code
        );
        $this->db->insert('tbl_customers', $data);

        $this->customer_id = $this->db->insert_id();
        $this->session->set_userdata('customer_id', $this->customer_id);

        $priorites = $this->get_priority();

        foreach ($priorites as $priority) {
            if ($priority->multichoice == 1) {
                if (isset($_POST["$priority->priority_id"])) {
                    $checkbox = $_POST["$priority->priority_id"];

                    foreach ($checkbox as $key => $value) {
                        $data = array(
                            'customer_id' => $this->customer_id,
                            'priority_id' => $priority->priority_id,
                            'option_id' => $value
                        );
                        $this->db->insert('tbl_customerpriorityoption', $data);
                    }
                }

            } else {
                $data = array(
                    'customer_id' => $this->customer_id,
                    'priority_id' => $priority->priority_id,
                    'option_id' => $_POST["$priority->priority_id"]
                );
                $this->db->insert('tbl_customerpriorityoption', $data);
            }

        }


    }

    public function update($id)
    {
        $data = array(
            'fname' => $this->input->post('fname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone1' => $this->input->post('phone1'),
            'phone2' => $this->input->post('phone2'),
            'gender' => $this->input->post('gender'),
            'marital_status' => $this->input->post('marital_status'),
            'anniversary_date' => $this->input->post('anniversary_date'),
            'dob' => $this->input->post('dob'),
            'user_id' => 1,
        );
        $this->db->where('customer_id', $id);
        $this->db->update('tbl_customers', $data);
    }

    public function get_priority()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('tbl_customerspriority');
        return $query->result();
    }

    public function get_priorityoptions($priority_id)
    {
        $query = $this->db->get('tbl_priorityoptions');
        return $query->result();
    }

    function check_multichoice()
    {

    }

    public function getCustomers($id = '')
    {

        if ($id != '') {
            $this->db->where('md5(customer_id)', $id);
            $qry = $this->db->get('tbl_customers');
            return $qry->row();
        } else {
            $qry = $this->db->get('tbl_customers');
            return $qry->result();
        }

    }

    public function getCustomersWithCard($id = '')
    {

        if ($id != '') {
            show_404();
        } else {
            $qry = $this->db->query('select *, ifnull((select card_no from tbl_cards where tbl_cards.customer_id=tbl_customers.customer_id and tbl_cards.status=1), \'No card\') as card_no from tbl_customers');
            return $qry->result();
        }

    }

    function insert_family($images)
    {

        foreach ($images as $key => $value) {
            $name = "faname" . ($key + 1);
            echo($name);
            $data = array(
                'customer_id' => $this->session->userdata('customer_id'),
                'name' => $this->input->post('faname' . ($key + 1)),
                'address' => $this->input->post('faaddress' . ($key + 1)),
                'phone1' => $this->input->post('faphone' . ($key + 1)),
                'phone2' => $this->input->post('faphone2' . ($key + 1)),
                'relation' => $this->input->post('farelation' . ($key + 1)),
                'image_url' => $value
            );
            $this->db->insert('tbl_customerfamily', $data);
        }
    }

    public function insert_refer($inhouse_refer, $inhouse_refer_id, $existing_customer, $customer_id)
    {
        $data = array(
            'customer_id' => $customer_id,
            'inhouse_refer' => $inhouse_refer,
            'inhouse_referby_id' => $inhouse_refer_id,
            'existingcustomer_referby_id' => $existing_customer
        );
        $this->db->insert('tbl_reference', $data);
    }

    public function verify_customer($id, $status)
    {
        $this->db->where('md5(customer_id)', $id);
        $this->db->update('tbl_customers', array('status' => $status));
    }

    public function is_varified_customer()
    {

    }

    public function getCustomerID($card_no)
    {
        $sql = "select customer_id from tbl_cards where card_no=$card_no";
        $qry = $this->db->query($sql);
        $count = $qry->num_rows();
        if ($count > 0) {
            return $qry->row()->customer_id;
        } else {
            return 0;
        }
    }

    public function get_customer_priority($id)
    {

        $priorites = $this->db->query('select *from tbl_customerspriority');
        $this->db->select('*');
        $this->db->from('tbl_customerpriorityoption');
        $this->db->join('tbl_customerspriority', 'tbl_customerspriority.priority_id=tbl_customerpriorityoption.priority_id');
        $this->db->join('tbl_priorityoptions', 'tbl_priorityoptions.option_id=tbl_customerpriorityoption.option_id');
        $this->db->where('tbl_customerpriorityoption.customer_id', $id);
        $pr = $this->db->get()->result();
        $data = array();
        $master = array();
        foreach ($priorites->result() as $priority) {
            $temp = array();
            $data['priority'] = $priority->title;
            $data['priority_id'] = $priority->priority_id;
            $data['multichoice']=$priority->multichoice;
            foreach ($pr as $value) {
                if ($priority->priority_id == $value->priority_id) {
                    $temp[] = $value->option_title;
                }
            }
            $data['option'] = $temp;
            array_push($master, $data);
        }
        return $master;
    }

    //model runs when ajax call(add singel family member at once)
    public function add_new_family($customer_id, $image)
    {
        $data = array(
            'customer_id' => $customer_id,
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'phone1' => $this->input->post('phone1'),
            'phone2' => $this->input->post('phone2'),
            'relation' => $this->input->post('relation'),
            'image_url' => $image,
        );
        $this->db->insert('tbl_customerfamily', $data);
    }

    public function getMaxCustomerid()
    {
        $this->db->select('max(customer_id) as customer_id');
        $qry = $this->db->get('tbl_customers');
        $data = $qry->row();
        return $data->customer_id;
    }

}

/* End of file m_customer.php */
/* Location: ./application/models/m_customer.php */
