<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tip_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->db->select('*');
        $this->db->from('traffic_tips');
        $query = $this->db->get();

        return $query->result();
    }
}
