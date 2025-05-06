<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function register($data) {
        return $this->db->insert('users', $data);
    }

    public function is_username_taken($username) {
        return $this->db->where('username', $username)
                        ->get('users')
                        ->num_rows() > 0;
    }

    public function is_email_taken($email) {
        return $this->db->where('email', $email)
                        ->get('users')
                        ->num_rows() > 0;
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
    
    public function validate_login($username, $password) {
        $user = $this->get_user_by_username($username);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
