<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_metal','metal');
		
	}

	public function index()
	{
		$data['metals']=$this->metal->get_metals();
        $data['title'] = "Metals";
        $data['content'] = $this->load->view('pages/metals/metal',$data, true);
        $this->parser->parse('template/page_template', $data);
	}

	public function add()
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('metalname', 'Metal Name', 'trim|required|is_unique[tbl_metals.metal]|max_length[64]');
		$this->form_validation->set_rules('metaltype', 'Metal Type', 'callback_dropdown_fun');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required|max_length[64]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == True) 
		{
			$this->metal->insert();
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

	public function update($id='')
	{
		if(!$id)
		{
			show_404();
		}
		$master['status'] = True;
        $data = array();
        $master = array();
        $metal=$this->db->from('tbl_metals')->where('metal_id',$id)->get()->result();
        $is_unique='';
        
        if($this->input->post('metal')!=$metal[0]->metal)
        {
        	$is_unique =  '|is_unique[tbl_metals.metal]';
        }

		$this->form_validation->set_rules('metal', 'Metal Name', 'trim|required|max_length[64]'.$is_unique);
		$this->form_validation->set_rules('metaltype', 'Metal Type', 'callback_dropdown_fun');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required|max_length[64]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == True) 
		{
			$this->metal->update($id);
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
	//exatract one metal details for fill form according to metal id supplied
	public function get_metal($id)
	{
		echo(json_encode($this->metal->get_metals($id)));
	}
	public function dropdown_fun($value)
	{
		if($value=='0')
		{
			$this->form_validation->set_message('dropdown_fun', 'Please select metal type ');
			return false;
		}
		return true;
	}

	public function get_metal_details($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_metal_details');
		$this->db->join('tbl_metals','tbl_metals.metal_id=tbl_metal_details.metal_id');
		$this->db->where('tbl_metal_details.product_id',$product_id);
		$data=$this->db->get()->result();
		echo(json_encode($data));
	}

}

/* End of file Metal.php */
/* Location: ./application/controllers/Metal.php */