<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        checkSession();
        if (isset($_POST['submit'])) {
            $this->load->model('mlogin');
            $result = $this->mlogin->validate();
            if (!$result) {
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
        $this->session->sess_destroy();
        redirect('welcome', 'refresh');
    }
}
