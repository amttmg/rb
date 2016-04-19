<?php
	 function tag_check($order_no)
	 {
	 	$CI =& get_instance();
	 	$CI->db->where('order_no',$order_no);
	 	$query=$CI->db->get('tbl_products');

	 	if ($query->num_rows() > 0) 
	 	{
	 		return true;
	 	}
	 	else
	 	{
	 		return false;
	 	}
	 }

	function find_taged_model_no($order_no)
	 {
	 		$CI =& get_instance();
	 		$CI->db->select('model_no');
	 		$CI->db->where('order_no',$order_no);
	 		$result=$CI->db->get('tbl_products')->result();
	 		return $result[0]->model_no;
	 	
	 }
	 function find_taged_product_id($order_no)
	 {
	 		$CI =& get_instance();
	 		$CI->db->select('product_id');
	 		$CI->db->where('order_no',$order_no);
	 		$result=$CI->db->get('tbl_products')->result();
	 		return $result[0]->product_id;
	 	
	 }
 ?>