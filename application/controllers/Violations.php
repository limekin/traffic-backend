<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Violations extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Load all the models we need to work with.
        $this->load->model("Violation_model", "violations");
        $this->load->model("Rto_contact_model", "contacts");

    }

    /**
     * Tracks the violation.
     * Also send mail to the rto contacts in the databse.
     */
    public function track() {
        $violation_id = $this->input->get('id');
        $this->violations->track($violation_id);
        $violation = $this->violations->get_by_id( $violation_id );
        $this->send_violation($violation);

        redirect( site_url("home/violations"));
    }

    // Partially tracks the violation.
    public function partially_track() {
        $violation_id = $this->input->get('id');
        $this->violations->partially_track($violation_id);

        redirect( site_url("home/violations"));
    }

    // Discards the violation witht he given id.
    public function discard() {
        $violation_id = $this->input->get('id');
        $this->violations->discard($violation_id);

        redirect( site_url("home/violations"));
    }


    // Send the mail to the rto.
    private function send_violation($violation) {
        // Fetch the contacts, to whom we have to the send the mail.
        $contacts = $this->contacts->all();

        // Now for each of the contact send the violation.
        foreach($contacts as $contact) {
            $this->send_mail($contact->email, $violation);
        }
    }

    // This one actually sends the mail.
    private function send_mail($to_email, $violation) {
        // Mail server configuration.
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'kevin.t.jayan@gmail.com', // change it to yours
            'smtp_pass' => 'glowingcrayons12', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        // Now load the library with the given configurtion.
        $this->load->library('email', $config);

        // Set the mail fields.
        $this->email->set_newline("\r\n");
        $this->email->from('kevin.t.jayan@gmail.com'); // change it to yours
        $this->email->to($to_email);// change it to yours
        $this->email->subject('Violation Report');

        // Set the message.
        $message = $this->build_message($violation);
        $this->email->message($message);
        $this->email->attach($violation->image_path);
        if($this->email->send()) {
            redirect( site_url("home/violations") );
        } else {
            show_error($this->email->print_debugger());
        }

    }

    // Builds a proper message to be sent in a mail.
    private function build_message($violation) {
        $to_return = "";
        $to_return .= "PLATE NO: " . $violation->vehicle_plate_no . "\n" ;
        $to_return .= "TYPE: " . $violation->violation_type . "\n";
        $to_return .= "DESCRIPTION:" . $violation->description . "\n";

        return $to_return;
    }
}
