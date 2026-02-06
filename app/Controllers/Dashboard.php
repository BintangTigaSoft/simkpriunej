<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        // Helper untuk session
        helper('session');

        // Check login
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth');
        }
    }

    public function index()
    {
        // Data dari session CI4
        $session = session();

        $user = [
            'nama_lengkap' => $session->get('nama_lengkap') ?? 'User',
            'nmrole' => $session->get('nmrole') ?? 'Pengguna',
            'nmfakultas' => $session->get('nmfakultas') ?? 'Fakultas',
            'email' => $session->get('email') ?? '',
            'username' => $session->get('username') ?? '',
            'login_method' => $session->get('login_method') ?? 'sso',
            'role_id' => $session->get('role_id') ?? 2,
            'image' => $session->get('image') ?? 'default.png',
        ];



        $data = [
            'title' => 'SimKPRI Unej',
            'user' => $user,
            'base_url' => base_url(),
            'login_time' => $session->get('login_time') ?? time()
        ];

        // Gunakan CI4 View System
        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('templates/footer', $data);
    }
}
