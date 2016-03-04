<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_customer extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function insert($image_name='default_customer.jpeg')
	{       //transaction start
            $this->db->trans_begin();

		$data=array(
            'fname'=>$this->input->post('name'),
            'mname'=>$this->input->post('mname'),
            'lname'=>$this->input->post('lname'),
            'address'=>$this->input->post('address'),
            'email'=>$this->input->post('email'),
            'phone1'=>$this->input->post('phone1'),
            'phone2'=>$this->input->post('phone2'),
            'gender'=>$this->input->post('gender'),
            'marital_status'=>$this->input->post('marital_status'),
            'anniversary_date'=>$this->input->post('aniversary_date'),
            'dob'=>$this->input->post('dob'),
            'user_id'=>1,
            'entry_datetime'=>date('Y-m-d'),
            'customer_image'=>$image_name,
            );
		$this->db->insert('tbl_customers',$data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }
	}

	public function update($id,$image_name="customer_default.jpeg")
	{
		$data=array(
            'fname'=>$this->input->post('name'),
            'mname'=>$this->input->post('mname'),
            'lname'=>$this->input->post('lname'),
            'address'=>$this->input->post('address'),
            'email'=>$this->input->post('email'),
            'phone1'=>$this->input->post('phone1'),
            'phone2'=>$this->input->post('phone2'),
            'gender'=>$this->input->post('gender'),
            'marital_status'=>$this->input->post('marital_status'),
            'anniversary_date'=>$this->input->post('aniversary_date'),
            'dob'=>$this->input->post('dob'),
            'user_id'=>1,
            'customer_image'=>$image_name,
            );
		$this->db->update('customers',$data);
	}
	

}

/* End of file m_customer.php */
/* Location: ./application/models/m_customer.php */