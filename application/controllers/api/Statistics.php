<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Statistic_model", "stats");
    }

    public function index() {
        $result = $this->stats->get_overall_stat();
        $response = array();
        $response['data'] = $result;

        header("Content-type: application/json");
        echo json_encode($response);
        exit();
    }
}
