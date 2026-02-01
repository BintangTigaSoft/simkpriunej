<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use App\Models\UserModel;
use CodeIgniter\CLI\CLI;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $db = \Config\Database::connect();
        
        // 1. Define the admin user data
        $adminData = [
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => 'password123',
            'active'   => 1,
        ];

        // 2. Check if user exists ("firstOrCreate" logic)
        $user = $userModel->where('email', $adminData['email'])->first();

        if (!$user) {
            // Create user entity
            $user = new User($adminData);
            
            // Save user
            $userModel->save($user);
            
            // Get the inserted user to get the ID
            $user = $userModel->where('email', $adminData['email'])->first();
            
            CLI::write("User 'admin' created.", 'green');
        } else {
            CLI::write("User 'admin' already exists.", 'yellow');
        }

        // 3. Assign 'admin' role to this user
        // Using direct Query Builder to avoid Model issues and ensure direct assignment
        $group = $db->table('auth_groups')->where('name', 'admin')->get()->getRow();
        
        if ($group) {
            // Check if user already has this group
            $userInGroup = $db->table('auth_groups_users')
                              ->where('group_id', $group->id)
                              ->where('user_id', $user->id)
                              ->get()->getRow();

            if (!$userInGroup) {
                $db->table('auth_groups_users')->insert([
                    'group_id' => $group->id,
                    'user_id'  => $user->id,
                ]);
                CLI::write("User assigned to 'admin' role.", 'green');
            } else {
                 CLI::write("User is already in 'admin' role.", 'yellow');
            }
        } else {
            CLI::write("Role 'admin' not found. Please run RoleSeeder first.", 'red');
        }
    }
}
