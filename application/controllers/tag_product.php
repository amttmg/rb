<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function tag($product_id,$order_no)
	{

		$data=array(
			'order_no'=>$order_no
			);
		$this->db->where('product_id',$product_id);
		$this->db->update('tbl_products',$data);

		echo("success");
	}

	public function find_order_detail_id($order_no)
	{
		$this->db->select('order_detail_id');
		$this->db->from('tbl_order_details');
		$this->db->where('order_no',$order_no);
		$order_detail_id= $this->db->get()->result();
		return $order_detail_id[0]->order_detail_id;
	}

}

/* End of file tag_product.php */
/* Location: ./application/controllers/tag_product.php */