<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tips extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model("Tip_model", "tips");
    }

    public function index() {
        $tips = $this->tips->all();

        header("Content-type: application/json");
        echo json_encode( array('data' => $tips));
        exit();
    }
}
