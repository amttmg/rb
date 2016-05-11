<?php 

	function swap_log($card_no)
	{
		$CI =& get_instance();

		$CI->db->where('card_no',$card_no);
		$result=$CI->db->get('tbl_cards');

		if ($result->num_rows() > 0) 
		{
				$data=array(
				'card_no'=>$card_no,
				'date'=>getCurrentDateTime()
				);
		
			$CI->db->insert('tbl_swap_log',$data);
		}

		
	}

 ?>