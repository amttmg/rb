<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_product_category','product_category');
	}

	public function index()
	{
		$con['categories']=$this->product_category->get_product_category();
		$data['title'] = "Products";
        $data['content'] = $this->load->view('pages/categories/category_view',$con, true);
        $this->parser->parse('template/page_template', $data);
	}
	//to add product category
	public function add()
	{
		$master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[64]|is_unique[tbl_product_category.category]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[254]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == True) 
		{
			$this->product_category->insert();
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
	//to update product category
	public function update($product_category_id)
	{
		$master['status'] = True;
        $data = array();
        $master = array();
        $is_unique='';
        if($this->input->post('category')!=$this->input->post('original_category_name'))
        {
        	$is_unique =  '|is_unique[tbl_product_category.category]';
        }
        $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[64]'.$is_unique);
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[254]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == True) 
		{
			$this->product_category->update($product_category_id);
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
	/*to get single product category details according to id supplied*/
	public function get_productcategory_details($id)
	{
		echo(json_encode($this->product_category->get_product_category($id)));
	}

}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */