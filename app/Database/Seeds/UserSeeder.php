<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $data = [
            'nama'     => 'admin',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'jabatan'  => 'Administrator',
            'level'    => 9,
        ];

        // Using save method from Model
        $userModel->save($data);
    }
}
