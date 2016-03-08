<?php

class customerpriority extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mpriority');

        $this->load->helper('form');
        $this->load->library('form_validation');

    }

    function index()
    {

        $data['priorities'] = $this->mpriority->getPriority();
        $data['title'] = "Customer Priority";
        $data['content'] = $this->load->view('pages/customerpriority/customerpriority', $data, true);
        $this->parser->parse('template/page_template', $data);
    }

    function add()
    {
        if (isset($_POST['submit'])) {
            if(isset($_POST['mchoice'])){
                $multichoice=1;
            }else{
                $multichoice=0;
            }

            $newpriority = array(
                'title' => $_POST['prioritytitle'],
                'multichoice' => $multichoice,
                'official_status' => 1,
                'status' => 1,
            );

            $this->db->insert('tbl_customerspriority', $newpriority);
        }
        redirect('customerpriority');

    }

    function addOption($option, $priorityid)
    {
        $newoption = array(
            'priority_id' => $priorityid,
            'option_title' => rawurldecode($option),
            'remarks' => $option,
            'other_status' => 0,
            'status' => 1
        );
        $this->db->insert('tbl_priorityoptions', $newoption);
        $options = $this->mpriority->getOptions($priorityid);
        $c = 1;
        foreach ($options as $opt) {
            echo '<p>' . $c . ') ' . $opt->option_title . '</p>';
            $c++;
        }
    }
}
