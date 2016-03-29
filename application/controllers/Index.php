<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // We don't want the header and footer.
        //load_view("index/index", null, $this);

        $this->load->view("index/index");

    }
}
