<?php

defined('BASEPATH') OR exit('No direct script access is allowed.');

class Migration_Add_Users extends CI_Migration {
    public function up() {
        $this->dbforge->add_field( array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'auth_id' => array(
                'type' => 'INT'
            ),
            'name' => array(
                'type' => 'TEXT'
            ),
            'email' => array(
                'type' => 'TEXT'
            )
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }
}
