<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_category extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//to insert product category
	public function insert()
	{
		$data=array(
			'category'=>$this->input->post('category'),
			'remarks'=>$this->input->post('remarks')
			);

		$this->db->insert('tbl_product_category',$data);
	}

	public function update($id)
	{
		$data=array(
			'category'=>$this->input->post('category'),
			'remarks'=>$this->input->post('remarks')
			);
		$this->db->where('category_id',$id);
		$this->db->update('tbl_product_category',$data);
	}

	public function get_product_category($id='')
	{
		if(!$id)
		{
			return $this->db->get('tbl_product_category')->result();
		}
		else
		{
			$this->db->where('category_id',$id);
			$query=$this->db->get('tbl_product_category')->result_array();
			return $query;
		}
	}

	

}

/* End of file M_product_category.php */
/* Location: ./application/models/M_product_category.php */