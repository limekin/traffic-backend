<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rto_contact_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->db->select('*');
        $this->db->from('rto_contacts');
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data) {
        $this->db->insert("rto_contacts", $data);
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('rto_contacts');
    }
}
