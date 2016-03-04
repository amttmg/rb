<?php

class customerpriority extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mpriority');

    }
    function index()
    {
        $data['priorities']=$this->mpriority->getPriority();
        $data['title'] = "Customer Priority";
        $data['content'] = $this->load->view('pages/customerpriority/customerpriority', $data, true);
        $this->parser->parse('template/page_template', $data);
    }
    function addOption($option,$priorityid){
        $newoption=array(
            'priority_id'=>$priorityid,
            'option_title'=>$option,
            'remarks'=>$option,
            'other_status'=>0,
            'status'=>1
        );
        $this->db->insert('tbl_priorityoptions', $newoption);
       $options= $this->mpriority->getOptions($priorityid);
        $c = 1;
        foreach ($options as $opt) {
            echo '<p>' . $c . ') ' . $opt->option_title . '</p>';
            $c++;
        }
    }
}