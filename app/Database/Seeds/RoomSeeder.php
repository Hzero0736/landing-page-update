<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'CPO',
                'description' => 'Ruang Meeting'
            ],
            [
                'name' => 'Kuncimas',
                'description' => 'Ruang Meeting'
            ],
            [
                'name' => 'Filma',
                'description' => 'Ruang Meeting'
            ],
            [
                'name' => 'Training',
                'description' => 'Ruang Meeting'
            ]
        ];
        $this->db->table('meeting_rooms')->insertBatch($data);
    }
}
