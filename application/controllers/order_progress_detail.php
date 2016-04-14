<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_progress_detail extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_product','product');
		$this->load->model('M_metal','metal');
		$this->load->model('m_stone','stone');
		$this->load->helper('tagCheck');
		
	}

	public function index()
	{
		
		$data['title'] = "Orders Progress Detail";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_detail','', true);
        $this->parser->parse('template/page_template', $data);
	}

	public function save_progress($order_detail_id,$id)
	{
		$data=array(
			'order_detail_id'=>$order_detail_id,
			'date'=>$this->input->post('date'),
			'remarks'=>$this->input->post('remarks'),
			'order_status_id'=>$this->input->post('order_status'),
			'user_id'=> $this->ion_auth->get_user_id()
			);
		$this->db->insert('tbl_order_progress',$data);
		$this->session->set_flashdata('message', 'Progress status added successfully !');
		redirect('order_progress_detail/view_progress/'.$id,'refresh');
	}

	public function view_progress($order_id)
	{
		$this->load->model('m_product_category','product_category');//load model for get product category to fill dropdown box
		$data['product_categories']=$this->product_category->get_product_category();
		$data['metals']=$this->metal->get_metals();
		$data['metal_type']=$this->metal->get_metaltype();
		$data['stones']=$this->stone->get_stones();
		$data['remarks_progress']=$this->get_order_progress_by_remarks($order_id);
		$data['order_status']=$this->fill_order_status();
		$data['order_details']=$this->get_order_details($order_id);
		$data['customer_detail']=$this->get_customer_by_order($order_id);
		$data['title'] = "Orders Progress Detail";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_detail',$data, true);
        $this->parser->parse('template/page_template', $data);
	}
	
	public function get_customer_by_order($order_id)
	{
		$this->db->select('tbl_customers.*,tbl_orders.remarks,tbl_orders.updated_at,tbl_orders.complate,tbl_orders.order_id,tbl_orders.status,tbl_order_details.order_no,tbl_order_details.order_detail_id,tbl_order_details.complated_at,tbl_order_details.status as order_detail_status');
		$this->db->from('tbl_orders');
		$this->db->join('tbl_customers','tbl_customers.customer_id=tbl_orders.customer_id');
		$this->db->join('tbl_order_details','tbl_order_details.order_id=tbl_orders.order_id');
		$this->db->where('tbl_orders.order_id',$order_id);
		return $this->db->get()->result();
	}

	public function get_order_details($order_id)
	{
		$master=array();
		$this->db->select('tbl_order_details.*,tbl_products.product_id,model_no,tbl_products.price,tbl_products.image_url,tbl_product_category.category');
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

	public function get_order_progress($order_detail_id,$order_progress_id='')
	{
		$this->db->select('tbl_order_progress.*,users.username,tbl_order_status.status');
		$this->db->from('tbl_order_progress');
		$this->db->join('users','users.id=tbl_order_progress.user_id');
		$this->db->join('tbl_order_status','tbl_order_status.order_status_id=tbl_order_progress.order_status_id');
		$this->db->order_by('tbl_order_progress.date','asc');
		if ($order_progress_id) 
		{
			$this->db->where('tbl_order_progress.order_progress_id',$order_progress_id);
			echo(json_encode($this->db->get()->result()));
			return ;
		}
		$this->db->where('tbl_order_progress.order_detail_id',$order_detail_id);
		
		return ($this->db->get()->result());
	}

	public function get_order_progress_by_remarks($order_id)
	{
		$this->db->select('tbl_order_progress.*,users.username,tbl_order_details.status,tbl_order_details.complated_at');
		$this->db->from('tbl_order_progress');
		$this->db->join('tbl_order_details','tbl_order_details.order_detail_id=tbl_order_progress.order_detail_id');
		$this->db->join('users','users.id=tbl_order_progress.user_id');
		$this->db->join('tbl_order_status','tbl_order_status.order_status_id=tbl_order_progress.order_status_id');
		$this->db->where('tbl_order_details.reference_product_id',null);
		$this->db->where('tbl_order_details.order_id',$order_id);
		return $this->db->get()->result();
	}

	public function fill_order_status()
	{
		$query=$this->db->get('tbl_order_status');

		if ($query->num_rows() > 0)
		{
		  	return $query->result();
		}
	}

	public function complate_order($order_id,$order_detail_id)
	{
		

//		$data['title'] = "Complate Order";
//        $data['content'] = $this->load->view('pages/orders/cancel_order_view',$data, true);
//        $this->parser->parse('template/page_template', $data);
		$data=array(
			'complated_at'=>getCurrentDate()
			);
		$this->db->where('order_detail_id',$order_detail_id);
		$this->db->update('tbl_order_details',$data);
		$this->session->set_flashdata('message', 'One order complated successfully !!!');
		redirect('order_progress_detail/view_progress/'.$order_id,'refresh');
	}

	public function cancel_order($order_id,$order_detail_id)
	{
		$data=array(
			'status'=>false
			);
		$this->db->where('order_detail_id',$order_detail_id);
		$this->db->update('tbl_order_details',$data);
		$this->session->set_flashdata('message', 'One order canceled successfully !!!');
		redirect('order_progress_detail/view_progress/'.$order_id,'refresh');
	}

}

/* End of file order_progress_detail.php */
/* Location: ./application/controllers/order_progress_detail.php */