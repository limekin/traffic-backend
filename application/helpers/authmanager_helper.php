<?php
	class AuthManager {
		public function __construct() {
			// Initial things goes in here.
			$this->instance = & get_instance();
			$this->instance->load->model('User_model', 'user');

		}

		public function store_user_token($username, $token) {
			$this->instance->user->store_user_token($username, $token);
		}

		public function get_request_user() {
				if($this->instance->input->server('REQUEST_METHOD') == "POST")
					return $this->verify_token(
						$this->instance->input->raw_input_stream
					);
				else
					return $this->verify_from_param(
						$this->instance->input->get('token')
				);
		}
		public function verify_token($request_data) {
			$json_data = to_json($request_data);

			// If the request data is not valid.
			if($json_data == NULL)
				$this->reject_bad_request();
			// If the request data doesn't have data field.
			if( !property_exists($json_data, "data"))
			 	$this->reject_bad_request();
			// if the request data doesn't have a token field.
			if( !property_exists($json_data->data, "token"))
				$this->reject_noauth_request();

			// The json data is valid and there is a token sent with
			// the request. Now we have to check if it's a valid token.
			$user = $this->instance->user->get_by_token(
				$json_data->data->token
			);
			if($user == NULL)
				$this->reject_noauth_request();

			return $user;
		}

		public function verify_from_param($token) {
			error_log($token, 4);
			$user = $this->instance->user->get_by_token($token);
			if($user == NULL)
				$this->reject_noauth_request();
			return $user;
		}

		// Rejects the current request. With an error message.
		public function reject_noauth_request() {
			$response = array(
				"error" => "You are not authorized to access this api."
			);
			header("Content-type: application/json");
			http_response_code(403);
			echo json_encode($response);
			exit();
		}

		// Rejects the request with bad request response.
		public function reject_bad_request() {

			$response = array(
				"error" => "The json data in the request was not valid."
			);
			header("Content-type: application/json");
			http_response_code(400);
			echo json_encode($response);
			exit();
		}
	}
?>
