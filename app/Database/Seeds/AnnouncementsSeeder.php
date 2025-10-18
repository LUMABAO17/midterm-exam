<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'title'      => 'Welcome to the Portal',
                'content'    => 'This is your new announcements page. Stay tuned for updates!',
                'created_at' => $now,
            ],
            [
                'title'      => 'Maintenance Notice',
                'content'    => 'The system will undergo maintenance on Saturday at 10 PM.',
                'created_at' => $now,
            ],
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
