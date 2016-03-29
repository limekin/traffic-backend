<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

    	// Load User_model and reference it as just 'users'.
    	// Load Auth_model.
        $this->load->model('User_model', 'users');
    	$this->load->model('Auth_model', 'auth');
    }

    /**
     * /users
     * @returns : List of user resources.
     */
    public function index() {

        // Check if it's a post request.
        // Call register function to handle it.
        if( $this->input->server('REQUEST_METHOD') == "POST") {
            $this->register();
            return;
        }

        $response = '{ "data": [';
        $users =  $this->users->all();
        $json_users = array();

        // Now for each of the user record convert it into the
        // json format.
        foreach($users as $user) {
            $json_users[] = json_encode($user);
        }

        // Now combine the json users into one and return them.
        $response .= implode(',', $json_users) . ']}';
	    header('Content-type: application/json');
	    echo $response;
	    exit();
    }

    // Registers a new user to the application.
    private function register() {

        // Convert the response data to json format.
        $user_data = to_json( $this->input->raw_input_stream );
    	// First add the auth data (username, password) to
        //  auth table.
        $data = array();
    	$data['name'] = $user_data->data->attributes->name;
    	$data['username'] = $user_data->data->attributes->username;
    	$data['email'] = $user_data->data->attributes->email;
    	$data['password'] = $user_data->data->attributes->password;

    	$auth_data = array(
    	  'username' => $data['username'],
    	  'password' => $data['password'],
    	  'user_type' => 'normal'
    	);

    	// To insert into the users table along witrh other details.
        $auth_id = $this->auth->insert($auth_data);

    	// Now add the other details into the user table.
    	$user_data = array(
    	  'name' => $data['name'],
    	  'email' => $data['email'],
    	  'auth_id' => $auth_id
    	);

    	$this->users->insert($user_data);
        $this->output->set_status_header(201);
        echo "Okay";


    }

    // API : /users/current
    // Returns the details of the user whose token is sent with
    // the request.
    public function current() {
        $auth = new AuthManager();
        $current_user = $auth->get_request_user();

        // Get the number of violations reports by the user.
        $current_user->violation_count =
            $this->users->get_violation_count($current_user->id);
        $response = array();
        $response['data'] = $current_user;

        header('Content-type: application/json');
        echo json_encode($response);
        exit();
    }
}
