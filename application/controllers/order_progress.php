<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_progress extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_order_progress','order_progress');
	}

	public function index()
	{
		$data['title'] = "Orders Progress";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_view','', true);
        $this->parser->parse('template/page_template', $data);
	}

	public function save($order_detail_id,$id)
	{
		$this->order_progress->insert($order_detail_id);
		$this->session->set_flashdata('message', 'Progress status updated successfully!');
		redirect('order_progress_detail/view_progress/'.$id,'refresh');
	}

	public function datatables()
	{
		$this->load->model('m_order_progress');
		$list = $this->m_order_progress->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $order) {
			$no++;
			$row = array();
			$row[]=$no;
			$row[]=$order->fname.' '.$order->mname.' '.$order->lname;
			$row[] = $order->order_id;
			$row[] = $order->order_date;
			$row[] = $order->deadline_date;
			$row[]='<a href="'.site_url('order_progress_detail/view_progress/').'/'.$order->order_id.'" class="btn_order_progress btn btn-xs btn-primary" data-orderid=""><i class="fa fa-edit"></i> View Detail</a>';
			//add html for action
			//$row[] = '<a href="'.base_url("users/Edit/$user->user_id").'" class="jqui_button"> Edit </a><a href="'.base_url("users/EditPassword/$user->user_id").'" id="changePwdButton" class="jqui_button" > Change Password </a></span>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order_progress->count_all(),
						"recordsFiltered" => $this->m_order_progress->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}

/* End of file order_progress.php */
/* Location: ./application/controllers/order_progress.php */