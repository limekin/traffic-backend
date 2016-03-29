<?php

defined('BASEPATH') OR exit('No direct script access is allowed.');

class Migration_Add_Auth extends CI_Migration {
    public function up() {
        $this->dbforge->add_field( array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'TEXT'
            ),
            'password' => array(
                'type' => 'TEXT'
            ),
            'auth_token' => array(
                'type' => 'TEXT'
            ),
            'user_type' => array(
                'type' => 'TEXT'
            )
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('auth');
    }

    public function down() {
        $this->dbforge->drop_table('auth');
    }
}
