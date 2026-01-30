<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIconToMenuModul extends Migration
{
    public function up()
    {
        $this->forge->addColumn('menu_modul', [
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'feather-circle', // Default icon
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('menu_modul', 'icon');
    }
}
