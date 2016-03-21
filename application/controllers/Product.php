<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_product','product');
		$this->load->model('M_metal','metal');
		$this->load->model('m_stone','stone');
	}

	public function index()
	{
		$this->load->model('m_product_category','product_category');//load model for get product category to fill dropdown box
		$view_data['product_categories']=$this->product_category->get_product_category();
		$view_data['metals']=$this->metal->get_metals();
		$view_data['stones']=$this->stone->get_stones();
		$data['title'] = "Products";
        $data['content'] = $this->load->view('pages/products/product_view',$view_data, true);
        $this->parser->parse('template/page_template', $data);

	}
	public function add()
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('model_no', 'Model Number', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_rules('grossweight', 'Net weight', 'trim|required');
		$this->form_validation->set_rules('netweight', 'price', 'trim');
		$this->form_validation->set_rules('price', 'price', 'trim');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->db->trans_start();

			/*insert product and return product id*/
			$product_id=$this->product->insert_product();

			/*insert metal details*/
			$metal=$_POST['metal'];
			$weight=$_POST['weight'];
			if($metal)
			{
				foreach ($metal as $key=>$value) {
					$data=array(
						'metal_id'=>$value,
						'product_id'=>$product_id,
						'weight'=>$weight[$key]
						);
					$this->db->insert('tbl_metal_details',$data);
				}
			}

			/*insert stone details*/
			$stone=$_POST['stone'];
			$pcs=$_POST['pcs'];
			$cts=$_POST['cts'];
			if($stone)
			{
				foreach ($stone as $key => $value) {
					
					$data=array(
						'stone_id'=>$value,
						'product_id'=>$product_id,
						'pcs'=>$pcs[$key],
						'cts'=>$cts[$key]
						);
					$this->db->insert('tbl_stone_details',$data);
				}
			}

			$this->db->trans_complete();
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
	

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */