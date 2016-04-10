<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model {

	var $table = 'tbl_products';
	var $column = array('model_no','gross_weight','net_weight','price','category'); //set column field database for order and search
	var $order = array('tbl_products.product_id' => 'desc'); // default order 

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
	public function complate_product($order_id,$image)
	{
		$data=array(
			'category_id'=>$this->input->post('category'),
			'model_no'=>$this->input->post('model_no'),
			'gross_weight'=>$this->input->post('grossweight'),
			'weight_loss'=>$this->input->post('weight_loss'),
			'net_weight'=>$this->input->post('netweight'),
			'price'=>$this->input->post('price'),
			'image_url'=>$image,
			'order_no'=>$order_id,
			'entry_date'=>getCurrentDate(),
			'entry_by'=>getCurrentUserID()
			);
		$this->db->insert('tbl_products',$data);
		return $this->db->insert_id();
	}
	public function update_product($id,$image)
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
		$this->db->where('product_id',$id);
		$this->db->update('tbl_products',$data);
	}

	public function update_product_without_image($id)
	{
		$data=array(
			'category_id'=>$this->input->post('category'),
			'model_no'=>$this->input->post('model_no'),
			'gross_weight'=>$this->input->post('grossweight'),
			'weight_loss'=>$this->input->post('weight_loss'),
			'net_weight'=>$this->input->post('netweight'),
			'price'=>$this->input->post('price'),
			'entry_date'=>getCurrentDate(),
			'entry_by'=>getCurrentUserID()
			);
		$this->db->where('product_id',$id);
		$this->db->update('tbl_products',$data);
	}

	public function delete_metal_details($product_id)
	{
		$this->db->where('product_id',$product_id);
		$this->db->delete('tbl_metal_details');
	}

	public function delete_stone_details($product_id)
	{
		$this->db->where('product_id',$product_id);
		$this->db->delete('tbl_stone_details');
	}

	private function _get_datatables_query()
	{
		$this->db->select('tbl_products.*,tbl_product_category.category');
		$this->db->from($this->table);
		$this->db->join('tbl_product_category','tbl_product_category.category_id=tbl_products.category_id');
		if(isset($_POST['tag']))
		{
			$this->db->where('order_no is null',null);
		}

		$i = 0;
		if( !empty($_POST['columns'][1]['search']['value']) )
		{  
	   		$this->db->like('model_no',$_POST['columns'][1]['search']['value'],'after');
	   		
		}
		if( !empty($_POST['columns'][2]['search']['value']) )
		{   
	   		$this->db->like('category',$_POST['columns'][2]['search']['value'],'after');
	   		
		}
		if( !empty($_POST['columns'][3]['search']['value']) )
		{   
	   		$this->db->like('net_weight',$_POST['columns'][3]['search']['value'],'after');
	   		
		}
		if( !empty($_POST['columns'][4]['search']['value']) )
		{   
	   		$this->db->like('gross_weight',$_POST['columns'][4]['search']['value'],'after');
	   		
		}
		if( !empty($_POST['columns'][5]['search']['value']) )
		{   
	   		$this->db->like('price',$_POST['columns'][5]['search']['value'],'after');
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

}

/* End of file M_product.php */
/* Location: ./application/models/M_product.php */