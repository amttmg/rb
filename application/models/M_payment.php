<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_payment extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($order_id,$type)
	{
		$data=array();
		if ($type=='advance') 
		{
			$data=array(
			'amount'=>$this->input->post('discount'),
			'order_id'=>$order_id,
			'type'=>$type,
			'created_at'=>getCurrentDateTime(),
			'user_id'=>$this->ion_auth->get_user_id()
			);
		}
		
		$this->db->insert('tbl_payments',$data);
	}

	public function update($order_id)
	{
		$data=array(
			'amount'=>$this->input->post('discount'),
			'type'=>$type,
			'created_at'=>getCurrentDateTime(),
			'user_id'=>$this->ion_auth->get_user_id()
			);
		
		$this->db->where('order_id',$order_id);
		$this->db->update('tbl_payments',$data);
	}

	

}

/* End of file M_payment.php */
/* Location: ./application/models/M_payment.php */