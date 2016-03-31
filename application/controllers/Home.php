<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // If the user isn't not logged into the applicaton,
        // redirect him to the login page.
        if(! isset($_SESSION['user_id']))
            redirect("/");

        $this->load->model("User_model", "users");
        $this->load->model("Statistic_model", "stats");
        $this->load->model("Violation_model", "violations");
        $this->load->model("Violation_type_model", "violation_types");
        $this->load->model("Rto_contact_model", "contacts");
    }

    public function index() {
        $data = array(
            "violations_count" =>  $this->violations->new_count(),
            "user_count" => $this->users->count(),
            "recent_violations" => $this->violations->get_recent(4),
            "type_stat" => $this->violations->get_type_stat(),
            "_page" => "home"
        );
        load_view("home/index", $data, $this);
    }

    // Shows the list of all the users in the appication.
    public function users() {
        $users = $this->users->all();
        $locals = array(
            'users' => $users,
            '_page' => "users"
        );

        load_view("home/users", $locals, $this);
    }

    // Removes the user form the table. Also remove the violations of
    // the user.
    public function remove_user($id) {
        $this->users->remove($id);
        $this->violations->delete_by_user_id($id);

        redirect( site_url("home/users") );
    }

    // Shows the list of the statistics in the page.
    public function statistics() {
        $stats = $this->stats->get_overall_stat();
        // Now for each of the reports get the reports grouped
        // by their types.
        $stats = $this->stats->attach_type_stat($stats);

        $locals = array(
            "stats" => $stats,
            "_page" => "statistics"
        );

        load_view("home/statistics", $locals, $this);
    }

    // Shows the list of all the rto contacts in the database.
    public function rto_contacts() {
        $contacts = $this->rto_contacts->all();
        $locals = array(
            'contacts' => $contacts,
            '_page' => "contacts"
        );

        load_view("home/contacts", $locals, $this);
    }

    // Shows the list of all the rto contacts in the database.
    public function contacts() {
        $contacts = $this->contacts->all();
        $locals = array(
            'contacts' => $contacts,
            '_page' => "contacts"
        );

        load_view("home/contacts", $locals, $this);
    }

    // Shows the page to add the contact ot the database.
    public function add_contact() {

        if($this->input->server("REQUEST_METHOD") == 'POST')
            $this->add_contact_post();
        $locals = array(
            '_page' => "add_contact"
        );
        load_view("home/add_contact", $locals, $this);
    }

    public function add_contact_post() {
        $data = array(
            'name' => $this->input->post('name'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email')
        );

        $this->contacts->insert($data);
        echo "<script>alert('Contact added.');</script>";
    }

    public function remove_contact($id) {
        $this->contacts->remove($id);

        redirect( site_url("home/contacts"));
    }

    // Shows the list of all the violation in the iste.
    public function violations() {
        $violations = $this->violations->all();
        $locals = array(
            'violations' => $violations,
            '_page' => "violations"
        );

        load_view("home/violations", $locals, $this);
    }

    // Shows the about us page of the site..
    public function about_us() {
        load_view("home/about_us", null, $this);
    }

    // SHows the list of all the violation types.
    public function violation_types() {

        // Check if it's a post request.
        if($this->input->server("REQUEST_METHOD") == "POST")
            $this->post_violation_types();

        $violation_types = $this->violation_types->all();
        $data = array(
            "violation_types" => $violation_types
        );

        load_view("home/violation_types", $data, $this);
    }

    public function post_violation_types() {
        $data = array(
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "level" => $this->input->post("level")
        );

        $this->violation_types->insert($data);
    }

    // Adds a new rto to the database.
    public function new_rto() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile')
        );

        $this->rto_contacts->insert($data);
        redirect( site_url("home/rto_contacts"));
    }

}
