<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/10/2016
 * Time: 3:28 PM
 */
class Menquiry extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    function getEnquiryType()
    {
        $qry = $this->db->get('tbl_enquirytype');
        return $qry->result();
    }

    public function insert($image_url)
    {
    	$data=array(
    		'customer_id'=>$this->input->post('customer_id'),
    		'enquiry_date'=>$this->input->post('enquiry_date'),
    		'enquiry_time'=>$this->input->post('enquiry_time'),
    		'enquiry_type'=>$this->input->post('enquiry_type'),
    		'followup_date'=>$this->input->post('followup_date'),
    		'enquiry_items'=>$this->input->post('enquiry_items'),
    		'intended_purchasemode'=>$this->input->post('intended_purchasemode'),
    		'price_range_min'=>$this->input->post('price_range_min'),
    		'price_range_max'=>$this->input->post('price_range_max'),
    		'reference_img'=>$image_url,
    		'remarks'=>$this->input->post('remarks')
    		);
    	$this->db->insert('tbl_enquiry',$data);
    }
}