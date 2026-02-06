<?php

namespace App\Controllers;

class Authentifikasi extends \CodeIgniter\Controller
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
    }

    /**
     * Halaman login utama (default)
     */
    public function index()
    {


        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login Sistem',
            'error' => session()->getFlashdata('error'),
            'success' => session()->getFlashdata('success'),
            'email' => $this->request->getGet('email') // Untuk pre-fill
        ];

        return view('auth/login_form', $data);
    }

    /**
     * Proses login
     */
    public function process()
    {
        // Cek jika bukan POST request
        if (!$this->request->is('post')) {
            // Jika ada email di GET, pre-fill di form
            $email = $this->request->getGet('email');
            return redirect()->to('/auth' . ($email ? '?email=' . urlencode($email) : ''));
        }

        // Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/auth')
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user di database
        $user = $this->db->table('z_ms_user')
            ->select('z_ms_user.*, z_ks_unit.nmfakultas, z_ks_role.nama as nmrole')
            ->join('z_ks_unit', 'z_ms_user.kd_unit = z_ks_unit.kdfakultas', 'left')
            ->join('z_ks_role', 'z_ms_user.role_id = z_ks_role.idtabel', 'left')
            ->where('z_ms_user.email', $email)
            ->where('z_ms_user.is_active', 1)
            ->get()
            ->getRowArray();

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $sessionData = [
                'id_user' => $user['id_user'],
                'nama_lengkap' => $user['nama_lengkap'] ?? 'User',
                'username' => $user['username'] ?? '',
                'email' => $user['email'],
                'nmrole' => $user['nmrole'] ?? 'Pengguna',
                'nmfakultas' => $user['nmfakultas'] ?? '',
                'kd_unit' => $user['kd_unit'] ?? '',
                'role_id' => $user['role_id'] ?? 2,
                'logged_in' => true,
                'login_time' => time(),
                 'image' => $user['image'] ?? $user['foto'] ?? 'default.png'
            ];

            $this->session->set($sessionData);

            // Redirect ke dashboard berdasarkan role
            return $this->redirectToDashboard($user['role_id']);
        }

        // Login gagal
        session()->setFlashdata('error', 'Email atau password salah');
        return redirect()->to('/auth')->withInput();
    }

    /**
     * Redirect berdasarkan role
     */
    private function redirectToDashboard($roleId)
    {
        switch ($roleId) {
            case 1: // Admin
                return redirect()->to('/dashboard');

            case 2: // User
            default:
                return redirect()->to('/dashboard');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Dapatkan session service
        $session = \Config\Services::session();

        // Log aktivitas logout
        $userEmail = $session->get('email');
        log_message('info', "User {$userEmail} logged out");

        // Hapus semua data session
        $session->destroy();

        // Hapus remember me cookie jika ada
        if (isset($_COOKIE['remember_token'])) {
            unset($_COOKIE['remember_token']);
            setcookie('remember_token', '', time() - 3600, '/');
        }

        // Redirect ke halaman login dengan pesan
        return redirect()->to('/auth')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Halaman 404 custom
     */
    public function show404()
    {
        // Jika sudah login, tampilkan 404 dengan template dashboard
        if ($this->session->get('logged_in')) {
            return view('errors/html/error_404', [
                'title' => 'Halaman Tidak Ditemukan'
            ]);
        }

        // Jika belum login, redirect ke login
        return redirect()->to('/auth');
    }
}
