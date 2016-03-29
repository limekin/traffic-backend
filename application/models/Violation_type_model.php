<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Violation_type_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->db->select("*");
        $this->db->from("violation_types");
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data) {
        $this->db->insert("violation_types", $data);
    }
}
