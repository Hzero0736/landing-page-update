<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $this->db->table('meetings')->insertBatch($data);
    }
}
