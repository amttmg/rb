<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_progress extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_order_progress','order_progress');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->model('m_customer','customer');
		$data['customers']=$this->customer->getCustomers();
		$data['title'] = "Orders Progress";
        $data['content'] = $this->load->view('pages/orderprogress/order_progress_view',$data, true);
        $this->parser->parse('template/page_template', $data);
	}

	public function save($order_detail_id,$id)
	{
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('order_status', 'order_status', 'callback_dropdown_fun');
		if ($this->form_validation->run() == TRUE) {

			$this->order_progress->insert($order_detail_id);
			$this->session->set_flashdata('message', 'Progress status added successfully!');
			
		} else {
			# code...
		}
		
		redirect('order_progress_detail/view_progress/'.$id,'refresh');
	}

	public function update($progress_id)
	{
		$master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('order_status', 'order_status', 'callback_dropdown_fun');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == True) 
		{
			$data=array(
			'remarks'=>$this->input->post('remarks'),
			'date'=>$this->input->post('date'),
			'order_status_id'=>$this->input->post('order_status'),
			'updated_at'=> getCurrentDate(),
			'user_id'=>$this->ion_auth->get_user_id()
			);

			$this->db->where('order_progress_id',$progress_id);
			$this->db->update('tbl_order_progress',$data);
			$master['status'] = True;
		} 
		else 
		{
			$master['status'] = false;
            foreach ($_POST as $key => $value) 
            {
                if (form_error($key) != '') 
                {
                    $data['error_string'] = $key;
                    $data['input_error'] = form_error($key);
                    array_push($master, $data);
                }
            }
           
		}
		echo(json_encode($master));
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
			if ($this->check_order_complate($order->order_id)) 
			{
				$row[]='<small class="label label-success"><i class="fa  fa-check"></i> Order Complated !</small>';
			}
			else
			{
				$row[]='<small class="label label-warning">Order is in progress !</small>';
			}
			$row[]='<a href="'.site_url('order_progress_detail/view_progress/').'/'.$order->order_id.'" class="btn_order_progress btn btn-xs btn-primary" data-orderid=""><i class="fa fa-edit"></i> View Detail</a>  <a href="#" class="btn_edit_order btn btn-xs btn-primary" data-customerid="'.$order->customer_id.'" data-orderid="'.$order->order_id.'"><i class="fa fa-edit"></i>Edit</a>';
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
	public function dropdown_fun($value)
	{
		if($value=='0')
		{
			$this->form_validation->set_message('dropdown_fun', 'Please select product category');
			return false;
		}
		return true;
	}

	public function get_order_progress($order_progress_id)
	{
		$this->db->get('');
	}

	public function check_order_complate($order_id)
	{
		$status=true;
		$this->db->where('order_id',$order_id);
		$query=$this->db->get('tbl_order_details');
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $order_detail) 
		   {
		   		if($order_detail->complated_at==null && $order_detail->status==true)
		   		{
		   			return false;
		   		}
		   		
		   }
			   
		}
		else
		{
			return false;
		}

		return $status;
		


	}

	public function get_order_information($order_id)
	{
		$this->db->select('tbl_order_details.*,tbl_products.product_id,tbl_products.model_no');
		$this->db->from('tbl_order_details');
		$this->db->join('tbl_products','tbl_products.product_id=tbl_order_details.reference_product_id');
		$this->db->where('tbl_order_details.order_id',$order_id);
		echo(json_encode($this->db->get()->result()));
	}

	public function order_customer_information($order_id)
	{
		$this->db->select('tbl_orders.*,tbl_customers.fname,tbl_customers.mname,tbl_customers.lname,tbl_customers.email,tbl_customers.phone1,tbl_customers.phone2,tbl_customers.gender,tbl_customers.customer_image');
		$this->db->from('tbl_orders');
		$this->db->join('tbl_customers','tbl_customers.customer_id=tbl_orders.customer_id');
		$this->db->where('tbl_orders.order_id',$order_id);
		echo(json_encode($this->db->get()->result()));
	}

}

/* End of file order_progress.php */
/* Location: ./application/controllers/order_progress.php */