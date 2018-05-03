<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_email_confirmations extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'expired' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'created' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)');
        $this->dbforge->create_table('email_confirmations', true);
    }
    public function down()
    {
        $this->dbforge->drop_table('email_confirmations');
    }
}