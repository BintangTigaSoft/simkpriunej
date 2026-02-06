<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\CLI\CLI;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('auth_groups');
        
        // Define roles (groups)
        $roles = [
            [
                'name'        => 'admin',
                'description' => 'Super Administrator',
            ],
            [
                'name'        => 'user',
                'description' => 'Regular User',
            ],
        ];

        foreach ($roles as $role) {
            // Check if role exists (Manual 'firstOrCreate' logic with Query Builder)
            $existingRole = $builder->where('name', $role['name'])->get()->getRow();
            
            if (!$existingRole) {
                $builder->insert($role);
                CLI::write("Role '{$role['name']}' created.", 'green');
            } else {
                CLI::write("Role '{$role['name']}' already exists.", 'yellow');
            }
        }
    }
}
