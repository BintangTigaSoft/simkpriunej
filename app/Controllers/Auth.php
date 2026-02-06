<?php

namespace App\Controllers;

class Auth extends \CodeIgniter\Controller
{
    public function __construct()
    {
        // Helper session hanya untuk method tertentu

    }

    /**
     * Halaman login utama
     */
    public function index()
    {
        helper('session'); // Load session helper di method

        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        // Langsung ke SSO
        return redirect()->to('/auth/sso');
    }

    /**
     * Endpoint untuk callback dari CAS (authensso) - TANPA SESSION CI4
     */
    public function authensso()
    {
        // JANGAN gunakan session helper di sini
        // Tutup session jika ada yang aktif
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        error_log("=== CAS CALLBACK (No CI Session) ===");



        try {
            require_once APPPATH . 'ThirdParty/phpCAS/CAS.php';



            // Setup CAS dengan session native PHP
            \phpCAS::client(
                CAS_VERSION_2_0,
                'sso.unej.ac.id',
                443,
                '/cas',
                false  // FALSE = gunakan session native PHP
            );

            \phpCAS::setNoCasServerValidation();

            $service_url = 'https://newkpri.resilia-flood.id/auth/authensso';


            \phpCAS::setFixedServiceURL($service_url);


            \phpCAS::forceAuthentication();

            $username = \phpCAS::getUser();


            if ($username) {
                // Simpan username di cookie temporary untuk diproses nanti
                setcookie('cas_temp_user', $username, time() + 60, '/', '', true, true);


                // Redirect ke handler dengan JavaScript (lebih reliable)
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '" . base_url('auth/process_cas') . "';
                    }, 100);
                </script>";
                exit;
            }

        } catch (\Exception $e) {
            echo "<p style='color:red'>❌ CAS Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";

            echo "<p><a href='" . base_url('auth/form') . "'>Go to Manual Login</a></p>";
        }
    }

    /**
     * Process CAS login (setelah auth berhasil)
     */
    public function process_cas()
    {
        // Sekarang baru load session helper
        helper('session');

        $username = $_COOKIE['cas_temp_user'] ?? '';

        if (!$username) {
            return redirect()->to('/auth/form?error=cas_failed');
        }

        // Hapus cookie temporary
        setcookie('cas_temp_user', '', time() - 3600, '/');

        error_log("Processing CAS user: $username");

        // Process login
        $db = \Config\Database::connect();

        $user = $db->table('z_ms_user a')
                  ->select('a.*, b.nmfakultas, c.nama as nmrole')
                  ->join('z_ks_unit b', 'a.kd_unit = b.kdfakultas', 'inner')
                  ->join('z_ks_role c', 'a.role_id = c.idtabel', 'inner')
                  ->where('a.user_sso', $username)
                  ->where('a.is_active', 1)
                  ->get()
                  ->getRowArray();



        if ($user) {
            $this->setUserSession($user, $username, 'sso');
            return redirect()->to('/dashboard');
        } else {
            session()->set('sso_username', $username);
            return redirect()->to('/auth/form?sso=' . urlencode($username));
        }
    }

    /**
     * Login via CAS SSO (direct)
     */
    public function sso()
    {
        try {
            // Untuk SSO direct, kita juga perlu handle session
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_write_close();
            }

            require_once APPPATH . 'ThirdParty/phpCAS/CAS.php';

            \phpCAS::client(
                CAS_VERSION_2_0,
                'sso.unej.ac.id',
                443,
                '/cas',
                false  // FALSE untuk session native
            );

            \phpCAS::setNoCasServerValidation();
            \phpCAS::setFixedServiceURL(base_url('auth/authensso'));

            \phpCAS::forceAuthentication();
            $username = \phpCAS::getUser();

            if (!$username) {
                throw new \Exception('Autentikasi gagal');
            }

            // Redirect ke process_cas
            setcookie('cas_temp_user', $username, time() + 60, '/', '', true, true);
            return redirect()->to('/auth/process_cas');

        } catch (\Exception $e) {
            error_log("SSO Authentication Error: " . $e->getMessage());
            return redirect()->to('/auth/form?error=cas_failed');
        }
    }

    /**
     * Form login manual
     */
    public function form()
    {
        helper('session'); // Load session untuk method ini

        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $sso_username = $this->request->getGet('sso') ?? session()->get('sso_username') ?? '';
        $error = $this->request->getGet('error') ?? '';

        $error_messages = [
            'cas_failed' => 'Login SSO gagal. Silakan coba login manual.',
            'cas_unavailable' => 'SSO UNEJ sedang tidak tersedia.',
            'empty' => 'Username dan password harus diisi.',
            'invalid' => 'Username atau password salah.',
        ];

        $error_message = $error_messages[$error] ?? '';

        $data = [
            'title' => 'Login - SiKuje',
            'sso_username' => $sso_username,
            'base_url' => base_url(),
            'error' => $error_message,
            'prefill_username' => $sso_username ?: ''
        ];

        return view('auth/login_form', $data);
    }

    /**
     * Proses login manual
     */
    public function process()
    {
        helper('session'); // Load session untuk method ini

        if (!$this->request->is('post')) {
            return redirect()->to('/auth/form');
        }

        $username = $this->request->getPost('username') ?? '';
        $password = $this->request->getPost('password') ?? '';

        if (empty($username) || empty($password)) {
            return redirect()->to('/auth/form?error=empty');
        }

        $db = \Config\Database::connect();

        $user = $db->table('z_ms_user a')
                  ->select('a.*, b.nmfakultas, c.nama as nmrole')
                  ->join('z_ks_unit b', 'a.kd_unit = b.kdfakultas', 'left')
                  ->join('z_ks_role c', 'a.role_id = c.idtabel', 'left')
                  ->groupStart()
                    ->where('a.username', $username)
                    ->orWhere('a.email', $username)
                  ->groupEnd()
                  ->where('a.is_active', 1)
                  ->get()
                  ->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user, $user['username'], 'manual');
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/auth/form?error=invalid');
    }

    /**
     * Set session data setelah login sukses
     */
    private function setUserSession($user, $username, $method = 'sso')
    {
        $sessionData = [
            'id_user' => $user['id_user'],
            'nama_lengkap' => $user['nama_lengkap'] ?? 'User',
            'username' => $username,
            'email' => $user['email'] ?? '',
            'nmrole' => $user['nmrole'] ?? 'Pengguna',
            'nmfakultas' => $user['nmfakultas'] ?? 'Fakultas',
            'kd_unit' => $user['kd_unit'] ?? '',
            'role_id' => $user['role_id'] ?? 2,
            'logged_in' => true,
            'login_time' => time(),
            'login_method' => $method,
            'image' => $user['image'] ?? $user['foto'] ?? 'default-avatar.png'
        ];

        if ($method === 'sso') {
            $sessionData['user_sso'] = $username;
        }

        session()->set($sessionData);

        error_log("Session set for user: $username");
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Log semua informasi
        error_log("=========================================");
        error_log("LOGOUT PROCESS STARTED");
        error_log("Time: " . date('Y-m-d H:i:s'));
        error_log("Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A'));
        error_log("Request Method: " . ($_SERVER['REQUEST_METHOD'] ?? 'N/A'));
        error_log("Session ID before: " . session_id());

        // Helper session
        helper('session');

        // Ambil data session SEBELUM destroy
        $login_method = session()->get('login_method') ?? 'manual';
        $username = session()->get('username') ?? 'unknown';

        error_log("User: $username, Login Method: $login_method");
        error_log("Session data before destroy: " . json_encode(session()->get()));

        // ===== DESTROY SESSION =====
        // 1. Destroy CI4 session
        session()->destroy();
        error_log("CI4 session destroyed");

        // 2. Destroy native PHP session jika aktif
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
            error_log("Native PHP session destroyed");
        }

        // 3. Clear semua cookies session
        $cookies_to_clear = ['ci_session', 'PHPSESSID', 'cas_temp_user'];
        foreach ($cookies_to_clear as $cookie_name) {
            if (isset($_COOKIE[$cookie_name])) {
                setcookie($cookie_name, '', time() - 3600, '/', '', false, true);
                unset($_COOKIE[$cookie_name]);
                error_log("Cookie cleared: $cookie_name");
            }
        }

        // 4. Juga clear via header untuk memastikan
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
            error_log("Session cookie cleared via header");
        }

        // ===== HANDLE REDIRECT =====
        if ($login_method === 'sso') {
            error_log("SSO logout initiated");

            // Option 1: Direct CAS logout URL (sederhana)
            $service_url = 'https://newkpri.resilia-flood.id/';
            $cas_logout_url = 'https://sso.unej.ac.id/cas/logout?service=' . urlencode($service_url);

            error_log("Redirecting to CAS logout: $cas_logout_url");

            // Clear output buffer
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Redirect langsung
            header('Location: ' . $cas_logout_url);
            exit;

        } else {
            error_log("Manual logout - redirecting to home");
            return redirect()->to('/');
        }

        error_log("LOGOUT PROCESS COMPLETED");
        error_log("=========================================");
    }
}
