<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'username'      => 'admin1',
                'password_hash' => password_hash('adminpass', PASSWORD_DEFAULT),
                'role'          => 'admin',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'username'      => 'teacher1',
                'password_hash' => password_hash('teacherpass', PASSWORD_DEFAULT),
                'role'          => 'teacher',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'username'      => 'student1',
                'password_hash' => password_hash('studentpass', PASSWORD_DEFAULT),
                'role'          => 'student',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
