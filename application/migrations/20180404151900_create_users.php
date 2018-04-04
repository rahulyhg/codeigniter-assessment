<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ),
            'remember_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
                'default' => NULL,
            ),
            'created' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'updated' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'deleted' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => NULL,
            ),
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('users', true);
    }
    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}