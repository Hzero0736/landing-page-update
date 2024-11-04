<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMeetingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'start_time' => [
                'type' => 'DATETIME'
            ],
            'end_time' => [
                'type' => 'DATETIME'
            ],
            'room' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'user' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('meetings');
    }

    public function down()
    {
        $this->forge->dropTable('meetings');
    }
}
