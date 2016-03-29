<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Violations extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $auth = new AuthManager();

        // Load the violation model.
        $this->load->model("Violation_model", "violations");
        // Check if the request is valid, if it's return the user
        // to whom the token belongs to.
        $this->current_user =
            $auth->get_request_user();
            //$auth->verify_token( $this->input->raw_input_stream );
    }


    // Handles requests to /voilations.
    public function index() {
        error_log("adsad", 4);
        // Check if it's a post request.
        // If it's a post request delegate request to index_post,
        // else delegate the request to index_get.
        if( $this->input->server('REQUEST_METHOD') == "POST")
            $this->index_post();
        else
            $this->index_get();
    }

    /**
     * API:
     * POST /violations
     * Description: Adds a new violation under the user idetified,
     *              by the token given in the request.
     */
    private function index_post() {
        // Convert the request data to json.
        $json_request = to_json( $this->input->raw_input_stream );
        $violation = $json_request->data->violation;
        $data = array(
            "location"         => $violation->location,
            "description"      => $violation->description,
            "vehicle_plate_no" => $violation->vehicle_plate_no,
            "violation_type"   => $violation->violation_type,
            "user_id"          => $this->current_user->id
        );

        // To store the image files given with the request.
        $timestamp = time();
        $image_name = $timestamp . ".png";
        $image_thumb_name = $timestamp . "_thumb.png";

        // Now make or get the direcotires for the current user.
        $dirManager = new ServiceDirectory( $this->current_user );
        // Bulids all the direcroies requires to store the images.
        $dirManager->build_all();

        // Create the image and get its path back.
        $image_path = $dirManager->create_image(
            $image_name, $violation->image
        );
        //$thumb_path = $dirManager->image_dir . "/" . $image_thumb_name;

        // Now store the paths to the data.
        $data['image_path'] = $image_path;
        $data['thumbnail_path'] = "Placeholder";

        // Now add the violation date.
        $current_date = date("Y/m/d");
        error_log($current_date, 4);
        $data['reported_date'] = $current_date;
        // Insert the violation data to the database.
        $this->violations->insert($data);
    }

    // API /violations
    // Returns all the violations of the current user.
    private function index_get() {
        $dirManager = new ServiceDirectory($this->current_user);
        $dirManager->build_all();
        $violations = $this->violations->get_by_user_id(
            $this->current_user->id
        );
        foreach($violations as $violation) {
            $violation->image_string =
                $dirManager->get_encoded_image($violation->image_path);
        }


        // Now convert the data to json format and send it.
        $json_response = array();
        $json_response["data"] =  $violations;
        header("Content-type: application/json");
        echo json_encode($json_response);
        exit();
    }

    // API /violations/delete [POST]
    // Handles the delete of the violation with the given id.
    public function delete() {
        $json_request = to_json( $this->input->raw_input_stream );
        $id = $json_request->data->id;
        $this->violations->delete($id);

        header("Content-type: application/json");
        echo '{"data": "success"}';
        exit();
    }


}
