<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model'); 
        $this->load->library('form_validation'); 
        $this->load->library('session'); 
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $this->load->view('auth/auth-registrasi');
    }

    public function register_action() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'email' => $this->input->post('email', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT)
                ];

                $this->Auth_model->register($data);
                $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/auth-registrasi'); 
    }
}
