<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Violation_model extends CI_Model {

    // Constructor.
    public function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->db->select("*");
        $this->db->from("violations");
        $this->db->order_by("reported_date", "DESC");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_new() {
        $this->db->select("*");
        $this->db->from("violations");
        $this->db->where("status", "pending");
        $this->db->order_by("reported_date", "DESC");
        $query = $this->db->get();

        return $query->result();
    }

    // Gets ta violation by a single id.
    public function get_by_id($id) {
        $this->db->select('*');
        $this->db->from("violations");
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->row();
    }

    public function new_count() {
        $this->db->select("count(id) as violation_count");
        $this->db->from("violations");
        $this->db->where("status", "pending");
        $query = $this->db->get();
        $result = $query->row();

        return $result->violation_count;
    }

    // Marks the violation as tracked.
    public function track($id) {
        $data = array(
            "status" => "tracked"
        );
        $this->db->where("id", $id);
        $this->db->update("violations", $data);
    }

    // Marks the violation as tracked.
    public function partially_track($id) {
        $data = array(
            "status" => "partially_tracked"
        );
        $this->db->where("id", $id);
        $this->db->update("violations", $data);
    }

    // Marks the violation as discarded.
    public function discard($id) {
        $data = array(
            "status" => "discarded"
        );
        $this->db->where("id", $id);
        $this->db->update("violations", $data);
    }

    // Gets the list of all reported violations along with their,
    // report count.
    public function get_type_stat() {
        $this->db->select('violation_type, count(id) as report_count');
        $this->db->from('violations');
        $this->db->group_by('violation_type');

        $query = $this->db->get();
        return $query->result();
    }
    public function insert($data) {
        $okay = $this->db->insert('violations', $data);
        if(! $okay) {
            echo"asdsd";
            exit();
        }
        showjson_error($this->db->error()["message"]);
    }

    public function get_by_user_id($user_id) {
        $this->db->select("*");
        $this->db->from("violations");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();

        return $query->result();
    }

    // Gets the first count violations from the table.
    public function get_recent($count) {
        $this->db->select('*');
        $this->db->from('violations');
        $this->db->limit($count);
        $query = $this->db->get();

        return $query->result();
    }

    public function delete($violation_id) {
        $this->db->delete("violations", array("id" => $violation_id));
    }

    public function delete_by_user_id($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('violations');
    }
}
