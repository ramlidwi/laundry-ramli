<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Cek apakah session user ada, jika tidak arahkan ke halaman login
        if (!$this->session->userdata('username')) {
            redirect('auth/login'); // Ganti 'auth/login' dengan path login sesuai project
        }
    }

    public function index() {
        // Setelah login baru bisa mengakses dashboard
        $this->load->view('dashboard/dashboard-admin');
    }
}
