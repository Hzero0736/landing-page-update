<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Meeting Project A',
                'date' => '2024-01-10',
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'room_id' => '1',
                'description' => 'Diskusi Project A',
                'nama_penyelenggara' => 'John Doe',
                'status' => 'approved',
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Meeting Project B',
                'date' => '2024-01-11',
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'room_id' => '2',
                'description' => 'Review Project B',
                'nama_penyelenggara' => 'Jane Smith',
                'status' => 'pending',
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('meetings')->insertBatch($data);
    }
}
