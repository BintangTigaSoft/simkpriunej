<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $validationRules = [
        'nama'     => 'required',
        'password' => 'required'
    ];

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('pages/auth/login');
    }

    public function attempt()
    {
        if (!$this->validate($this->validationRules)) {
            return redirect()->back()->withInput();
        }

        $nama     = $this->request->getPost('nama');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->verifyUser($nama, $password);

        if ($user) {
            // Prevent Session Fixation
            session()->regenerate();
            
            session()->set([
                'id'         => $user->id,
                'nama'       => $user->nama,
                'jabatan'    => $user->jabatan,
                'level'      => $user->level,
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
