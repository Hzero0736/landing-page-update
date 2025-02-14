<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik' => '23000707',
                'password' => 'P@ssw0rd2025',
                'name' => 'Irene',
                'role' => 'superadmin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nik' => '09000122',
                'password' => 'T@rjun123',
                'name' => 'Santo',
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
