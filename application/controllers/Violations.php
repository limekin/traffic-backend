<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Violations extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Load all the models we need to work with.
        $this->load->model("Violation_model", "violations");

    }

    // Tracks the violation.
    public function track() {
        $violation_id = $this->input->get('id');
        $this->violations->track($violation_id);

        redirect( site_url("home/violations"));
    }

    // Partially tracks the violation.
    public function partially_track() {
        $violation_id = $this->input->get('id');
        $this->violations->partially_track($violation_id);

        redirect( site_url("home/violations"));
    }

    // Discards the violation witht he given id.
    public function discard() {
        $violation_id = $this->input->get('id');
        $this->violations->discard($violation_id);

        redirect( site_url("home/violations"));
    }
}
