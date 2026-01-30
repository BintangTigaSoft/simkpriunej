<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Truncate table first to prevent duplicates and ensure clean state
        $this->db->table('menu_modul')->truncate();

        $data = [
            [
                'key'         => '1_dashboard',
                'parent'      => null,
                'kode_modul'  => 'dashboard',
                'kode_key'    => 1,
                'nama_modul'  => 'Dashboard',
                'kode_grup'   => 'dashboard',
                'nama_grup'   => 'Dashboard',
                'nama_url'    => 'dashboard',
                'level1'      => true,
                'level2'      => true,
                'level3'      => true, 
                'level4'      => true,
                'level5'      => true,
                'level6'      => true,
                'level7'      => true,
                'level8'      => true,
                'level9'      => true,
                'textlevel'   => 'All',
                'icon'        => 'feather-airplay',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'key'         => '9_',
                'parent'      => null,
                'kode_modul'  => '9',
                'kode_key'    => 0,
                'nama_modul'  => 'Konfigurasi',
                'kode_grup'   => '9', // Assuming group code
                'nama_grup'   => 'Konfigurasi',
                'nama_url'    => '#',
                'level1'      => false,
                'level2'      => false,
                'level3'      => false,
                'level4'      => false,
                'level5'      => false,
                'level6'      => false,
                'level7'      => false,
                'level8'      => true,
                'level9'      => true,
                'textlevel'   => '89',
                'icon'        => 'feather-settings',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'key'         => '9_1',
                'parent'      => '9_',
                'kode_modul'  => '9.01',
                'kode_key'    => '9',
                'nama_modul'  => 'Modul',
                'kode_grup'   => '9_1',
                'nama_grup'   => 'Modul',
                'nama_url'    => 'konfigurasi/modul',
                'level1'      => false,
                'level2'      => false,
                'level3'      => false,
                'level4'      => false,
                'level5'      => false,
                'level6'      => false,
                'level7'      => false,
                'level8'      => true,
                'level9'      => true,
                'textlevel'   => '89',
                'icon'        => 'feather-circle',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'key'         => '9_2',
                'parent'      => '9_',
                'kode_modul'  => '9.02',
                'kode_key'    => '9',
                'nama_modul'  => 'Menu',
                'kode_grup'   => '9',
                'nama_grup'   => 'Menu',
                'nama_url'    => 'konfigurasi/menu',
                'level1'      => false,
                'level2'      => false,
                'level3'      => false,
                'level4'      => false,
                'level5'      => false,
                'level6'      => false,
                'level7'      => false,
                'level8'      => true,
                'level9'      => true,
                'textlevel'   => '89',
                'icon'        => 'feather-circle',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('menu_modul')->insertBatch($data);
    }
}
