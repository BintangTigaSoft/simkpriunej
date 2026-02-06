<?php

namespace App\Controllers;

class Users extends BaseController
{
    protected $db;
    protected $session;
    protected $allowedRoles = [1, 2]; // Admin dan Operator

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();

        // Check login
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/auth');
        }

        // Check role access
        $role_id = $this->session->get('role_id');
        if (!in_array($role_id, $this->allowedRoles)) {
            $this->session->setFlashdata('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to('/dashboard');
        }
    }

    private function getUserData()
    {
        return [
            'id_user' => $this->session->get('id_user'),
            'nama_lengkap' => $this->session->get('nama_lengkap'),
            'nmrole' => $this->session->get('nmrole'),
            'nmfakultas' => $this->session->get('nmfakultas'),
            'email' => $this->session->get('email'),

            'login_method' => $this->session->get('login_method'),
            'role_id' => $this->session->get('role_id'),
            'image' => $this->session->get('image') ?? 'default-avatar.png',
        ];
    }

    public function index()
    {
        // Get parameters (untuk initial load jika ada)
        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');
        $status = $this->request->getGet('status');

        // Build query - TANPA LIMIT untuk client-side filtering
        $builder = $this->db->table('z_ms_user u')
            ->select('u.*, r.nama as role_name, f.nmfakultas, f.kdfakultas')
            ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
            ->join('z_ks_unit f', 'u.kd_unit = f.kdfakultas', 'left')
            ->orderBy('u.created_at', 'DESC');

        // Get ALL results tanpa pagination
        $users = $builder->get()->getResultArray();

        // Get roles for filters
        $roles = $this->db->table('z_ks_role')
            ->whereIn('idtabel', [1, 2, 3])
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Manajemen Pengguna',
            'user' => $this->getUserData(),
            'users' => $users,  // SEMUA data
            'roles' => $roles,
            'search' => $search,
            'selected_role' => $role,
            'selected_status' => $status,
            'base_url' => base_url()
        ];

        // Add messages
        if ($this->session->getFlashdata('success')) {
            $data['success'] = $this->session->getFlashdata('success');
        }

        if ($this->session->getFlashdata('error')) {
            $data['error'] = $this->session->getFlashdata('error');
        }

        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('users/index', $data)
             . view('templates/footer', $data);
    }
    // Add new method for AJAX loading
    public function load_more()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = $this->request->getGet('limit') ?? 50;
        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');
        $status = $this->request->getGet('status');

        $builder = $this->db->table('z_ms_user u')
            ->select('u.*, r.nama as role_name, f.nmfakultas, f.kdfakultas')
            ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
            ->join('z_ks_unit f', 'u.kd_unit = f.kdfakultas', 'left')
            ->orderBy('u.created_at', 'DESC');

        // Apply filters
        if (!empty($search)) {
            $builder->groupStart()
                ->like('u.nama_lengkap', $search)
                ->orLike('u.id_user', $search)
                ->orLike('u.email', $search)
                ->orLike('u.user_sso', $search)
                ->groupEnd();
        }

        if (!empty($role) && $role != 'all') {
            $builder->where('u.role_id', $role);
        }

        if (!empty($status) && $status != 'all') {
            $builder->where('u.is_active', ($status == 'active' ? 1 : 0));
        }

        $offset = ($page - 1) * $limit;
        $users = $builder->limit($limit, $offset)->get()->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'users' => $users,
            'page' => $page,
            'has_more' => count($users) >= $limit
        ]);
    }
    /**
     * Menampilkan detail user
     */
    public function detail($id)
    {
        $userDetail = $this->db->table('z_ms_user u')
            ->select('u.*, r.nama as role_name, f.nmfakultas, f.kdfakultas ')
            ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
            ->join('z_ks_unit f', 'u.kd_unit = f.kdfakultas', 'left')

            ->where('u.id_user', $id)
            ->get()
            ->getRowArray();

        if (!$userDetail) {
            $this->session->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to('/users');
        }

        $data = [
            'title' => 'Detail Pengguna - ' . $userDetail['nama_lengkap'],
            'user' => $this->getUserData(),  // Konsisten
            'detail' => $userDetail,
            'base_url' => base_url()
        ];

        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('users/detail', $data)
             . view('templates/footer', $data);
    }

    /**
     * Menampilkan form tambah user
     */
    public function create()
    {
        if ($this->session->get('role_id') != 1) {
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menambahkan pengguna baru.');
            return redirect()->to('/users');
        }

        $roles = $this->db->table('z_ks_role')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $faculties = $this->db->table('z_ks_unit')
            ->orderBy('nmfakultas', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Tambah Pengguna Baru',
            'user' => $this->getUserData(),  // Konsisten
            'roles' => $roles,
            'faculties' => $faculties,
            'base_url' => base_url()
        ];

        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('users/create', $data)
             . view('templates/footer', $data);
    }

    /**
     * Proses tambah user
     */
    public function store()
    {
        // Only admin can create users
        if ($this->session->get('role_id') != 1) {
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menambahkan pengguna baru.');
            return redirect()->to('/users');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'id_user' => 'required|min_length[3]|max_length[50]|is_unique[z_ms_user.id_user]',
            'email' => 'required|valid_email|is_unique[z_ms_user.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
            'role_id' => 'required|numeric',
            'kd_unit' => 'permit_empty',
            'user_sso' => 'permit_empty|is_unique[z_ms_user.user_sso]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'id_user' => $this->request->getPost('id_user'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
            'kd_unit' => $this->request->getPost('kd_unit') ?: null,
            'user_sso' => $this->request->getPost('user_sso') ?: null,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'created_by' => $this->session->get('id_user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('z_ms_user')->insert($data);

        $this->session->setFlashdata('success', 'Pengguna berhasil ditambahkan.');
        return redirect()->to('/users');
    }


    // app/Controllers/Users.php

    /**
     * Get form data for add user modal (AJAX)
     */
    public function get_form_data()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        // Only admin can access
        if ($this->session->get('role_id') != 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Akses ditolak'
            ]);
        }

        // Get roles for dropdown
        $roles = $this->db->table('z_ks_role')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        // Get faculties for dropdown
        $faculties = $this->db->table('z_ks_unit')
            ->orderBy('nmfakultas', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'roles' => $roles,
                'faculties' => $faculties
            ]
        ]);
    }

    /**
     * Store new user via AJAX
     */
    public function ajax_store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        // Only admin can create users
        if ($this->session->get('role_id') != 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Hanya admin yang dapat menambahkan pengguna baru.'
            ]);
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'id_user' => 'required|min_length[3]|max_length[50]|is_unique[z_ms_user.id_user]',
            'email' => 'required|valid_email|is_unique[z_ms_user.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
            'role_id' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'id_user' => $this->request->getPost('id_user'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
            'kd_unit' => $this->request->getPost('kd_unit') ?: null,
            'user_sso' => $this->request->getPost('user_sso') ?: null,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
          //  'created_by' => $this->session->get('id_user'),
          //  'created_at' => date('Y-m-d H:i:s'),
          //  'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert to database
        $this->db->table('z_ms_user')->insert($data);
        $userId = $this->db->insertID();

        if ($userId) {
            // Get the newly created user with role name
            $newUser = $this->db->table('z_ms_user u')
                ->select('u.*, r.nama as role_name')
                ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
                ->where('u.id_user', $data['id_user'])
                ->get()
                ->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pengguna berhasil ditambahkan.',
                'data' => $newUser
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menambahkan pengguna.'
            ]);
        }
    }


    public function get_edit_data($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        $user = $this->db->table('z_ms_user')->where('id_user', $id)->get()->getRowArray();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Get roles for dropdown
        $roles = $this->db->table('z_ks_role')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'id_user' => $user['id_user'],
                'nama_lengkap' => $user['nama_lengkap'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'user_sso' => $user['user_sso'],
                'is_active' => $user['is_active'],
                'roles' => $roles
            ]
        ]);
    }


    public function ajax_update()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        $id = $this->request->getPost('user_id');
        $user = $this->db->table('z_ms_user')->where('id_user', $id)->get()->getRowArray();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan.'
            ]);
        }

        // Check permission
        $current_role = $this->session->get('role_id');
        if ($current_role == 2 && $user['role_id'] == 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda tidak dapat mengedit pengguna admin.'
            ]);
        }

        // Validation
        $validation = \Config\Services::validation();

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'id_user' => "required|min_length[3]|max_length[50]|is_unique[z_ms_user.id_user,id_user,{$id}]",
            'email' => "required|valid_email|is_unique[z_ms_user.email,id_user,{$id}]",
            'role_id' => 'required|numeric'
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Prepare data
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'id_user' => $this->request->getPost('id_user'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
            'user_sso' => $this->request->getPost('user_sso') ?: null,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
          //  'updated_by' => $this->session->get('id_user'),
          //  'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update password if provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Update database
        $result = $this->db->table('z_ms_user')->where('id_user', $id)->update($data);

        if ($result) {
            // Get updated user with role name
            $updatedUser = $this->db->table('z_ms_user u')
                ->select('u.*, r.nama as role_name')
                ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
                ->where('u.id_user', $id)
                ->get()
                ->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data pengguna berhasil diperbarui.',
                'data' => $updatedUser
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui data.'
            ]);
        }
    }

    public function deactivate($id)
    {
        // Check if it's AJAX request
        $isAjax = $this->request->isAJAX();

        // Only admin can deactivate users
        if ($this->session->get('role_id') != 1) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Akses Ditolak',
                    'message' => 'Hanya admin yang dapat menonaktifkan pengguna.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menonaktifkan pengguna.');
            return redirect()->to('/users');
        }

        // Prevent self-deactivation
        if ($id == $this->session->get('id_user')) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Tidak Diizinkan',
                    'message' => 'Anda tidak dapat menonaktifkan akun sendiri.',
                    'icon' => 'warning'
                ]);
            }
            $this->session->setFlashdata('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
            return redirect()->to('/users');
        }

        $user = $this->db->table('z_ms_user')->where('id_user', $id)->get()->getRowArray();

        if (!$user) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Data Tidak Ditemukan',
                    'message' => 'Pengguna tidak ditemukan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to('/users');
        }

        // Check if user is already inactive
        if ($user['is_active'] == 0) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Sudah Nonaktif',
                    'message' => 'Pengguna sudah dalam status nonaktif.',
                    'icon' => 'info'
                ]);
            }
            $this->session->setFlashdata('error', 'Pengguna sudah dalam status nonaktif.');
            return redirect()->to('/users');
        }

        // Nonaktifkan user
        $result = $this->db->table('z_ms_user')
            ->where('id_user', $id)
            ->update([
                'is_active' => 0,

            ]);

        if ($result) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Pengguna berhasil dinonaktifkan.',
                    'icon' => 'success',
                    'user_id' => $id,
                    'user_name' => $user['nama_lengkap'],
                    'new_status' => 0
                ]);
            }
            $this->session->setFlashdata('success', 'Pengguna berhasil dinonaktifkan.');
        } else {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Gagal menonaktifkan pengguna.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Gagal menonaktifkan pengguna.');
        }

        return redirect()->to('/users');
    }

    public function activate($id)
    {
        // Check if it's AJAX request
        $isAjax = $this->request->isAJAX();

        // Only admin can activate users
        if ($this->session->get('role_id') != 1) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Akses Ditolak',
                    'message' => 'Hanya admin yang dapat mengaktifkan pengguna.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Hanya admin yang dapat mengaktifkan pengguna.');
            return redirect()->to('/users');
        }

        $user = $this->db->table('z_ms_user')->where('id_user', $id)->get()->getRowArray();

        if (!$user) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Data Tidak Ditemukan',
                    'message' => 'Pengguna tidak ditemukan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to('/users');
        }

        // Check if user is already active
        if ($user['is_active'] == 1) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Sudah Aktif',
                    'message' => 'Pengguna sudah dalam status aktif.',
                    'icon' => 'info'
                ]);
            }
            $this->session->setFlashdata('error', 'Pengguna sudah dalam status aktif.');
            return redirect()->to('/users');
        }

        // Aktifkan user
        $result = $this->db->table('z_ms_user')
            ->where('id_user', $id)
            ->update([
                'is_active' => 1,

            ]);

        if ($result) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Pengguna berhasil diaktifkan kembali.',
                    'icon' => 'success',
                    'user_id' => $id,
                    'user_name' => $user['nama_lengkap'],
                    'new_status' => 1
                ]);
            }
            $this->session->setFlashdata('success', 'Pengguna berhasil diaktifkan kembali.');
        } else {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Gagal mengaktifkan pengguna.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Gagal mengaktifkan pengguna.');
        }

        return redirect()->to('/users');
    }

    /**
     * Reset password user
     */
    public function reset_password($id)
    {
        // Admin can reset anyone's password, operator can only reset non-admin
        $current_role = $this->session->get('role_id');

        $user = $this->db->table('z_ms_user')->where('id_user', $id)->get()->getRowArray();

        if (!$user) {
            $this->session->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to('/users');
        }

        if ($current_role == 2 && $user['role_id'] == 1) {
            $this->session->setFlashdata('error', 'Anda tidak dapat mereset password admin.');
            return redirect()->to('/users');
        }

        // Generate random password
        $new_password = bin2hex(random_bytes(4)); // 8 karakter random
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $this->db->table('z_ms_user')
            ->where('id_user', $id)
            ->update([
                'password' => $hashed_password,

            ]);

        // Store password for display (in real app, send via email)
        $this->session->setFlashdata('success', 'Password berhasil direset. Password baru: <strong>' . $new_password . '</strong>');
        return redirect()->to('/users/detail/' . $id);
    }

    /**
     * Export users to CSV
     */
    public function export()
    {
        $users = $this->db->table('z_ms_user u')
            ->select('u.*, r.nama as role_name, f.nmfakultas')
            ->join('z_ks_role r', 'u.role_id = r.idtabel', 'left')
            ->join('z_ks_unit f', 'u.kd_unit = f.kdfakultas', 'left')
            ->orderBy('u.created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=users_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');

        // Add BOM for UTF-8
        fwrite($output, "\xEF\xBB\xBF");

        // Header row
        fputcsv($output, [
            'ID', 'Nama Lengkap', 'Email', 'SSO Username',
            'Role', 'Fakultas', 'Status', 'Tanggal Dibuat', 'Terakhir Diupdate'
        ]);

        // Data rows
        foreach ($users as $user) {
            fputcsv($output, [
                $user['id_user'],
                $user['nama_lengkap'],

                $user['email'],
                $user['user_sso'] ?? '-',
                $user['role_name'] ?? '-',
                $user['nmfakultas'] ?? '-',
                $user['is_active'] ? 'Aktif' : 'Nonaktif',
                $user['created_at'],
                $user['updated_at']
            ]);
        }

        fclose($output);
        exit;
    }
}
