<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stone extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert()
	{
		$data=array(
			'lot_no'=>$this->input->post('lot_no'),
			'type'=>$this->input->post('type'),
			'color'=>$this->input->post('color'),
			'clarity'=>$this->input->post('clarity'),
			'size'=>$this->input->post('size')
			);
		$this->db->insert('tbl_stones',$data);
	}

	public function update($id)
	{
		$data=array(
			'lot_no'=>$this->input->post('lot_no'),
			'type'=>$this->input->post('type'),
			'color'=>$this->input->post('color'),
			'clarity'=>$this->input->post('clarity'),
			'size'=>$this->input->post('size')
			);
		$this->db->where('stone_id',$id);
		$this->db->update('tbl_stones',$data);
	}

	public function get_stones($id='')
	{
		if(!$id)
		{
			return $this->db->get('tbl_stones')->result();
		}
		else
		{
			$this->db->where('stone_id',$id);
			return $this->db->get('tbl_stones')->result_array();
		}
	}

}

/* End of file M_stone.php */
/* Location: ./application/models/M_stone.php */