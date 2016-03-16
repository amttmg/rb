<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends CI_Controller {
	private $image_name='';
	private $image_status='no';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_family','family');
		$this->load->library('form_validation');
		
	}

	public function update($customer_id)
	{
		$master['status'] = True;
        $data = array();
        $master = array();
		$this->form_validation->set_rules('faphoto', 'Photo', 'callback_validate_image');
		if ($this->form_validation->run() == TRUE) 
		{
			if($this->image_status=='yes')
			{
				$this->family->update_with_image($this->image_name);
			}
			else
			{
				$this->family->update_without_image();
			}
			redirect('customer/customerdetails/'.md5($customer_id),'refresh');
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

	public function get_family($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('tbl_customerfamily')->result();
		echo(json_encode($query));
	}

	public function validate_image()
	{
			$config['upload_path'] = './uploads/';
            $config['file_name'] = uniqid();
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('faphoto')) {
                if (stristr($this->upload->display_errors(), 'You did not select a file to upload')) {
                	$this->image_status='no';
                    return true;
                } else {
                    $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                    $this->image_status='no';
                    return false;
                }

            } else {
            	$this->image_status='yes';
                $this->image_name = $this->upload->data('file_name');
                return true;
            }
	}


}

/* End of file family.php */
/* Location: ./application/controllers/family.php */