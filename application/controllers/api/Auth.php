<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
      parent::__construct();
      // Load the user model. Reference it under the name users.
      $this->load->model('User_model', 'users');
      $this->auth = new AuthManager();
    }


    // API Path : /auth/login
    // Description : Takes in username and password parameters
    //		     and authenticates the user if he is valid.
    //		     Also returns a hash (token) to the user,
    //		     the user can keep that token and use it for
    //		     subsequent requests to show that he is
    //		     previously authenticated.
    //		     The user should keep the token stroed in the
    //		     device somehow.
    //
    public function login() {

        // Get the json data from the request.
        $user_data = to_json( $this->input->raw_input_stream);

        $username = $user_data->data->auth->username;
    	$password = $user_data->data->auth->password;
    	$user = $this->users->get_by_cred($username, $password);

    	// Check if user is null, which means the creds are wrong.
    	if($user == null) {
    	  $error = '{ "error" : "The username or password is icorrect." }';
    	  header('Content-type: application/json');
    	  echo $error;
    	  exit();
    	}

    	// Now the creds aren't wrong, so generate a hash and send it back to the
    	// user to store there as a replacement for session.
    	$token = hash('md5', $username . $password);
        $this->auth->store_user_token($username, $token);
    	$response = array();
    	$response['data'] = array( 'token' => $token, 'user_id' => $user->id);
    	header('Content-type: application/json');
    	echo json_encode($response);
    }
}
