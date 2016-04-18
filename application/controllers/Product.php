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
	public function add($order_no='')
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
			$product_id='';
			/*insert product and return product id*/
			if($order_no==null)
			{
				$product_id=$this->product->insert_product($this->image_name);
			}
			else
			{
				$product_id=$this->product->complate_product($order_no,$this->image_name);

				
			}
			

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

	public function product_order_datatable()
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
			if (!isset($_POST['tag'])) 
			{
				$row[] = '<a href="#" class="btn_order_product btn btn-xs btn-primary" data-productid="'.$product->product_id.'"><i class="fa fa-folder-open"></i>Add To Order</a>';
			}
			else
			{
				$row[] = '<a href="" class="btn_tag_order btn btn-xs btn-primary" data-productid="'.$product->product_id.'"><i class="fa fa-folder-open"></i>Tag To Order</a>';
			}
			//add html for action
			
		
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

	public function product_status($model_no='')
	{
		if ($model_no) 
		{
			$this->db->where('model_no',$model_no);
			$data=$this->db->get('tbl_products');
			if ($data->num_rows() > 0) 
			{
				echo 'true';
			}
			else

			{
				echo 'false';
			}
		}
	}

	public function product_detail_by_productid($product_id)
	{
		$master=array();
		$this->db->where('product_id',$product_id);
		$data=$this->db->get('tbl_products');
		if ($data->num_rows() > 0) 
		{
			$product=$data->result();
			$category=$this->db->from('tbl_product_category')->where('category_id',$product[0]->category_id)->get()->result();
			?>
			<div class="row">
				<div class="panel panel-default">
				<!-- <div class="panel-heading">
					<h3 class="panel-title">Product details</h3>
				</div> -->
					<div class="panel-body">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<table class="table">
		                       <tbody>
				                   <tr>
				                       <td class="text-bold">Model No</td>
				                       <td>:</td>
				                       <td><?php echo($product[0]->model_no) ?></td>
				                   </tr>
				                   <tr>
				                       <td class="text-bold">Category</td>
				                       <td>:</td>
				                       <td> <?php echo $category[0]->category; ?></td>
				                   </tr>
				                   <tr>
				                       <td class="text-bold">Gross weight</td>
				                       <td>:</td>
				                       <td> <?php echo($product[0]->gross_weight); ?></td>
				                   </tr>
				                   <tr>
				                       <td class="text-bold">Net weight</td>
				                       <td>:</td>
				                       <td> <?php echo($product[0]->net_weight); ?></td>
				                   </tr>
				                   <tr>
				                       <td class="text-bold">Weight loss</td>
				                       <td>:</td>
				                       <td> <?php echo($product[0]->weight_loss); ?></td>
				                   </tr>
				                   <tr>
				                       <td class="text-bold">Price</td>
				                       <td>:</td>
				                       <td> <?php echo($product[0]->price); ?></td>
				                   </tr>
		                   	   </tbody>
		                   </table>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<?php if ($product[0]->image_url): ?>
								<img src="<?php echo(base_url('uploads/'.$product[0]->image_url)); ?>" class="img-responsive" alt="Image">
							<?php else: ?>
								<div class="thumbnail pull-right" style="height: 136px; width: 120px; background-color: #f5f5f5"> </div>
							<?php endif ?>
							
						</div>
					</div>
				</div>
			</div>

			<?php
				 $this->db->select('tbl_stone_details.*,tbl_stones.*');
				 $this->db->from('tbl_stone_details');
				 $this->db->join('tbl_stones','tbl_stones.stone_id=tbl_stone_details.stone_id');
				 $this->db->where('tbl_stone_details.product_id',$product[0]->product_id);
				 $temp_stone=$this->db->get();
			?>
			<?php if ($temp_stone->num_rows() > 0): ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Stone Details</h3>
							</div>
							<div class="panel-body">
								<table class="table">
									<thead>
									<tr>
										<th>Lot no</th>
										<th>Type</th>
										<th>Color</th>
										<th>Clarity</th>
										<th>Size</th>
										<th>Pcs</th>
										<th>Cts</th>
									</tr>
										
									</thead>
			                       <tbody>
				                       <?php foreach ($temp_stone->result() as $stone): ?>
				                       		<tr>
				                       			<td><?php echo($stone->lot_no) ?></td>
				                       			<td><?php echo($stone->type) ?></td>
				                       			<td><?php echo($stone->color) ?></td>
				                       			<td><?php echo($stone->clarity) ?></td>
				                       			<td><?php echo($stone->size) ?></td>
				                       			<td><?php echo($stone->pcs) ?></td>
				                       			<td><?php echo($stone->cts) ?></td>
				                       		</tr>
				                       <?php endforeach ?>
			                   	   </tbody>
			                   </table>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>

			<?php 

				$this->db->select('tbl_metal_details.*,tbl_metals.*');
				 $this->db->from('tbl_metal_details');
				 $this->db->join('tbl_metals','tbl_metals.metal_id=tbl_metal_details.metal_id');
				 $this->db->where('tbl_metal_details.product_id',$product[0]->product_id);
				 $temp_metals=$this->db->get();
			
			 ?>
			
			<?php if ($temp_metals->num_rows() > 0): ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Metal Details</h3>
							</div>
							<div class="panel-body">
								<table class="table">
									<thead>
										<tr>
											<th>Metal</th>
											<th>Unit</th>
											<th>Metal Type</th>
											<th>Weight</th>
										</tr>
									</thead>
			                       <tbody>
					                   	<?php foreach ($temp_metals->result() as $metal): ?>
					                   		<td><?php echo($metal->metal) ?></td>
					                   		<td><?php echo($metal->unit) ?></td>
					                   		<td><?php echo($metal->metal_type) ?></td>
					                   		<td><?php echo($metal->weight) ?></td>
					                   	<?php endforeach ?>
			                   	   </tbody>
			                   </table>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			
			<?php

			
			//$master['product']=$product->result_array();
			//$master['stone_details']=;
			//$master['metal_details']=$this->db->from('tbl_metal_details')->where('product_id',$temp[0]->product_id)->get()->result_array();

		}
		
		
	}

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */