<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = User::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'password', 'jabatan', 'level'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules for Data Entry (Register/Update)
    protected $validationRules      = [
        'nama'     => 'required|min_length[3]|max_length[255]',
        'password' => 'required',
        'jabatan'  => 'required',
        'level'    => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Verifikasi kredensial user
     * 
     * @param string $username
     * @param string $password
     * @return User|false
     */
    public function verifyUser(string $username, string $password)
    {
        $user = $this->where('nama', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }
}
