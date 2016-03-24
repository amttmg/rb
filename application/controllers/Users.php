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
            } else {
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

    function setPassword($identity, $id, $code)
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

    // activate the user
    function activate($id = '')
    {
        if ($id == '') {
            show_404();
        } else {
            $activation = $this->ion_auth->activate($id);
            if ($activation) {
                // redirect them to the auth page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("users", 'refresh');
            } else {
                // redirect them to the forgot password page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("users", 'refresh');
            }
        }
    }

    // deactivate the user
    function deactivate($id = '')
    {
        if ($id == '') {
            show_404();
        } else {
            $deactive = $this->ion_auth->deactivate($id);
            if ($deactive) {
                // redirect them to the auth page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("users", 'refresh');
            } else {
                // redirect them to the forgot password page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("users", 'refresh');
            }
        }
    }

    function resetuser($id=""){
        //run the forgotten password method to email an activation code to the user
        if($id==""){
            show_404();
        }
        $user = ($this->users->getUserByID($id));
        $forgotten = $this->ion_auth->forgotten_password($user->username);
        if ($forgotten) { //if there were no errors
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("users", 'refresh'); //we should display a confirmation page here instead of the login page
        }
        else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("users", 'refresh');
        }
    }

    function resetusercomplete($code=Null){
        if (!$code)
        {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user)
        {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false)
            {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id'   => 'new',
                    'type' => 'password',
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name'    => 'new_confirm',
                    'id'      => 'new_confirm',
                    'type'    => 'password',
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['user_id'] = array(
                    'name'  => 'user_id',
                    'id'    => 'user_id',
                    'type'  => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->_render_page('auth/reset_password', $this->data);
            }
            else
            {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
                {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                }
                else
                {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change)
                    {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        }
        else
        {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }

    }

}