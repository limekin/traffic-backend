<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
  public function __construct() {
    parent::__construct();  
  }

  public function insert($data) {
    // Insert the data into the database.
    $this->db->insert('auth', $data);

    // Now get the last insert id.
    return $this->db->insert_id();
  }
}
