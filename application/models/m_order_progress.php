<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Order_progress extends CI_Model {

	
	var $table = 'tbl_orders';
	var $column = array('order_date','fname','deadline_date'); //set column field database for order and search
	var $order = array('tbl_orders.order_id'=>'desc');
	var $data=array();     //array for set search textfield data-column value

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($order_detail_id)
	{
		$data=array(
			'order_detail_id'=>$order_detail_id,
			'date'=>$this->input->post('date'),
			'remarks'=>$this->input->post('remarks'),
			'order_status_id'=>$this->input->post('order_status'),
			'user_id'=> $this->ion_auth->get_user_id()
			);
		$this->db->insert('tbl_order_progress',$data);
	}

	 private function _get_datatables_query()
	 {
		$this->db->select('tbl_orders.*,tbl_customers.fname,tbl_customers.lname,tbl_customers.mname,tbl_customers.customer_id');
		$this->db->from($this->table);
		$this->db->join('tbl_customers','tbl_customers.customer_id=tbl_orders.customer_id');
		$i = 0;
		/*$this->between_date('salesdate',$_POST['columns'][1]['search']['value'],$_POST['columns'][2]['search']['value']);
		$this->between_date('entry_date',$_POST['columns'][3]['search']['value'],$_POST['columns'][4]['search']['value']);*/
		if($this->data)
		{
			foreach ($this->data as $key => $value) 
			{
				if(!empty($_POST['columns'][$value]['search']['value']) )
				{  
			   		$this->db->like($key,$_POST['columns'][$value]['search']['value'],'after');
			   		
				}	
			}
		}
		foreach ($this->column as $item) // loop column ;
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}

	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function between_date($field_name,$start_date,$end_date)
	{
		if($start_date!="" && $end_date!='')
		{

			if(date('Y-m-d', strtotime($start_date)) <  date('Y-m-d', strtotime($end_date)))
			{
				$this->db->where(''.$field_name.' BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			}
			else if (date('Y-m-d', strtotime($start_date)) == date('Y-m-d', strtotime($end_date))) 
			{
				$this->db->where($field_name.' >',date('Y-m-d', strtotime($start_date)));
			}
		
		}
		else if($start_date!='' && $end_date=='')
		{
			$this->db->where($field_name.' >',date('Y-m-d', strtotime($start_date)));
		}
	}
}

/* End of file m_laxmicard.php */
/* Location: ./application/models/m_laxmicard.php */