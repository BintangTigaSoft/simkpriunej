<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuModul extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => true,
            ],
            'parent' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => true,
            ],
            'kode_modul' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'kode_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => true,
            ],
            'nama_modul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'kode_grup' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'nama_grup' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'nama_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '#',
            ],
            'level1' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level2' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level3' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level4' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level5' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level6' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level7' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level8' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'level9' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'textlevel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menu_modul');
    }

    public function down()
    {
        $this->forge->dropTable('menu_modul');
    }
}
