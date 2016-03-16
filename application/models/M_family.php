<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_family extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function update_with_image($image_url)
	{
		$data=array(
			'name'=>$this->input->post('faname'),
			'address'=>$this->input->post('faaddress'),
			'phone1'=>$this->input->post('faphone1'),
			'phone2'=>$this->input->post('faphone2'),
			'relation'=>$this->input->post('farelation'),
			'image_url'=>$image_url
			);
		$this->db->where('id',$this->input->post('family_id'));
		$this->db->update('tbl_customerfamily',$data);
	}
	public function update_without_image()
	{
		$data=array(
			'name'=>$this->input->post('faname'),
			'address'=>$this->input->post('faaddress'),
			'phone1'=>$this->input->post('faphone1'),
			'phone2'=>$this->input->post('faphone2'),
			'relation'=>$this->input->post('farelation'),
			);
		$this->db->where('id',$this->input->post('family_id'));
		$this->db->update('tbl_customerfamily',$data);
	}


	

}

/* End of file M_family.php */
/* Location: ./application/models/M_family.php */