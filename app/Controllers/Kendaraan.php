<?php

namespace App\Controllers;

class Kendaraan extends BaseController
{
    protected $db;
    protected $session;
    protected $allowedRoles = [1, 2]; // Admin dan Operator
    protected $uploadPath;

    public function __construct()
    {

        $this->db = \Config\Database::connect();
        $this->session = session();

        // KONSISTEN: writable/uploads/kendaraan/
        $this->uploadPath = WRITEPATH . 'uploads/kendaraan/';

        // Buat folder uploads jika belum ada
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }


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

    public function image($filename = 'default-car.png')
    {
        // Clean filename untuk keamanan
        $filename = basename($filename);

        // Path file
        $filePath = WRITEPATH . 'uploads/kendaraan/' . $filename;

        // Jika file tidak ada atau corrupt, buat default
        if (!file_exists($filePath) ||
            filesize($filePath) === 0 ||
            !@getimagesize($filePath)) {

            // Buat gambar default sederhana
            $image = imagecreatetruecolor(100, 100);
            $bgColor = imagecolorallocate($image, 59, 130, 246); // Biru
            imagefill($image, 0, 0, $bgColor);

            // Tambahkan icon mobil
            $iconColor = imagecolorallocate($image, 255, 255, 255);
            imagestring($image, 5, 30, 40, "CAR", $iconColor);

            // Simpan
            imagepng($image, $filePath);
            imagedestroy($image);
        }

        // Output dengan cara sederhana
        $mime = mime_content_type($filePath) ?: 'image/png';

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    public function serve_image($filename = null)
    {
        // Default file jika filename kosong
        if (!$filename) {
            $filename = 'default-car.png';
        }

        // Path ke file di writable
        $filePath = WRITEPATH . 'uploads/kendaraan/' . $filename;

        // Default image jika file tidak ditemukan
        if (!file_exists($filePath)) {
            $filename = 'default-car.png';
            $filePath = WRITEPATH . 'uploads/kendaraan/' . $filename;

            // Jika default juga tidak ada, return 404
            if (!file_exists($filePath)) {
                return $this->response->setStatusCode(404)->setBody('File not found');
            }
        }

        // Get file extension untuk menentukan content type
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $mime_types = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp'
        ];

        $mime = $mime_types[strtolower($ext)] ?? 'image/jpeg';

        // Set header
        $this->response->setContentType($mime);
        $this->response->setHeader('Content-Length', (string) filesize($filePath));
        $this->response->setHeader('Cache-Control', 'public, max-age=86400'); // Cache 1 hari

        // Output file
        readfile($filePath);

        // Exit untuk mencegah output tambahan
        exit();
    }

    private function handleFileUpload($fieldName = 'foto')
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate nama file unik
            $newName = $file->getRandomName();
            $file->move($this->uploadPath, $newName);

            return $newName;
        }

        return null;
    }


    private function deleteOldFile($filename)
    {
        if ($filename && $filename != 'default-car.png') {
            $filePath = $this->uploadPath . $filename;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
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
        $jenis = $this->request->getGet('jenis');
        $status = $this->request->getGet('status');

        $builder = $this->db->table('z_data_kendaraan k')
           ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
           ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
           ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
           ->orderBy('k.created_at', 'DESC');

        // Apply filters jika ada
        if (!empty($search)) {
            $builder->groupStart()
                ->like('k.nama', $search)
                ->orLike('k.no_plat', $search)
                ->groupEnd();
        }

        if (!empty($jenis) && $jenis != 'all') {
            $builder->where('k.idjenis_kendaraan', $jenis);
        }

        if (!empty($status) && $status != 'all') {
            $builder->where('k.idstatus_kendaraan', $status);
        }

        // Get ALL results tanpa pagination
        $kendaraan = $builder->get()->getResultArray();

        // Get jenis kendaraan for filters
        $jenis_kendaraan = $this->db->table('z_ks_jenis_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        // Get status kendaraan for filters
        $status_kendaraan = $this->db->table('z_ks_status_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Manajemen Kendaraan',
            'user' => $this->getUserData(),
            'kendaraan' => $kendaraan,  // SEMUA data
            'jenis_kendaraan' => $jenis_kendaraan,
            'status_kendaraan' => $status_kendaraan,
            'search' => $search,
            'selected_jenis' => $jenis,
            'selected_status' => $status,
            'base_url' => base_url(),
            'upload_url' => base_url('uploads/kendaraan/')
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
             . view('kendaraan/index', $data)
             . view('templates/footer', $data);
    }


    // Add new method for AJAX loading
    public function load_more()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = $this->request->getGet('limit') ?? 50;
        $search = $this->request->getGet('search');
        $jenis = $this->request->getGet('jenis');
        $status = $this->request->getGet('status');

        $builder = $this->db->table('z_data_kendaraan k')
            ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
            ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
            ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
            ->orderBy('k.created_at', 'DESC');

        // Apply filters
        if (!empty($search)) {
            $builder->like('k.nama', $search);
        }

        if (!empty($jenis) && $jenis != 'all') {
            $builder->where('k.idjenis_kendaraan', $jenis);
        }

        if (!empty($status) && $status != 'all') {
            $builder->where('k.idstatus_kendaraan', $status);
        }

        $offset = ($page - 1) * $limit;
        $kendaraan = $builder->limit($limit, $offset)->get()->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'kendaraan' => $kendaraan,
            'page' => $page,
            'has_more' => count($kendaraan) >= $limit
        ]);
    }

    /**
     * Menampilkan detail kendaraan
     */
    public function detail($id)
    {
        $kendaraanDetail = $this->db->table('z_data_kendaraan k')
            ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
            ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
            ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
            ->where('k.idtabel', $id)
            ->get()
            ->getRowArray();

        if (!$kendaraanDetail) {
            $this->session->setFlashdata('error', 'Kendaraan tidak ditemukan.');
            return redirect()->to('/kendaraan');
        }

        $data = [
            'title' => 'Detail Kendaraan - ' . $kendaraanDetail['nama'],
            'user' => $this->getUserData(),
            'detail' => $kendaraanDetail,
            'base_url' => base_url()
        ];

        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('kendaraan/detail', $data)
             . view('templates/footer', $data);
    }

    /**
     * Menampilkan form tambah kendaraan
     */
    public function create()
    {
        if ($this->session->get('role_id') != 1) {
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menambahkan kendaraan baru.');
            return redirect()->to('/kendaraan');
        }

        $jenis_kendaraan = $this->db->table('z_ks_jenis_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $status_kendaraan = $this->db->table('z_ks_status_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Tambah Kendaraan Baru',
            'user' => $this->getUserData(),
            'jenis_kendaraan' => $jenis_kendaraan,
            'status_kendaraan' => $status_kendaraan,
            'base_url' => base_url()
        ];

        return view('templates/header', $data)
             . view('templates/topbar', $data)
             . view('templates/sidebar', $data)
             . view('kendaraan/create', $data)
             . view('templates/footer', $data);
    }

    /**
     * Proses tambah kendaraan
     */
    public function store()
    {
        // Only admin can create kendaraan
        if ($this->session->get('role_id') != 1) {
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menambahkan kendaraan baru.');
            return redirect()->to('/kendaraan');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'idjenis_kendaraan' => 'required|numeric',
            'idstatus_kendaraan' => 'required|numeric',
            'harga_perjam' => 'required|numeric|greater_than[0]',
            'harga_perhari' => 'required|numeric|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'idjenis_kendaraan' => $this->request->getPost('idjenis_kendaraan'),
            'idstatus_kendaraan' => $this->request->getPost('idstatus_kendaraan'),
            'harga_perjam' => $this->request->getPost('harga_perjam'),
            'harga_perhari' => $this->request->getPost('harga_perhari'),
            'created_at' => date('Y-m-d H:i:s'),
            'modify_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('z_data_kendaraan')->insert($data);

        $this->session->setFlashdata('success', 'Kendaraan berhasil ditambahkan.');
        return redirect()->to('/kendaraan');
    }

    /**
     * Get form data for add kendaraan modal (AJAX)
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

        // Get jenis kendaraan for dropdown
        $jenis_kendaraan = $this->db->table('z_ks_jenis_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        // Get status kendaraan for dropdown
        $status_kendaraan = $this->db->table('z_ks_status_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'jenis_kendaraan' => $jenis_kendaraan,
                'status_kendaraan' => $status_kendaraan
            ]
        ]);
    }

    /**
     * Store new kendaraan via AJAX
     */
    public function ajax_store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        // Only admin can create kendaraan
        if ($this->session->get('role_id') != 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Hanya admin yang dapat menambahkan kendaraan baru.'
            ]);
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'no_plat' => 'required|min_length[3]|max_length[20]|is_unique[z_data_kendaraan.no_plat]',
            'idjenis_kendaraan' => 'required|numeric',
            'idstatus_kendaraan' => 'required|numeric',
            'harga_perjam' => 'required|numeric|greater_than[0]',
            'harga_perhari' => 'required|numeric|greater_than[0]',
            'foto' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Handle file upload
        $fotoName = $this->handleFileUpload();
        if (!$fotoName) {
            $fotoName = 'default-car.png';
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_plat' => $this->request->getPost('no_plat'),
            'idjenis_kendaraan' => $this->request->getPost('idjenis_kendaraan'),
            'idstatus_kendaraan' => $this->request->getPost('idstatus_kendaraan'),
            'harga_perjam' => $this->request->getPost('harga_perjam'),
            'harga_perhari' => $this->request->getPost('harga_perhari'),
            'foto' => $fotoName,
            'created_at' => date('Y-m-d H:i:s'),
            'modify_at' => date('Y-m-d H:i:s')
        ];

        // Insert to database
        $this->db->table('z_data_kendaraan')->insert($data);
        $kendaraanId = $this->db->insertID();

        if ($kendaraanId) {
            // Get the newly created kendaraan with jenis and status
            $newKendaraan = $this->db->table('z_data_kendaraan k')
                ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
                ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
                ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
                ->where('k.idtabel', $kendaraanId)
                ->get()
                ->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kendaraan berhasil ditambahkan.',
                'data' => $newKendaraan
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menambahkan kendaraan.'
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

        $kendaraan = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->get()->getRowArray();

        if (!$kendaraan) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan'
            ]);
        }

        // Get jenis kendaraan for dropdown
        $jenis_kendaraan = $this->db->table('z_ks_jenis_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        // Get status kendaraan for dropdown
        $status_kendaraan = $this->db->table('z_ks_status_kendaraan')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'idtabel' => $kendaraan['idtabel'],
                'nama' => $kendaraan['nama'],
                'no_plat' => $kendaraan['no_plat'],
                'idjenis_kendaraan' => $kendaraan['idjenis_kendaraan'],
                'idstatus_kendaraan' => $kendaraan['idstatus_kendaraan'],
                'harga_perjam' => $kendaraan['harga_perjam'],
                'harga_perhari' => $kendaraan['harga_perhari'],
                'foto' => $kendaraan['foto'],
                'jenis_kendaraan' => $jenis_kendaraan,
                'status_kendaraan' => $status_kendaraan
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

        $id = $this->request->getPost('kendaraan_id');
        $kendaraan = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->get()->getRowArray();

        if (!$kendaraan) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan.'
            ]);
        }

        // Check permission - admin only untuk edit
        if ($this->session->get('role_id') != 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Hanya admin yang dapat mengedit kendaraan.'
            ]);
        }

        // Validation
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'no_plat' => "required|min_length[3]|max_length[20]|is_unique[z_data_kendaraan.no_plat,idtabel,{$id}]",
            'idjenis_kendaraan' => 'required|numeric',
            'idstatus_kendaraan' => 'required|numeric',
            'harga_perjam' => 'required|numeric|greater_than[0]',
            'harga_perhari' => 'required|numeric|greater_than[0]',
            'foto' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Handle file upload jika ada
        $fotoName = $this->handleFileUpload();
        if (!$fotoName) {
            $fotoName = $kendaraan['foto'];
        } else {
            // Delete old file jika bukan default
            $this->deleteOldFile($kendaraan['foto']);
        }

        // Prepare data
        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_plat' => $this->request->getPost('no_plat'),
            'idjenis_kendaraan' => $this->request->getPost('idjenis_kendaraan'),
            'idstatus_kendaraan' => $this->request->getPost('idstatus_kendaraan'),
            'harga_perjam' => $this->request->getPost('harga_perjam'),
            'harga_perhari' => $this->request->getPost('harga_perhari'),
            'foto' => $fotoName,
            'modify_at' => date('Y-m-d H:i:s')
        ];

        // Update database
        $result = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->update($data);

        if ($result) {
            // Get updated kendaraan with jenis and status
            $updatedKendaraan = $this->db->table('z_data_kendaraan k')
                ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
                ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
                ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
                ->where('k.idtabel', $id)
                ->get()
                ->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil diperbarui.',
                'data' => $updatedKendaraan
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui data.'
            ]);
        }
    }

    public function delete($id)
    {
        // Check if it's AJAX request
        $isAjax = $this->request->isAJAX();

        // Only admin can delete kendaraan
        if ($this->session->get('role_id') != 1) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Akses Ditolak',
                    'message' => 'Hanya admin yang dapat menghapus kendaraan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Hanya admin yang dapat menghapus kendaraan.');
            return redirect()->to('/kendaraan');
        }

        $kendaraan = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->get()->getRowArray();

        if (!$kendaraan) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Data Tidak Ditemukan',
                    'message' => 'Kendaraan tidak ditemukan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Kendaraan tidak ditemukan.');
            return redirect()->to('/kendaraan');
        }

        // Delete file foto jika bukan default
        $this->deleteOldFile($kendaraan['foto']);

        // Delete kendaraan
        $result = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->delete();

        if ($result) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Kendaraan berhasil dihapus.',
                    'icon' => 'success',
                    'kendaraan_id' => $id,
                    'kendaraan_nama' => $kendaraan['nama']
                ]);
            }
            $this->session->setFlashdata('success', 'Kendaraan berhasil dihapus.');
        } else {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Gagal menghapus kendaraan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Gagal menghapus kendaraan.');
        }

        if ($isAjax) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kendaraan dihapus'
            ]);
        }

        return redirect()->to('/kendaraan');
    }

    /**
     * Export kendaraan to CSV
     */
    public function export()
    {
        $kendaraan = $this->db->table('z_data_kendaraan k')
            ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
            ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
            ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
            ->orderBy('k.created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=kendaraan_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');

        // Add BOM for UTF-8
        fwrite($output, "\xEF\xBB\xBF");

        // Header row
        fputcsv($output, [
            'ID', 'Nama Kendaraan', 'Jenis Kendaraan', 'Status Kendaraan',
            'Harga Per Jam', 'Harga Per Hari', 'Tanggal Dibuat', 'Terakhir Diupdate'
        ]);

        // Data rows
        foreach ($kendaraan as $item) {
            fputcsv($output, [
                $item['idtabel'],
                $item['nama'],
                $item['jenis_kendaraan'] ?? '-',
                $item['status_kendaraan'] ?? '-',
                number_format($item['harga_perjam'], 0, ',', '.'),
                number_format($item['harga_perhari'], 0, ',', '.'),
                $item['created_at'],
                $item['modify_at']
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Update status kendaraan
     */
    public function update_status($id)
    {
        // Check if it's AJAX request
        $isAjax = $this->request->isAJAX();

        // Only admin can update status
        if ($this->session->get('role_id') != 1) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Akses Ditolak',
                    'message' => 'Hanya admin yang dapat mengubah status kendaraan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Hanya admin yang dapat mengubah status kendaraan.');
            return redirect()->to('/kendaraan');
        }

        $kendaraan = $this->db->table('z_data_kendaraan')->where('idtabel', $id)->get()->getRowArray();

        if (!$kendaraan) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Data Tidak Ditemukan',
                    'message' => 'Kendaraan tidak ditemukan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Kendaraan tidak ditemukan.');
            return redirect()->to('/kendaraan');
        }

        $new_status = $this->request->getPost('status_id');

        if (!$new_status) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Status Tidak Valid',
                    'message' => 'Status tidak valid.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Status tidak valid.');
            return redirect()->to('/kendaraan');
        }

        // Update status kendaraan
        $result = $this->db->table('z_data_kendaraan')
            ->where('idtabel', $id)
            ->update([
                'idstatus_kendaraan' => $new_status,
                'modify_at' => date('Y-m-d H:i:s')
            ]);

        if ($result) {
            if ($isAjax) {
                // Get updated data
                $updatedKendaraan = $this->db->table('z_data_kendaraan k')
                    ->select('k.*, jk.nama as jenis_kendaraan, sk.nama as status_kendaraan')
                    ->join('z_ks_jenis_kendaraan jk', 'k.idjenis_kendaraan = jk.idtabel', 'left')
                    ->join('z_ks_status_kendaraan sk', 'k.idstatus_kendaraan = sk.idtabel', 'left')
                    ->where('k.idtabel', $id)
                    ->get()
                    ->getRowArray();

                return $this->response->setJSON([
                    'status' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Status kendaraan berhasil diperbarui.',
                    'icon' => 'success',
                    'kendaraan_id' => $id,
                    'kendaraan_nama' => $kendaraan['nama'],
                    'new_status' => $updatedKendaraan['status_kendaraan'],
                    'data' => $updatedKendaraan
                ]);
            }
            $this->session->setFlashdata('success', 'Status kendaraan berhasil diperbarui.');
        } else {
            if ($isAjax) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Gagal memperbarui status kendaraan.',
                    'icon' => 'error'
                ]);
            }
            $this->session->setFlashdata('error', 'Gagal memperbarui status kendaraan.');
        }

        if ($isAjax) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Status diperbarui'
            ]);
        }

        return redirect()->to('/kendaraan');
    }
}
