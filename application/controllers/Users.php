<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 03/16/2016
 * Time: 10:26 AM
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Mcard', 'card');
        $this->load->model('Musers', 'users');
        $this->load->library(array('ion_auth', 'form_validation'));
    }

    function index()
    {
        $users['users'] = $this->ion_auth->users()->result();
        $content['content'] = $this->load->view('pages/users/users', $users, true);
        $content['title'] = 'User management';
        $this->parser->parse('template/page_template', $content);
    }

    function group()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $this->db->trans_begin();
                $this->users->createGroup();
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }
            }
        }
        $groups['groups'] = $this->ion_auth->groups()->result();
        $groups['functions'] = $this->users->getFunctions();
        $content['content'] = $this->load->view('pages/users/group', $groups, true);
        $content['title'] = 'Group management';
        $this->parser->parse('template/page_template', $content);

    }

    function getGroup($id)
    {
        $group = $this->ion_auth->group($id)->row();
        echo json_encode($group);
    }

    function getGroupFunctions($id)
    {
        $this->db->where('group_id', $id);
        $functions = $this->db->get('function_group')->result();
        echo json_encode($functions);
    }

    function editGroup()
    {
        $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() == TRUE) {
            $this->db->trans_begin();
            $this->users->editGroup();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
        redirect("users/group");
    }

    function createUser()
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');

        $this->form_validation->set_rules('group', 'Group', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = "Password123";//$this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
            $group = array($this->input->post('group'));
            if ($this->ion_auth->register($identity, $password, $email, $additional_data, $group)) {
                $master['message'] = "Customer enquiry saved successfully !";
            }else{
                $master['message'] = "Not regestered";
            }
        } else {
            $master['status'] = false;
            foreach ($_POST as $key => $value) {
                if (form_error($key) != '') {
                    $data['error_string'] = $key;
                    $data['input_error'] = form_error($key);
                    array_push($master, $data);
                }
            }
        }
        echo json_encode($master);

    }

    function activeUser($identity, $id, $code = false)
    {
        $check = $this->users->checkCode($id, $code);
        if ($check) {
            $data['id'] = $id;
            $data['code'] = $code;
            $data['identity'] = $identity;
            $this->load->view('pages/users/activeuser', $data);
        } else {
            echo "Sorry Unable to active your account please contact to administrator";
        }

    }

    function setPassword($id, $identity, $code)
    {
        $this->form_validation->set_rules('password', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confpassword]');
        $this->form_validation->set_rules('confpassword', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $code = $this->input->post('code');
            $password = $this->input->post('password');
            $identity = $this->input->post('identity');
            $activation = $this->ion_auth->activate($id, $code);
            if ($activation) {
                $change = $this->ion_auth->reset_password($identity, $password);
                if ($change) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('welcome', 'refresh');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    $data['id'] = $id;
                    $data['code'] = $code;
                    $data['identity'] = $identity;
                    $this->load->view('pages/users/activeuser', $data);
                }
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $data['id'] = $id;
                $data['code'] = $code;
                $data['identity'] = $identity;
                $this->load->view('pages/users/activeuser', $data);
            }
        } else {
            $data['id'] = $id;
            $data['code'] = $code;
            $data['identity'] = $identity;
            $this->load->view('pages/users/activeuser', $data);
        }
    }
}