<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stone extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_stone','stone');
	}

	public function index()
	{
		$data['stones']=$this->stone->get_stones();
        $data['title'] = "Stones";
        $data['content'] = $this->load->view('pages/stones/stone_view',$data, true);
        $this->parser->parse('template/page_template', $data);
	}

	public function add()
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('lot_no', 'Lot Number', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('color', 'Color', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('clarity', 'Clarity', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('size', 'Size', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == True) 
		{
			$this->stone->insert();
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

	public function update($id)
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('lot_no', 'Lot Number', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('color', 'Color', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('clarity', 'Clarity', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_rules('size', 'Size', 'trim|required|min_length[2]|max_length[64]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == True) 
		{
			$this->stone->update($id);
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

	public function get_stone($id)
	{

		echo(json_encode($this->stone->get_stones($id)));
	}

}

/* End of file Stone.php */
/* Location: ./application/controllers/Stone.php */