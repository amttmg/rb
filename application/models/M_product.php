<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert_product($image)
	{
		$data=array(
			'category_id'=>$this->input->post('category'),
			'model_no'=>$this->input->post('model_no'),
			'gross_weight'=>$this->input->post('grossweight'),
			'weight_loss'=>$this->input->post('weight_loss'),
			'net_weight'=>$this->input->post('netweight'),
			'price'=>$this->input->post('price'),
			'image_url'=>$image,
			'entry_date'=>getCurrentDate(),
			'entry_by'=>getCurrentUserID()
			);
		$this->db->insert('tbl_products',$data);
		return $this->db->insert_id();
	}


	

}

/* End of file M_product.php */
/* Location: ./application/models/M_product.php */