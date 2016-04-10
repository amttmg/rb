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
 ?>