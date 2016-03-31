<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Takes in a violation and updates the statistic information.
    public function get_overall_stat() {
        $to_return = array();
        $this->db->select("count(id) as violation_count, location");
        $this->db->from("violations");
        $this->db->group_by("location");
        $this->db->order_by("violation_count", "DESC");
        $query = $this->db->get();

        $result = $query->result();
        // Now for each of the result find the violation type for which
        // there are most number of violations.
        foreach($result as $violation) {
            $violation_stat = $this
                ->get_max_violation_type($violation->location);
            $violation->max_type = $violation_stat->violation_type;
        }

        return $result;
    }

    // Gets the most number of violations for a particular location.
    public function get_max_violation_type($location) {
        $this->db->select("count(id) AS type_count, violation_type, location");
        $this->db->from("violations");
        $this->db->group_by("violation_type, location");
        $this->db->where("location", $location);
        $this->db->order_by("type_count","DESC");
        $query = $this->db->get();

        $result = $query->row();
        return $result;
    }

    // Adds type statistics for each of the reports.
    public function attach_type_stat($reports) {
        foreach($reports as $report) {
            $report->type_stats = $this->get_type_stat($report->location);
            error_log(print_r($report, true), 4);
        }

        return $reports;
    }

    // Gets the type stats for the given location.
    public function get_type_stat($location) {
        $this->db->select('violation_type, count(id) as report_count');
        $this->db->from('violations');
        $this->db->group_by('violation_type');
        $this->db->where('location', $location);

        $query = $this->db->get();
        return $query->result();
    }

//SELECT count(id) as type_count, violation_type, location from violations GROUP BY violation_type WHERE location="Nandikkara" ORDER BY type_count DESC

}
