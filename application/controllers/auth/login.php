<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* The Home class in PHP CodeIgniter framework loads the 'home' view in its index method. */
class Login extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library(['session', 'form_validation']);

        
    }

    public function index() {
        $this->load->view('auth/auth-login');
    }

    public function login_action() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/auth-login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->Auth_model->get_user_by_username($username);

        if (!$user) {
            $this->session->set_flashdata('success', 'Username tidak ditemukan.');
            redirect('auth/login');
            return;
        }

        if (!password_verify($password, $user->password)) {
            $this->session->set_flashdata('success', 'Password salah.');
            redirect('auth/login');
            return;
        }

        $session_data = [
            'user_id'   => $user->id,
            'username'  => $user->username,
            'logged_in' => TRUE
        ];
        $this->session->set_userdata($session_data);

        redirect('dashboard'); 
    }
    

    public function logout()
    {
        if ($this->session->userdata('username')) {
      
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('role');
        }
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
