<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth/login'); 
        }
    }

    public function index() {
        $this->load->view('pelanggan/header');
        $this->load->view('dashboard/sidebar');
        $this->load->view('pelanggan/customer');
        $this->load->view('pelanggan/footer');
        
    }
}
