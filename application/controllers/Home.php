<?php

class Home extends CI_Controller
{
    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('welcome');
        }
        $data['total_customer']=$this->count_users();
        $data['total_orders']=$this->count_orders();
        $data['total_enquiry']=$this->count_customer_enquiry();
        $data['total_products']=$this->count_products();
        $data['latest_orders']=$this->latest_orders();
        $data['title'] = "Home";
        $data['content'] = $this->load->view('pages/dashboard',$data, true);
        $this->parser->parse('template/page_template', $data);
    }

    public function count_users()
    {
        $total=$this->db->count_all('tbl_customers');
               $this->db->where('status','pending');
       $new= $this->db->count_all_results('tbl_customers');
       
       return $new.'/'.$total;
    }

    public function count_orders()
    {
        $completed='';

         $total=$this->db->count_all('tbl_orders');
         

                    $this->db->select('order_id');
         $order_list=$this->db->get('tbl_orders');
         if($order_list->num_rows() > 0)
         {
            foreach ($order_list->result() as $order) 
            {
               $completed=&$this->count_order_complete($order->order_id);
            }
         }

         return $completed.'/'.$total;
    }

    public function count_customer_enquiry()
    {
       $total=$this->db->count_all('tbl_enquiry');
       return $total;
    }

    public function &count_order_complete($order_id)
    {
        static $count=0;

        $complete=false;
        $this->db->where('order_id',$order_id);
        $query=$this->db->get('tbl_order_details');
        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $order_detail) 
           {
                if($order_detail->complated_at==null && $order_detail->status==true)
                {
                    $complete=false;
                }
                else
                {
                    $complete=true;
                }
           }
               
        }
        else
        {
             $complete=false;
        }

        if ($complete==false) 
        {
            $count=$count+1;
        } 
        return $count;
    }

    public function count_products()
    {
        return $this->db->count_all('tbl_products');
    }

    public function latest_orders()
    {
        $master=array();
        $this->db->where('complated_at is null', null, false);
        $this->db->where('status',true);
        $this->db->order_by('order_detail_id','desc');
        $this->db->limit(10);
        $data=$this->db->get('tbl_order_details')->result();
        //print_r($data);
        foreach ($data as $order) 
        {
            $temp['order_no']=$order->order_no;
            if ($order->reference_product_id) 
            {
                $temp['product_name']=$this->find_product_name($order->reference_product_id);
            }
            else
            {
                $temp['product_name']="not defined";
            }
            array_push($master, $temp);
        }
        
        return $master;
    }

    public function find_product_name($id)
    {
        $this->db->select('tbl_product_category.*');
        $this->db->from('tbl_product_category');
        $this->db->join('tbl_products','tbl_products.product_id=tbl_product_category.category_id');
        $this->db->where('tbl_product_category.category_id',$id);
        $data=$this->db->get()->result();
        if ($data) 
        {
            return $data[0]->category;
        }
        else
        {
            return "not defined";
        }
       
    }

   
   
}