<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_enquiryimage extends CI_Model {

	public function insert($enquiry_id,$images)
	{
		foreach ($images as $image) 
		{
			$data=array(
				'enquiry_id'=>$enquiry_id,
				'image_url'=>$image
				);
			$this->db->insert('tbl_enquiryimages',$data);
		}
	}

	

}

/* End of file M_enquiryimage.php */
/* Location: ./application/models/M_enquiryimage.php */