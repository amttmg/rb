<?php

 function pending_customer()
 {
 	$CI =& get_instance();
    $CI->load->database();
    $CI->db->where('status','pending');
    return $CI->db->count_all_results('tbl_customers');
 } 

 function order_reminder()
 {
 	$CI =& get_instance();
 	$today=getCurrentDate();
	$today=strtotime($today);
	$master=array();

	$CI->db->select('tbl_orders.order_id,tbl_customers.fname,tbl_orders.remind_date,tbl_orders.deadline_date,tbl_customers.mname,tbl_customers.lname');
	$CI->db->from('tbl_orders');
	$CI->db->join('tbl_customers','tbl_customers.customer_id=tbl_orders.customer_id');
	/*$CI->db->where('remind_date < =',getCurrentDate());
	$CI->db->where('deadline_date > =',getCurrentDate());*/
	$data=$CI->db->get()->result();

	foreach ($data as  $order) 
	{
		if($order->remind_date)
		{
			if ($today >=strtotime($order->remind_date) && $today<=strtotime($order->deadline_date) ) 
			{
				$date1=date_create($order->deadline_date);
				$date2=date_create($order->remind_date);
				$diff=date_diff($date1,$date2);
				$data['orders']=array(
					'order_id'=>$order->order_id,
					'customer'=>$order->fname.' '.$order->mname.' '.$order->lname,
					'date_diff'=>$diff->format("%a")
					);
				
				$master[]=$order;
			}
		}
		
		
	}
	return $master;

 }

 function followup_reminder()
 {
 		
 	$CI =& get_instance();
 	$today=getCurrentDate();
	$today=strtotime($today);
	$master=array();

	$CI->db->from('tbl_enquiry');
	$data=$CI->db->get()->result();

	foreach ($data as  $enquiry) 
	{

		$date=date_create($enquiry->followup_date);
        $date= date_format($date,"Y-m-d");
        $date=date_create($date);
        date_sub($date,date_interval_create_from_date_string("5 days"));

        $remind_date=date_format($date,"Y-m-d");

		if ($today >=strtotime($remind_date) && $today<=strtotime($enquiry->followup_date) ) 
		{
			$master[]=$order;
		}
		
	}
	return $master;
 }

 ?>