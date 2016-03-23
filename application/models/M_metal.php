<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_metal extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert()
	{
		$data=array(
			'metal'=>$this->input->post('metalname'),
			'metal_type'=>$this->input->post('metaltype'),
			'unit'=>$this->input->post('unit')
			);
		$this->db->insert('tbl_metals',$data);
	}

	public function get_metals($id='')
	{
		if(!$id)
		{
			$query=$this->db->get('tbl_metals')->result();
			return $query;
		}
		else
		{
			$this->db->where('metal_id',$id);
			$query=$this->db->get('tbl_metals')->result_array();
			return $query;
		}

	}

	public function update($id)
	{
		$data=array(
			'metal'=>$this->input->post('metal'),
			'metal_type'=>$this->input->post('metaltype'),
			'unit'=>$this->input->post('unit')
			);
		$this->db->where('metal_id',$id);
		$this->db->update('tbl_metals',$data);
	}

	public function get_metaltype()
	{
		return $this->db->query('select distinct(metal_type) from tbl_metals')->result();
	}

	

}

/* End of file M_metal.php */
/* Location: ./application/models/M_metal.php */