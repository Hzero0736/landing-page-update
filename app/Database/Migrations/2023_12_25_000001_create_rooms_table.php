<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomsTable extends Migration
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
            'room_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'capacity' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'facilities' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['available', 'maintenance'],
                'default' => 'available'
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
        $this->forge->createTable('rooms');
    }

    public function down()
    {
        $this->forge->dropTable('rooms');
    }
}
