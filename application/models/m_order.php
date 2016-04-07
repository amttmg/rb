<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert()
	{
		$reference=false;

		if($this->input->post('remarks'))
		{
			$reference=true;
		}
		$data=array(
			'customer_id'=>$this->input->post('customer'),
			'order_date'=>$this->input->post('order_date'),
			'deadline_date'=>$this->input->post('deadline_date'),
			'remarks'=>$this->input->post('remarks'),
			'is_reference'=>$reference
			);
		$this->db->insert('tbl_orders',$data);
		return $this->db->insert_id();
	}

	

}

/* End of file m_order.php */
/* Location: ./application/models/m_order.php */