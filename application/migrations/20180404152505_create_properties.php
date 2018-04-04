<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_properties extends CI_Migration
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
            ),
            'price' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'price_text' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)');
        $this->dbforge->create_table('properties', true);
    }
    public function down()
    {
        $this->dbforge->drop_table('properties');
    }
}