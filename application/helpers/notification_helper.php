<?php

 function pending_customer()
 {
 	$CI =& get_instance();
    $CI->load->database();
    $CI->db->where('status','pending');
    return $CI->db->count_all_results('tbl_customers');
 } 

 ?>