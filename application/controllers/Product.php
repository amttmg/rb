<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	private $image_name='';
	private $update_image_info="yes";//flag for check user update image or not

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_product','product');
		$this->load->model('M_metal','metal');
		$this->load->model('m_stone','stone');
		$this->load->library('datatables');
		$this->load->library('table');
	}

	public function index()
	{
		$tmpl = array ( 'table_open'  => '<table id="product_table" border="1" cellpadding="2" cellspacing="1" class="table">' );
        $this->table->set_template($tmpl); 
        
        $this->table->set_heading('model_no','net_weight','gross_weight','price','image_url','Actions');
		$this->load->model('m_product_category','product_category');//load model for get product category to fill dropdown box
		$view_data['product_categories']=$this->product_category->get_product_category();
		$view_data['metals']=$this->metal->get_metals();
		$view_data['metal_type']=$this->metal->get_metaltype();
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
		$this->form_validation->set_rules('category', 'Category', 'callback_dropdown_fun');
		$this->form_validation->set_rules('grossweight', 'Gross weight', 'trim|required');
		$this->form_validation->set_rules('netweight', 'Net weight', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->db->trans_start();

			/*insert product and return product id*/
			$product_id=$this->product->insert_product($this->image_name);

			/*insert metal details*/
			if(!empty($_POST['metal']))
			{
				$metal=$_POST['metal'];
				$weight=$_POST['weight'];
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
			if(!empty($_POST['stone']))
			{
				$pcs=$_POST['pcs'];
				$cts=$_POST['cts'];
				$stone=$_POST['stone'];

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
			//if all transation success then insert data to database otherwise rollback
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

	public function update($product_id)
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('model_no', 'Model Number', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('category', 'Category', 'callback_dropdown_fun');
		$this->form_validation->set_rules('grossweight', 'Gross weight', 'trim|required');
		$this->form_validation->set_rules('netweight', 'Net weight', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('photo', 'Photo', 'callback_validate_image');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->product->delete_metal_details($product_id);/*delete all metal details belongs to current product*/
			$this->product->delete_stone_details($product_id);/*delete all stone details belongs to current product*/
			$this->db->trans_start();
			/*insert product and return product id*/
			if($this->update_image_info=="yes")
			{
				$this->product->update_product($product_id,$this->image_name);
			}
			else
			{
				$this->product->update_product_without_image($product_id);
			}
			/*update metal details*/
			if(!empty($_POST['metal']))
			{
				$metal=$_POST['metal'];
				$weight=$_POST['weight'];
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
			if(!empty($_POST['stone']))
			{
				$pcs=$_POST['pcs'];
				$cts=$_POST['cts'];
				$stone=$_POST['stone'];

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
			//if all transation success then insert data to database otherwise rollback
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

	public function validate_image()
	{
			$config['upload_path'] = './uploads/';
            $config['file_name'] = uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {
                if (stristr($this->upload->display_errors(), 'You did not select a file to upload')) {
                	$this->update_image_info="no";
                    return true;
                } else {
                    $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                    $this->update_image_info="no";
                    return false;
                }

            } else {
                $this->image_name = $this->upload->data('file_name');
                $this->update_image_info="yes";
                return true;
            }
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

	public function fill_metal_combo($value)
	{
		$this->db->where('metal_type',$value);
		$metal_combo=$this->db->get('tbl_metals')->result();
		echo(json_encode($metal_combo));
	}

	public function datatable()
	{
		$this->datatables->select('tbl_products.product_id,tbl_products.model_no,tbl_products.net_weight,tbl_products.gross_weight,tbl_products.price,tbl_products.image_url','tbl_product_category.category')->from('tbl_products')
		->join('tbl_product_category','tbl_product_category.category_id=tbl_products.category_id')
		->unset_column('product_id')
		->add_column('Actions','<a href="#editProduct" class="btnedit" data-productid="$1"><span class="label label-primary"><i class="fa fa-edit"></i> Edit</span></a> <a href="#" class="btnviewdetails" data-productid="$1"><span class="label label-primary"><i class="fa fa-folder-open"></i> View details</span></a>', 'product_id');
        echo $this->datatables->generate();
	}

	public function ajax_list()
	{
		$list = $this->product->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $product) {
			$no++;
			$row = array();
			$row[] = $product->model_no;
			$row[] = $product->category;
			$row[] = $product->net_weight;
			$row[] = $product->gross_weight;
			$row[] = $product->price;
			$row[] = '<a class="image-popup-link" href="'.base_url("uploads/").'/'.$product->image_url.'"><img src="'.base_url("uploads/").'/'.$product->image_url.'" width="50px"/></a>';

			//add html for action
			$row[] = '<a href="#editProduct" class="btnedit btn btn-xs btn-primary" data-productid="'.$product->product_id.'"><i class="fa fa-edit"></i> Edit</a> <a href="#" class="btnviewdetails btn btn-xs btn-primary" data-productid="$product->product_id"><i class="fa fa-folder-open"></i> View details</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->product->count_all(),
						"recordsFiltered" => $this->product->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_product_detail($id)
	{
		$this->db->where('product_id',$id);
		$data=$this->db->get('tbl_products')->result();
		echo(json_encode($data));
	}

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */