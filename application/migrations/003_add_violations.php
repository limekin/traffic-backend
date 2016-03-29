<?php

defined('BASEPATH') OR exit('No direct script access is allowed.');

class Migration_Add_Violations extends CI_Migration {
    public function up() {
        $this->dbforge->add_field( array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT'
            ),
            'reported_date' => array(
                'type' => 'DATE'
            ),
            'location' => array(
                'type' => 'TEXT'
            ),
            'description' => array(
                'type' => 'TEXT'
            ),
            'vehicle_plate_no' => array(
                'type' => 'TEXT'
            ),
            'image_path' => array(
                'type' => 'TEXT'
            ),
            'violation_type' => array(
                'type' => 'TEXT'
            ),
            'thumbnail_path' => array(
                'type' => 'TEXT'
            ),
            'status' => array(
                'type' => 'TEXT'
            )
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('violations');
    }

    public function down() {
        $this->dbforge->drop_table('violations');
    }
}
