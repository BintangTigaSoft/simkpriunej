<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $row = $db->query('SELECT now()')->getRow();

            return '✅ DB CONNECTED: ' . $row->now;
        } catch (\Throwable $e) {
            return '❌ DB ERROR: ' . $e->getMessage();
        }
    }
}
