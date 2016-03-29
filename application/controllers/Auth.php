<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Auth_model", "auth");
        $this->load->model("User_model", "users");
    }

    // Handles the POST request for authentication.
    public function login() {
        if($this->input->server("REQUEST_METHOD") != "POST") {
            redirect(base_url());
            exit();
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->users->get_by_cred($username, $password, "admin");
        error_log( print_r($user, true), 4);

        if($user == NULL) {
            redirect( base_url());
            exit();
        }

        // The user is valid then store his id in the session.
        $this->session->user_id = $user->id;
        redirect( base_url("index.php/home"));
    }

    // Handles the logout of the user from the application.
    public function logout() {
        unset( $_SESSION['user_id']);

        redirect("/");
    }
}
