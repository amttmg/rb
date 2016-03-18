<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        checkSession();
        if (isset($_POST['submit'])) {
            $this->load->model('mlogin');
            $remember=1;
            $result = $this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember);
            if (!$result) {
                $this->ion_auth->increase_login_attempts($this->input->post('username'));
                $msg['msg']="Username or password is incorrect";
                $this->load->view('template/login', $msg);
            } else {
                redirect('home');
            }
        } else {
            $this->load->view('template/login');
        }
    }
    public function logout()
    {
        $logout = $this->ion_auth->logout();
        redirect('welcome', 'refresh');
    }
}
