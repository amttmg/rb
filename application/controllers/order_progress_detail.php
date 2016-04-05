<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_progress_detail extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data['title'] = "Orders Progress Detail";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_detail','', true);
        $this->parser->parse('template/page_template', $data);
	}

	public function view_progress($order_id)
	{
		$data['order_status']=$this->fill_order_status();
		$data['order_details']=$this->get_order_details($order_id);
		$data['customer_detail']=$this->get_customer_by_order($order_id);
		$data['title'] = "Orders Progress Detail";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_detail',$data, true);
        $this->parser->parse('template/page_template', $data);
	}

	public function get_customer_by_order($order_id)
	{
		$this->db->select('tbl_customers.*');
		$this->db->from('tbl_orders');
		$this->db->join('tbl_customers','tbl_customers.customer_id=tbl_orders.customer_id');
		$this->db->where('tbl_orders.order_id',$order_id);
		return $this->db->get()->result();
	}

	public function get_order_details($order_id)
	{
		$master=array();
		$this->db->from('tbl_order_details');
		$this->db->join('tbl_products','tbl_products.product_id=tbl_order_details.reference_product_id');
		$this->db->join('tbl_product_category','tbl_product_category.category_id=tbl_products.category_id');
		$this->db->where('order_id',$order_id);
		$data=$this->db->get()->result();
		foreach ($data as $value) 
		{
			$temp=array();
			$temp['order_progress']=$this->get_order_progress($value->order_detail_id);
			$temp['order_details']=$value;
			array_push($master, $temp);
		}
		return $master;
		//print_r($master);
		
	}

	public function get_order_progress($order_detail_id)
	{
		$this->db->select('tbl_order_progress.*,users.username');
		$this->db->from('tbl_order_progress');
		$this->db->join('users','users.id=tbl_order_progress.user_id');
		$this->db->where('tbl_order_progress.order_detail_id',$order_detail_id);
		return ($this->db->get()->result());
	}

	public function fill_order_status()
	{
		$query=$this->db->get('tbl_order_status');

		if ($query->num_rows() > 0)
		{
		  	return $query->result();
		}
	}

}

/* End of file order_progress_detail.php */
/* Location: ./application/controllers/order_progress_detail.php */