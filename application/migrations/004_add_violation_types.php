<?php

defined('BASEPATH') OR exit('No direct script access is allowed.');

class Migration_Add_Violation_types extends CI_Migration {
    public function up() {
        $this->dbforge->add_field( array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'TEXT'
            ),
            'description' => array(
                'type' => 'TEXT'
            ),
            'level' => array(
                'type' => 'TEXT'
            )
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('violation_types');
    }

    public function down() {
        $this->dbforge->drop_table('violation_types');
    }
}
