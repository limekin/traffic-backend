<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->db->select('users.*, count(violations.id) as violations_reported');
        $this->db->from('users');
        $this->db->join("violations", "users.id=violations.user_id", "left outer");
        $this->db->group_by("users.id");
        $this->db->order_by("violations_reported", "DESC");
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data) {
        $okay = $this->db->insert('users', $data);
        if(! $okay)
            showjson_error($this->db->error()["message"]);
    }

    // Gets the count of all the users in the databaas.e
    public function count() {
        $this->db->select("count(id) as user_count");
        $this->db->from("users");
        $query = $this->db->get();

        $result = $query->row();
        return $result->user_count;
    }

    // Gets the user record by his/her username and password.
    public function get_by_cred($username, $password, $type="normal") {
        $this->db->select('*');
        $this->db->from('auth');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('user_type', $type);
	    $query = $this->db->get();

	    return $query->num_rows() == 0 ? null : $query->row();
    }

    // Saves the user token in the database.
    public function store_user_token($username, $token) {
        $data = array(
            'auth_token' => $token
        );
        $this->db->where('username', $username);
        $this->db->update('auth', $data);
    }

    // Gets the user record by his token.
    public function get_by_token($token) {
        error_log("Token : " . $token, 4);
        $select_query = "auth.username, auth.password, users.*";
        $this->db->select($select_query);
        $this->db->from("auth");
        $this->db->join("users", "auth.id=users.auth_id");
        $this->db->where("auth.auth_token", $token);
        $query = $this->db->get();
        error_log( print_r($query, true), 4);

        return $query->num_rows() == 0 ? null : $query->row();
    }

    // Gets the violatin count for the user with the given id.
    public function get_violation_count($user_id) {
        $this->db->select("count(id) as violation_count");
        $this->db->from("violations");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        $result = $query->num_rows() == 0 ? null : $query->row();
        return $result ? $result->violation_count : 0;
    }


}
