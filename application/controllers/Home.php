<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* The Home class in PHP CodeIgniter framework loads the 'home' view in its index method. */
class Home extends CI_Controller {

    public function index() {
        $this->load->view('home');
    }
}
