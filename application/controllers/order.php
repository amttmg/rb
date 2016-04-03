<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		
	}
	public function index()
	{
		$data['title'] = "Orders";
        $data['content'] = $this->load->view('pages/orders/order_view','', true);
        $this->parser->parse('template/page_template', $data);
	}
	public function add_to_order($product_id='')
	{
		$ordered_product=array();
		$price='';
		$model_no='';
		$qty='';

		$this->db->where('product_id',$product_id);
		$products=$this->db->get('tbl_products')->result();

		foreach ($products as $product) 
		{
			$price=$product->price;
			$model_no=$product->model_no;
		}
		$data = array(
               'id'      => $product_id,
               'qty'     => 1,
               'price'   => $price,
               'name'    => $model_no,
            );
		if($this->cart->insert($data))
		{
			$ordered_product['status']=true;
		}
		else
		{
			$ordered_product['status']=false;
		}
		echo(json_encode($ordered_product));

	}
	public function display_ordered_products()
	{
		$master['products']=array();
		$data=$this->cart->contents() ;
		foreach ($data as $product) 
		{
			$temp=array();
			$temp['row_id']=$product['rowid'];
			$temp['model_no']=$product['name'];
			$temp['price']=$product['price'];
			$temp['product_id']=$product['id'];
			$temp['qty']=$product['qty'];
			$temp['image_url']=$this->get_product_image_url($product['id']);
			array_push($master['products'], $temp);
		}
		$master['status']=true;
		echo(json_encode($master));
	}
	public function destroy_ordered_products()
	{
		$this->cart->destroy();
		echo("destroyed");
	}
	public function get_product_image_url($id)
	{
		$this->db->select('image_url');
		$this->db->where('product_id',$id);
		$data=$this->db->get('tbl_products')->result();
		return (base_url('uploads/'.$data[0]->image_url));
	}

	public function remove_ordered_product($id='')
	{
		$data['status']=false;
		$data = array(
		'rowid'   => $id,
		'qty'     => 0
		);
		if($this->cart->update($data))
		{
			$data['status']=true;
		}
		echo(json_encode($data));
		
	}

}

/* End of file order.php */
/* Location: ./application/controllers/order.php */