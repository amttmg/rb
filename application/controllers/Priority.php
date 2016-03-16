<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Priority extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	public function get_options($priority_id)
	{
		$this->db->where('priority_id',$priority_id);
		$query=$this->db->get('tbl_priorityoptions')->result();
		echo(json_encode($query));
	}
	public function option_info($customer_id)
	{
		$this->db->where('customer_id',$customer_id);
		$query=$this->db->get('tbl_customerpriorityoption')->result();
		echo(json_encode($query));
	}

	public function update()
	{
		$data=array();
		$data['status']=false;
		$priority_id=$this->input->post('modal_priority_id');
		if($this->input->post('modal_multichoice')=='1')
		{
			$checkbox=array();
			$checkbox=$_POST[$priority_id];
			$this->db->where('customer_id',$this->input->post('modal_customer_id'));
			$this->db->where('priority_id',$this->input->post('modal_priority_id'));
			$this->db->delete('tbl_customerpriorityoption');
			foreach ($checkbox as $key => $value) 
			{
				$data=array(
					'customer_id'=>$this->input->post('modal_customer_id'),
					'priority_id'=>$this->input->post('modal_priority_id'),
					'option_id'=>$value
					);
				$this->db->insert('tbl_customerpriorityoption',$data);
			}
		}
		else
		{
			$this->db->where('priority_id',$this->input->post('modal_priority_id'));
			$this->db->where('customer_id',$this->input->post('modal_customer_id'));
			$this->db->update('tbl_customerpriorityoption',array('option_id'=>$this->input->post($priority_id)));
		}
		$data['status']=true;

		echo(json_encode($data));
	}

}

/* End of file Priority.php */
/* Location: ./application/controllers/Priority.php */