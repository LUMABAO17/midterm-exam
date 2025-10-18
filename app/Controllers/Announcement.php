<?php

namespace App\Controllers;

use Config\Database;

class Announcement extends BaseController
{
    public function index()
    {
        $db = Database::connect();
        $announcements = [];

        try {
            if ($db->tableExists('announcements')) {
                $query = $db->table('announcements')->get();
                $announcements = $query->getResultArray();
            }
        } catch (\Throwable $e) {
            $announcements = [];
        }

        return view('announcements', [
            'announcements' => $announcements,
        ]);
    }
}
