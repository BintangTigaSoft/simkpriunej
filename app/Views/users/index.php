<?php


?>
<!-- Masukkan ini di dalam bagian head atau sebelum akhir bagian body -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>




<style>
:root {
    --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    --secondary-gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
    --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    --info-gradient: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
    --lab-gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    --glass-bg: rgba(255, 255, 255, 0.95);
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.15);
    --border-radius-lg: 16px;
    --border-radius-md: 12px;
    --border-radius-sm: 8px;
}

body {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    margin: 0;
    padding: 0;
}

/* Header Styling */
.glass-header {
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: var(--shadow-lg);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    position: relative;
}

.glass-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--lab-gradient);
}

/* Lab Icon */
.lab-icon {
    width: 40px;
    height: 40px;
    background: var(--lab-gradient);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: var(--shadow-sm);
}

/* Action Bar */
.action-bar {
    background: var(--glass-bg);
    border-radius: var(--border-radius-md);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: var(--shadow-sm);
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
}

.btn-glass {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius-sm);
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
}

.btn-glass:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-glass.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white !important;
    border: none;
}

.btn-glass.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white !important;
    border: none;
}

.btn-glass.btn-info {
    background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
    color: white !important;
    border: none;
}

.btn-glass.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white !important;
    border: none;
}

.btn-glass.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white !important;
    border: none;
}

/* Main Table Card */
.main-table-card {
    background: var(--glass-bg);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

/* Table Styling */
#dataTable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    margin-bottom: 0;
}

#dataTable thead th {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #475569;
    padding: 0.75rem;
    white-space: nowrap;
    position: relative;
    vertical-align: middle;
}

#dataTable thead th::after {
    content: '';
    position: absolute;
    right: 0;
    top: 15%;
    height: 70%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, #cbd5e1, transparent);
}

#dataTable thead th:last-child::after {
    display: none;
}

#dataTable tbody td {
    padding: 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
    transition: all 0.2s ease;
}

#dataTable tbody tr {
    transition: all 0.3s ease;
}

#dataTable tbody tr:hover {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(241, 245, 249, 0.5);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(148, 163, 184, 0.5);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(100, 116, 139, 0.7);
}

/* Lab Card */
.lab-card {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(139, 92, 246, 0.02) 100%);
    border: 1px solid rgba(139, 92, 246, 0.1);
    border-radius: var(--border-radius-sm);
    padding: 8px;
}

/* Summary Card */
.summary-card {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: var(--border-radius-md);
    padding: 1.5rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.summary-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--lab-gradient);
}

/* Status Badges */
.status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 10px;
    display: inline-block;
}

.quality-sangat-baik {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.quality-baik {
    background: rgba(59, 130, 246, 0.1);
    color: #1d4ed8;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.quality-kurang {
    background: rgba(245, 158, 11, 0.1);
    color: #d97706;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.quality-tidak-baik {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.ownership-sendiri {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.ownership-sewa {
    background: rgba(59, 130, 246, 0.1);
    color: #1d4ed8;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.condition-terawat {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.condition-tidak {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

/* Quantity Badge */
.quantity-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 50%;
    font-weight: 600;
    color: #7c3aed;
    font-size: 0.85rem;
}

/* Usage Indicator */
.usage-indicator {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

.usage-high {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

.usage-medium {
    background: rgba(245, 158, 11, 0.1);
    color: #d97706;
}

.usage-low {
    background: rgba(59, 130, 246, 0.1);
    color: #1d4ed8;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 4px;
}

/* Modal Styling */
.glass-modal {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: var(--shadow-lg);
}

.modal-ribbon {
    position: absolute;
    top: -10px;
    right: 20px;
    background: var(--lab-gradient);
    color: white;
    padding: 8px 20px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    box-shadow: var(--shadow-sm);
    z-index: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 12px;
        padding-right: 12px;
    }

    .action-bar {
        padding: 1rem;
    }

    .btn-glass {
        width: 100%;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    #dataTable thead {
        display: none;
    }

    #dataTable tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: var(--border-radius-sm);
        padding: 1rem;
        position: relative;
    }

    #dataTable tbody td {
        display: block;
        text-align: left;
        padding: 0.5rem 0;
        border: none;
        position: relative;
        padding-left: 40%;
    }

    #dataTable tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 1rem;
        top: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #64748b;
        width: 35%;
    }

    #dataTable tbody td:last-child {
        padding-left: 0;
        text-align: center;
    }

    #dataTable tbody td:last-child::before {
        display: none;
    }

    .py-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .action-buttons {
        justify-content: center;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Action Buttons Container */
.action-buttons-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 1rem;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">

        <div class="container-fluid py-3">
            <!-- Header Section -->
            <div class="glass-header mb-4 fade-in-up">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2 fw-semibold">
                                <i class="ri-user-line me-2"></i>Manajemen Pengguna
                            </h4>
                            <h2 class="mb-1 fw-bold">Kelola Data Pengguna Sistem</h2>
                            <p class="mb-0 opacity-75">Kelola semua pengguna sistem, role, dan status aktif</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-primary bg-opacity-25 d-inline-block rounded-pill px-3 py-1">
                                <i class="ri-group-line me-1"></i>
                                <small id="totalUsers"><?= count($users) ?> Pengguna</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <?php if (isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ri-checkbox-circle-line me-2"></i> <?= $success ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <!-- Search and Filter Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="ri-search-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchInput"
                                    placeholder="Cari Nama/ID user/Email...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterRole">
                                <option value="">Semua Role</option>
                                <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['idtabel'] ?>"><?= htmlspecialchars($role['nama']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 btn-add-user"
                                    <?= (($user['role_id'] ?? 0) != 1) ? 'disabled' : '' ?>>
                                    <i class="ri-user-add-line me-1"></i>Tambah
                                </button>
                                <a href="<?= base_url('users/export') ?>" class="btn btn-outline-primary">
                                    <i class="ri-file-excel-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="loadingIndicator" style="display: none; text-align: center; padding: 10px;">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span class="ms-2">Memfilter data...</span>
            </div>

            <!-- Users Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th width="5%" class="text-center py-3">No</th>
                                    <th width="25%" class="py-3">Pengguna</th>
                                    <th width="15%" class="py-3">ID USER</th>
                                    <th width="20%" class="py-3">Email</th>
                                    <th width="15%" class="py-3">Role</th>
                                    <th width="10%" class="py-3">Status</th>
                                    <th width="10%" class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Info -->
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted" id="counterText">Memuat data...</small>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-secondary" onclick="printTable()">
                                    <i class="ri-printer-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        // Base URL dan CSRF Token
        const baseUrl = '<?= base_url() ?>';
        const csrfToken = '<?= csrf_hash() ?>';
        const csrfName = '<?= csrf_token() ?>';



        // Data dan state
        let allUsersData = <?= json_encode($users) ?>;
        let filteredUsers = [];
        let currentPage = 1;
        const pageSize = 100;
        const currentUserRole = <?= ($user['role_id'] ?? 0) ?>;
        const currentUserId = '<?= $user['id_user'] ?? '' ?>';


        // Tambahkan di document ready:
        $(document).on('click', '.btn-edit-modal', function(e) {
            e.preventDefault();
            const userId = $(this).data('id');
            const userName = $(this).data('nama');
            editUserModal(userId, userName);
        });

        // ==================== ADD USER MODAL ====================
        function showAddUserModal() {
            // Load roles and faculties via AJAX
            showMinimalNotification('Memuat data...', 'info');

            $.ajax({
                url: `${baseUrl}users/get-form-data`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        renderAddUserModal(response.data);
                    } else {
                        showMinimalNotification('Gagal memuat data form', 'error');
                    }
                },
                error: function() {
                    showMinimalNotification('Koneksi gagal', 'error');
                }
            });
        }

        function renderAddUserModal(formData) {
            const html = `
        <div class="add-user-modal">
            <form id="addUserForm" class="needs-validation" novalidate>
                <div class="row g-3">
                    <!-- Nama Lengkap -->
                    <div class="col-12">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               name="nama_lengkap" 
                               placeholder="Masukkan nama lengkap"
                               required>
                        <div class="invalid-feedback">Harap isi nama lengkap</div>
                    </div>
                    
                    <!-- ID User -->
                    <div class="col-md-6">
                        <label class="form-label">ID User <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               name="id_user" 
                               placeholder="Contoh: admin123"
                               required>
                        <div class="invalid-feedback">Harap isi ID User</div>
                        <small class="text-muted">ID unik untuk login</small>
                    </div>
                    
                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               class="form-control" 
                               name="email" 
                               placeholder="contoh@email.com"
                               required>
                        <div class="invalid-feedback">Harap isi email yang valid</div>
                    </div>
                    
                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   id="newPassword"
                                   placeholder="Minimal 6 karakter"
                                   required
                                   minlength="6">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="ri-eye-line"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Password minimal 6 karakter</div>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               class="form-control" 
                               name="confirm_password" 
                               placeholder="Ulangi password"
                               required>
                        <div class="invalid-feedback">Password tidak cocok</div>
                    </div>
                    
                    <!-- Role -->
                    <div class="col-md-6">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="role_id" required>
                            <option value="">Pilih Role</option>
                            ${formData.roles.map(role => `
                                <option value="${role.idtabel}">${escapeHtml(role.nama)}</option>
                            `).join('')}
                        </select>
                        <div class="invalid-feedback">Harap pilih role</div>
                    </div>
                    
                    <!-- Unit/Fakultas -->
                    <div class="col-md-6">
                        <label class="form-label">Unit/Fakultas</label>
                        <select class="form-select" name="kd_unit">
                            <option value="">Pilih Unit (Opsional)</option>
                            ${formData.faculties.map(faculty => `
                                <option value="${faculty.kdfakultas}">${escapeHtml(faculty.nmfakultas)}</option>
                            `).join('')}
                        </select>
                    </div>
                    
                    <!-- SSO Username -->
                    <div class="col-12">
                        <label class="form-label">SSO Username</label>
                        <input type="text" 
                               class="form-control" 
                               name="user_sso" 
                               placeholder="Username SSO (opsional)">
                        <small class="text-muted">Untuk integrasi dengan sistem SSO</small>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_active" 
                                   value="1"
                                   checked>
                            <label class="form-check-label">Aktifkan user setelah dibuat</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    `;

            Swal.fire({
                title: `<div class="d-flex align-items-center">
                    <i class="ri-user-add-line me-2 text-primary"></i>
                    <span>Tambah Pengguna Baru</span>
                </div>`,
                html: html,
                showCancelButton: true,
                confirmButtonText: '<i class="ri-save-line me-1"></i> Simpan',
                cancelButtonText: '<i class="ri-close-line me-1"></i> Batal',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                width: '600px',
                didOpen: () => {
                    // Initialize form validation
                    initAddFormValidation();
                    // Toggle password visibility
                    $('#togglePassword').click(function() {
                        const passwordInput = $('#newPassword');
                        const type = passwordInput.attr('type') === 'password' ? 'text' :
                            'password';
                        passwordInput.attr('type', type);
                        $(this).find('i').toggleClass('ri-eye-line ri-eye-off-line');
                    });
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const form = document.getElementById('addUserForm');
                        if (form.checkValidity()) {
                            // Collect form data
                            const formData = new FormData(form);
                            const data = Object.fromEntries(formData.entries());

                            // Validate password match
                            if (data.password !== data.confirm_password) {
                                Swal.showValidationMessage('Password dan konfirmasi tidak cocok');
                                resolve(false);
                                return;
                            }

                            resolve(data);
                        } else {
                            form.classList.add('was-validated');
                            Swal.showValidationMessage('Harap isi semua field yang wajib');
                            resolve(false);
                        }
                    });
                },
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    submitAddUser(result.value);
                }
            });
        }

        function initAddFormValidation() {
            const form = document.getElementById('addUserForm');

            // Remove previous validation
            form.classList.remove('was-validated');

            // Real-time validation
            form.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });

                // Special validation for password confirm
                if (input.name === 'confirm_password') {
                    input.addEventListener('input', function() {
                        const password = form.querySelector('input[name="password"]').value;
                        const confirm = this.value;

                        if (password && confirm && password !== confirm) {
                            this.setCustomValidity('Password tidak cocok');
                            this.classList.remove('is-valid');
                            this.classList.add('is-invalid');
                        } else {
                            this.setCustomValidity('');
                            if (this.checkValidity()) {
                                this.classList.remove('is-invalid');
                                this.classList.add('is-valid');
                            }
                        }
                    });
                }
            });
        }
        // ==================== SUBMIT ADD USER ====================
        function submitAddUser(formData) {
            // Tambahkan CSRF token
            formData[csrfName] = csrfToken;

            $.ajax({
                url: `${baseUrl}users/ajax-store`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function(xhr) {
                    // Add CSRF token to header (untuk keamanan tambahan)
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Add new user to data arrays
                        addNewUserToData(response.data);
                        // Show success notification
                        showMinimalNotification('✓ Pengguna berhasil ditambahkan');

                        // Close modal and show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            html: `
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="ri-checkbox-circle-line text-success" style="font-size: 3rem;"></i>
                            </div>
                            <p>${response.message}</p>
                            <div class="mt-3 bg-success bg-opacity-10 p-2 rounded">
                                <small class="text-success">
                                    <i class="ri-user-line me-1"></i>
                                    ${escapeHtml(response.data.nama_lengkap)} telah ditambahkan
                                </small>
                            </div>
                        </div>
                    `,
                            showConfirmButton: true,
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#10b981',
                            showCancelButton: true,
                            cancelButtonText: 'Tambah Lagi'
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.cancel) {
                                // User wants to add another
                                showAddUserModal();
                            }
                        });

                    } else {
                        if (response.message === 'CSRF token tidak valid. Silakan refresh halaman.') {
                            // Refresh token dan coba lagi
                            refreshCSRFToken();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Sesi diperbarui',
                                text: 'Silakan coba lagi.',
                                confirmButtonColor: '#f59e0b'
                            }).then(() => {
                                submitAddUser(formData);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.errors ?
                                    `<div class="text-start">
                                <p>${response.message}</p>
                                <ul class="mt-2">
                                    ${Object.values(response.errors).map(err => `<li>${err}</li>`).join('')}
                                </ul>
                            </div>` : response.message,
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Koneksi gagal';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        errorMsg = Object.values(errors).join('<br>');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMsg,
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        }

        function addNewUserToData(newUser) {
            // Add to allUsersData array (at beginning)
            allUsersData.unshift(newUser);

            // Update filtered array if it matches current filter
            const searchTerm = $('#searchInput').val().toLowerCase().trim();
            const filterRole = $('#filterRole').val();
            const filterStatus = $('#filterStatus').val();

            let shouldAddToFiltered = true;

            // Check if new user matches current filters
            if (searchTerm) {
                const searchMatch =
                    (newUser.nama_lengkap?.toLowerCase() || '').includes(searchTerm) ||
                    (newUser.id_user?.toLowerCase() || '').includes(searchTerm) ||
                    (newUser.email?.toLowerCase() || '').includes(searchTerm) ||
                    (newUser.user_sso?.toLowerCase() || '').includes(searchTerm);
                if (!searchMatch) shouldAddToFiltered = false;
            }

            if (filterRole && newUser.role_id != filterRole) {
                shouldAddToFiltered = false;
            }

            if (filterStatus !== '' && String(newUser.is_active) !== filterStatus) {
                shouldAddToFiltered = false;
            }

            if (shouldAddToFiltered) {
                // Add to filtered array at beginning
                filteredUsers.unshift(newUser);

                // Add to table
                addUserToTable(newUser);
            }

            // Update counter
            updateCounter(filteredUsers.length, allUsersData.length);
        }

        function addUserToTable(user) {
            const isActive = parseInt(user.is_active) === 1;
            const rowNumber = 1; // Always first row

            // Role badge
            let roleBadgeClass = 'bg-info bg-opacity-10 text-info';
            if (user.role_id == 1) roleBadgeClass = 'bg-danger bg-opacity-10 text-danger';
            else if (user.role_id == 2) roleBadgeClass = 'bg-warning bg-opacity-10 text-warning';

            // Status badge
            const statusBadgeClass = isActive ?
                'bg-success bg-opacity-10 text-success' :
                'bg-secondary bg-opacity-10 text-secondary';
            const statusText = isActive ? 'Aktif' : 'Nonaktif';

            // Action buttons
            let actionButtons = `
     
        <button class="btn btn-outline-warning btn-sm btn-edit-modal" title="Edit"
            data-id="${user.id_user}"
            data-nama="${escapeHtml(user.nama_lengkap)}"
            ${(currentUserRole == 2 && user.role_id == 1) ? 'disabled' : ''}>
            <i class="ri-edit-line"></i>
        </button>
    `;

            if (isActive) {
                if (currentUserRole == 1 && user.id_user !== currentUserId) {
                    actionButtons += `
                <button class="btn btn-outline-danger btn-sm btn-nonaktif" title="Nonaktifkan"
                    data-id="${user.id_user}"
                    data-nama="${escapeHtml(user.nama_lengkap)}">
                    <i class="ri-user-unfollow-line"></i>
                </button>
            `;
                }
            } else {
                if (currentUserRole == 1) {
                    actionButtons += `
                <button class="btn btn-outline-success btn-sm btn-aktifkan" title="Aktifkan"
                    data-id="${user.id_user}"
                    data-nama="${escapeHtml(user.nama_lengkap)}">
                    <i class="ri-user-follow-line"></i>
                </button>
            `;
                }
            }

            const newRow = `
        <tr class="new-user-row">
            <td class="text-center fw-semibold align-middle">${rowNumber}</td>
            <td class="align-middle">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-2"
                        style="width: 32px; height: 32px;">
                        ${getAvatarHTML(user)}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">${escapeHtml(user.nama_lengkap)}</h6>
                        ${user.user_sso ? `
                            <small class="text-muted">
                                <i class="ri-building-2-line me-1"></i>
                                ${escapeHtml(user.user_sso)}
                            </small>
                        ` : ''}
                    </div>
                </div>
            </td>
            <td class="align-middle">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    ${escapeHtml(user.id_user)}
                </span>
            </td>
            <td class="align-middle">
                <div class="text-truncate" style="max-width: 200px;">
                    ${escapeHtml(user.email)}
                </div>
            </td>
            <td class="align-middle">
                <span class="badge ${roleBadgeClass} px-3 py-2">
                    ${escapeHtml(user.role_name || 'Unknown')}
                </span>
            </td>
            <td class="align-middle">
                <span class="badge ${statusBadgeClass} px-3 py-2">
                    ${statusText}
                </span>
            </td>
            <td class="text-center align-middle">
                <div class="btn-group btn-group-sm" role="group">
                    ${actionButtons}
                </div>
            </td>
        </tr>
    `;

            // Insert at the beginning of table
            const $tableBody = $('#tableBody');
            if ($tableBody.find('tr').length > 0 && !$tableBody.find('tr').first().hasClass('no-data')) {
                $tableBody.prepend(newRow);
            } else {
                $tableBody.html(newRow);
            }

            // Renumber rows
            renumberTableRows();

            // Add highlight animation
            $tableBody.find('tr.new-user-row').addClass('highlight-new');
            setTimeout(() => {
                $tableBody.find('tr.new-user-row').removeClass('highlight-new new-user-row');
            }, 2000);
        }

        function renumberTableRows() {
            $('#tableBody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
        }

        // ==================== UPDATE EVENT HANDLERS ====================
        $(document).ready(function() {
            // Add user button click
            $(document).on('click', '.btn-add-user:not([disabled])', function(e) {
                e.preventDefault();
                showAddUserModal();
            });

            // Disabled button styling
            $(document).on('click', '.btn-add-user[disabled]', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'Hanya admin yang dapat menambahkan pengguna baru.',
                    confirmButtonColor: '#f59e0b'
                });
            });
        });

        // ==================== UTILITY FUNCTIONS ====================
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function getAvatarHTML(user) {
            if (user.image && user.image !== 'default-avatar.png') {
                return `<img src="${baseUrl}assets/images/users/${user.image}" 
                alt="${escapeHtml(user.nama_lengkap)}"
                class="rounded-circle" width="32" height="32"
                onerror="this.onerror=null; this.parentElement.innerHTML='<i class=&quot;ri-user-line&quot;></i>';">`;
            }
            return '<i class="ri-user-line"></i>';
        }

        function updateCounter(filteredCount, totalCount) {
            $('#counterText').text(`Menampilkan ${filteredCount} dari ${totalCount} pengguna`);
            $('#totalUsers').text(`${totalCount} Pengguna`);
        }

        // ==================== MINIMAL NOTIFICATION ====================
        function showMinimalNotification(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }

        // ==================== ACTION FUNCTIONS ====================
        function deactivateUser(userId, userName) {
            Swal.fire({
                title: 'Nonaktifkan?',
                html: `<div class="text-center py-2">${escapeHtml(userName)}</div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Nonaktifkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${baseUrl}users/deactivate/${userId}`,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: () => {
                            // Show minimal loading
                            showMinimalNotification('Memproses...', 'info');
                        },
                        success: (response) => {
                            if (response.status === 'success') {
                                // Update UI tanpa refresh
                                updateUserStatus(userId, 0, userName);
                                // Minimal notification
                                showMinimalNotification('✓ Pengguna dinonaktifkan');
                            } else {
                                showMinimalNotification(response.message || 'Gagal', 'error');
                            }
                        },
                        error: () => {
                            showMinimalNotification('Koneksi gagal', 'error');
                        }
                    });
                }
            });
        }

        function activateUser(userId, userName) {
            Swal.fire({
                title: 'Aktifkan?',
                html: `<div class="text-center py-2">${escapeHtml(userName)}</div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktifkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${baseUrl}users/activate/${userId}`,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: () => {
                            showMinimalNotification('Memproses...', 'info');
                        },
                        success: (response) => {
                            if (response.status === 'success') {
                                updateUserStatus(userId, 1, userName);
                                showMinimalNotification('✓ Pengguna diaktifkan');
                            } else {
                                showMinimalNotification(response.message || 'Gagal', 'error');
                            }
                        },
                        error: () => {
                            showMinimalNotification('Koneksi gagal', 'error');
                        }
                    });
                }
            });
        }

        // ==================== AUTO UPDATE UI ====================
        function updateUserStatus(userId, newStatus, userName) {
            // Update data in memory
            updateInMemoryData(userId, newStatus);

            // Update table UI
            updateTableUI(userId, newStatus, userName);

            // Update counter jika perlu
            updateCounter(filteredUsers.length, allUsersData.length);
        }

        function updateInMemoryData(userId, newStatus) {
            // Update allUsersData
            const allIndex = allUsersData.findIndex(u => u.id_user === userId);
            if (allIndex !== -1) {
                allUsersData[allIndex].is_active = newStatus;
            }

            // Update filteredUsers
            const filteredIndex = filteredUsers.findIndex(u => u.id_user === userId);
            if (filteredIndex !== -1) {
                filteredUsers[filteredIndex].is_active = newStatus;
            }
        }

        function updateTableUI(userId, newStatus, userName) {
            const rows = $('#tableBody tr');
            let rowUpdated = false;

            rows.each(function() {
                const btn = $(this).find('.btn-nonaktif, .btn-aktifkan');
                if (btn.length && btn.data('id') === userId) {
                    updateSingleRow($(this), userId, newStatus, userName);
                    rowUpdated = true;
                    return false; // break loop
                }
            });

            // Jika row tidak ditemukan (karena filter), refresh seluruh tabel
            if (!rowUpdated) {
                filterAndRenderData();
            }
        }

        function updateSingleRow(row, userId, newStatus, userName) {
            const isActive = newStatus == 1;
            const user = allUsersData.find(u => u.id_user === userId);
            if (!user) return;

            // 1. Update status badge
            const statusBadgeClass = isActive ?
                'bg-success bg-opacity-10 text-success' :
                'bg-secondary bg-opacity-10 text-secondary';
            const statusText = isActive ? 'Aktif' : 'Nonaktif';

            row.find('td:nth-child(6)').html(`
        <span class="badge ${statusBadgeClass} px-3 py-2">
            ${statusText}
        </span>
    `);

            // 2. Update action buttons
            let actionButtons = `
      
        </a>
       <button class="btn btn-outline-warning btn-sm btn-edit-modal" title="Edit"
        data-id="${user.id_user}"
        data-nama="${escapeHtml(user.nama_lengkap)}"
        ${(currentUserRole == 2 && user.role_id == 1) ? 'disabled' : ''}>
        <i class="ri-edit-line"></i>
    </button>
    `;

            if (isActive) {
                if (currentUserRole == 1 && userId !== currentUserId) {
                    actionButtons += `
                <button class="btn btn-outline-danger btn-sm btn-nonaktif" title="Nonaktifkan"
                    data-id="${userId}"
                    data-nama="${escapeHtml(userName)}">
                    <i class="ri-user-unfollow-line"></i>
                </button>
            `;
                }
            } else {
                if (currentUserRole == 1) {
                    actionButtons += `
                <button class="btn btn-outline-success btn-sm btn-aktifkan" title="Aktifkan"
                    data-id="${userId}"
                    data-nama="${escapeHtml(userName)}">
                    <i class="ri-user-follow-line"></i>
                </button>
            `;
                }
            }

            row.find('td:nth-child(7)').html(`
        <div class="btn-group btn-group-sm" role="group">
            ${actionButtons}
        </div>
    `);

            // 3. Highlight animation
            row.addClass('row-updated');
            setTimeout(() => row.removeClass('row-updated'), 1000);
        }

        // ==================== TABLE FUNCTIONS ====================
        function filterAndRenderData() {
            const searchTerm = $('#searchInput').val().toLowerCase().trim();
            const filterRole = $('#filterRole').val();
            const filterStatus = $('#filterStatus').val();

            filteredUsers = allUsersData.filter(user => {
                let match = true;

                if (searchTerm) {
                    const searchMatch =
                        (user.nama_lengkap?.toLowerCase() || '').includes(searchTerm) ||
                        (user.id_user?.toLowerCase() || '').includes(searchTerm) ||
                        (user.email?.toLowerCase() || '').includes(searchTerm) ||
                        (user.user_sso?.toLowerCase() || '').includes(searchTerm);
                    if (!searchMatch) match = false;
                }

                if (filterRole && user.role_id != filterRole) {
                    match = false;
                }

                if (filterStatus !== '' && String(user.is_active) !== filterStatus) {
                    match = false;
                }

                return match;
            });

            currentPage = 1;
            renderTable(filteredUsers.slice(0, pageSize), false);
            updateCounter(filteredUsers.length, allUsersData.length);
        }

        function renderTable(users, append = false) {
            if (!append) {
                $('#tableBody').empty();
            }

            if (users.length === 0) {
                $('#tableBody').html(`
            <tr>
                <td colspan="7" class="text-center py-5">
                    <i class="ri-search-line fs-1 text-muted opacity-50 d-block mb-2"></i>
                    <span class="text-muted">Tidak ada hasil ditemukan</span>
                </td>
            </tr>
        `);
                return;
            }

            const startIndex = (currentPage - 1) * pageSize;
            const tableRows = users.map((user, index) => {
                const rowNumber = startIndex + index + 1;
                const isActive = parseInt(user.is_active) === 1;

                // Role badge
                let roleBadgeClass = 'bg-info bg-opacity-10 text-info';
                if (user.role_id == 1) roleBadgeClass = 'bg-danger bg-opacity-10 text-danger';
                else if (user.role_id == 2) roleBadgeClass = 'bg-warning bg-opacity-10 text-warning';

                // Status badge
                const statusBadgeClass = isActive ?
                    'bg-success bg-opacity-10 text-success' :
                    'bg-secondary bg-opacity-10 text-secondary';
                const statusText = isActive ? 'Aktif' : 'Nonaktif';

                // Action buttons
                let actionButtons = `
          
           <button class="btn btn-outline-warning btn-sm btn-edit-modal" title="Edit"
        data-id="${user.id_user}"
        data-nama="${escapeHtml(user.nama_lengkap)}"
        ${(currentUserRole == 2 && user.role_id == 1) ? 'disabled' : ''}>
        <i class="ri-edit-line"></i>
    </button>
        `;

                if (isActive) {
                    if (currentUserRole == 1 && user.id_user !== currentUserId) {
                        actionButtons += `
                    <button class="btn btn-outline-danger btn-sm btn-nonaktif" title="Nonaktifkan"
                        data-id="${user.id_user}"
                        data-nama="${escapeHtml(user.nama_lengkap)}">
                        <i class="ri-user-unfollow-line"></i>
                    </button>
                `;
                    }
                } else {
                    if (currentUserRole == 1) {
                        actionButtons += `
                    <button class="btn btn-outline-success btn-sm btn-aktifkan" title="Aktifkan"
                        data-id="${user.id_user}"
                        data-nama="${escapeHtml(user.nama_lengkap)}">
                        <i class="ri-user-follow-line"></i>
                    </button>
                `;
                    }
                }

                return `
            <tr>
                <td class="text-center fw-semibold align-middle">${rowNumber}</td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width: 32px; height: 32px;">
                            ${getAvatarHTML(user)}
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">${escapeHtml(user.nama_lengkap)}</h6>
                            ${user.user_sso ? `
                                <small class="text-muted">
                                    <i class="ri-building-2-line me-1"></i>
                                    ${escapeHtml(user.user_sso)}
                                </small>
                            ` : ''}
                        </div>
                    </div>
                </td>
                <td class="align-middle">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                        ${escapeHtml(user.id_user)}
                    </span>
                </td>
                <td class="align-middle">
                    <div class="text-truncate" style="max-width: 200px;">
                        ${escapeHtml(user.email)}
                    </div>
                </td>
                <td class="align-middle">
                    <span class="badge ${roleBadgeClass} px-3 py-2">
                        ${escapeHtml(user.role_name || 'Unknown')}
                    </span>
                </td>
                <td class="align-middle">
                    <span class="badge ${statusBadgeClass} px-3 py-2">
                        ${statusText}
                    </span>
                </td>
                <td class="text-center align-middle">
                    <div class="btn-group btn-group-sm" role="group">
                        ${actionButtons}
                    </div>
                </td>
            </tr>
        `;
            }).join('');

            if (append) {
                $('#tableBody').append(tableRows);
            } else {
                $('#tableBody').html(tableRows);
            }
        }


        // ==================== EDIT USER MODAL ====================
        function editUserModal(userId, userName) {
            // Show loading first
            showMinimalNotification('Memuat data...', 'info');

            // Load user data via AJAX
            $.ajax({
                url: `${baseUrl}users/get-edit-data/${userId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showEditModal(response.data);
                    } else {
                        showMinimalNotification('Gagal memuat data', 'error');
                    }
                },
                error: function() {
                    showMinimalNotification('Koneksi gagal', 'error');
                }
            });
        }

        function showEditModal(userData) {
            const html = `
        <div class="edit-user-modal">
            <form id="editUserForm" class="needs-validation" novalidate>
                <div class="row g-3">
                    <!-- Nama Lengkap -->
                    <div class="col-12">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               name="nama_lengkap" 
                               value="${escapeHtml(userData.nama_lengkap || '')}"
                               required>
                        <div class="invalid-feedback">Harap isi nama lengkap</div>
                    </div>
                    
                    <!-- ID User -->
                    <div class="col-md-6">
                        <label class="form-label">ID User <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               name="id_user" 
                               value="${escapeHtml(userData.id_user || '')}"
                               required>
                        <div class="invalid-feedback">Harap isi ID User</div>
                    </div>
                    
                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               class="form-control" 
                               name="email" 
                               value="${escapeHtml(userData.email || '')}"
                               required>
                        <div class="invalid-feedback">Harap isi email yang valid</div>
                    </div>
                    
                    <!-- Role -->
                    <div class="col-md-6">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="role_id" required>
                            <option value="">Pilih Role</option>
                            ${userData.roles.map(role => `
                                <option value="${role.idtabel}" ${userData.role_id == role.idtabel ? 'selected' : ''}>
                                    ${escapeHtml(role.nama)}
                                </option>
                            `).join('')}
                        </select>
                        <div class="invalid-feedback">Harap pilih role</div>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_active" 
                                   ${userData.is_active == 1 ? 'checked' : ''}
                                   value="1">
                            <label class="form-check-label">Aktif</label>
                        </div>
                    </div>
                    
                    <!-- SSO Username -->
                    <div class="col-12">
                        <label class="form-label">SSO Username</label>
                        <input type="text" 
                               class="form-control" 
                               name="user_sso" 
                               value="${escapeHtml(userData.user_sso || '')}"
                               placeholder="Opsional">
                    </div>
                    
                    <!-- Password (opsional) -->
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-body py-2">
                                <label class="form-label mb-1">Reset Password</label>
                                <small class="text-muted d-block mb-2">Kosongkan jika tidak ingin mengubah password</small>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <input type="password" 
                                               class="form-control form-control-sm" 
                                               name="password" 
                                               placeholder="Password baru"
                                               autocomplete="new-password">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" 
                                               class="form-control form-control-sm" 
                                               name="confirm_password" 
                                               placeholder="Konfirmasi password"
                                               autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="user_id" value="${userData.id_user}">
            </form>
        </div>
    `;

            Swal.fire({
                title: `<div class="d-flex align-items-center">
                    <i class="ri-edit-line me-2 text-primary"></i>
                    <span>Edit Pengguna</span>
                </div>`,
                html: html,
                showCancelButton: true,
                confirmButtonText: '<i class="ri-save-line me-1"></i> Simpan',
                cancelButtonText: '<i class="ri-close-line me-1"></i> Batal',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                width: '600px',
                didOpen: () => {
                    // Initialize form validation
                    initEditFormValidation();
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const form = document.getElementById('editUserForm');
                        if (form.checkValidity()) {
                            // Collect form data
                            const formData = new FormData(form);
                            const data = Object.fromEntries(formData.entries());

                            // Validate password if filled
                            if (data.password && data.password !== data.confirm_password) {
                                Swal.showValidationMessage(
                                    'Password dan konfirmasi tidak cocok');
                                resolve(false);
                                return;
                            }

                            resolve(data);
                        } else {
                            form.classList.add('was-validated');
                            Swal.showValidationMessage('Harap isi semua field yang wajib');
                            resolve(false);
                        }
                    });
                },
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    submitEditUser(result.value);
                }
            });
        }

        function initEditFormValidation() {
            const form = document.getElementById('editUserForm');

            // Remove previous validation
            form.classList.remove('was-validated');

            // Real-time validation
            form.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });
            });
        }

        function submitEditUser(formData) {
            // Tambahkan CSRF token ke form data
            formData[csrfName] = csrfToken;

            $.ajax({
                url: `${baseUrl}users/ajax-update`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function(xhr) {
                    // Add CSRF token header
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Update local data
                        updateUserAfterEdit(response.data);
                        // Show success notification
                        showMinimalNotification('✓ Data berhasil disimpan');

                        // Close modal and show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: response.errors ?
                                `<div class="text-start">
                            <p>${response.message}</p>
                            <ul class="mt-2">
                                ${Object.values(response.errors).map(err => `<li>${err}</li>`).join('')}
                            </ul>
                        </div>` : response.message,
                            confirmButtonColor: '#ef4444'
                        });
                    }
                },
                error: function(xhr) {
                    // Tangani error CSRF
                    if (xhr.status === 403 && xhr.responseJSON &&
                        xhr.responseJSON.message === 'The action you requested is not allowed.') {
                        // CSRF token invalid
                        showMinimalNotification('Sesi telah berakhir. Silakan refresh halaman.', 'error');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        let errorMsg = 'Koneksi gagal';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            errorMsg = Object.values(errors).join('<br>');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMsg,
                            confirmButtonColor: '#ef4444'
                        });
                    }
                }
            });
        }

        function updateUserAfterEdit(updatedUser) {
            // Update in memory arrays
            const userIndex = allUsersData.findIndex(u => u.id_user === updatedUser.id_user);
            if (userIndex !== -1) {
                // Merge updated data
                allUsersData[userIndex] = {
                    ...allUsersData[userIndex],
                    ...updatedUser
                };
            }

            // Update filtered array
            const filteredIndex = filteredUsers.findIndex(u => u.id_user === updatedUser.id_user);
            if (filteredIndex !== -1) {
                filteredUsers[filteredIndex] = {
                    ...filteredUsers[filteredIndex],
                    ...updatedUser
                };
            }

            // Find and update table row
            const rows = $('#tableBody tr');
            rows.each(function() {
                const btn = $(this).find('.btn-edit-modal');
                if (btn.length && btn.data('id') === updatedUser.id_user) {
                    updateTableRowAfterEdit($(this), updatedUser);
                    return false;
                }
            });
        }

        function updateTableRowAfterEdit(row, user) {
            const isActive = parseInt(user.is_active) === 1;

            // Update name
            row.find('td:nth-child(2) h6').text(user.nama_lengkap);

            // Update email
            row.find('td:nth-child(4) div').text(user.email);

            // Update role badge
            let roleBadgeClass = 'bg-info bg-opacity-10 text-info';
            if (user.role_id == 1) roleBadgeClass = 'bg-danger bg-opacity-10 text-danger';
            else if (user.role_id == 2) roleBadgeClass = 'bg-warning bg-opacity-10 text-warning';

            row.find('td:nth-child(5) span').removeClass().addClass(`badge ${roleBadgeClass} px-3 py-2`);
            row.find('td:nth-child(5) span').text(user.role_name || 'Unknown');

            // Update status badge
            const statusBadgeClass = isActive ?
                'bg-success bg-opacity-10 text-success' :
                'bg-secondary bg-opacity-10 text-secondary';
            const statusText = isActive ? 'Aktif' : 'Nonaktif';

            row.find('td:nth-child(6) span').removeClass().addClass(`badge ${statusBadgeClass} px-3 py-2`);
            row.find('td:nth-child(6) span').text(statusText);

            // Update action buttons name data
            row.find('.btn-nonaktif, .btn-aktifkan, .btn-edit-modal')
                .data('nama', user.nama_lengkap);

            // Highlight animation
            row.addClass('row-updated');
            setTimeout(() => row.removeClass('row-updated'), 1000);
        }

        // ==================== UPDATE EVENT HANDLERS ====================
        $(document).ready(function() {
            // Ganti tombol edit dengan modal
            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Get user data
                const userId = $(this).attr('href').split('/').pop();
                const userName = $(this).closest('tr').find('h6').text();

                // Replace with modal edit
                editUserModal(userId, userName);
            });

            // Atau jika menggunakan data attributes
            $(document).on('click', '[data-edit]', function(e) {
                e.preventDefault();
                const userId = $(this).data('edit');
                const userName = $(this).data('nama');
                editUserModal(userId, userName);
            });
        });


        // ==================== INITIALIZATION ====================
        $(document).ready(function() {
            // Initial render
            renderTable(allUsersData.slice(0, pageSize));
            updateCounter(allUsersData.length, allUsersData.length);

            // Event delegation
            $(document).on('click', '.btn-nonaktif', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const userName = $(this).data('nama');
                deactivateUser(userId, userName);
            });

            $(document).on('click', '.btn-aktifkan', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const userName = $(this).data('nama');
                activateUser(userId, userName);
            });

            // Search with debounce
            let searchTimeout;
            $('#searchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterAndRenderData();
                }, 300);
            });

            // Filter changes
            $('#filterRole, #filterStatus').on('change', function() {
                filterAndRenderData();
            });

            // Session messages
            <?php if (session()->getFlashdata('success')): ?>
            setTimeout(() => {
                showMinimalNotification('<?= session()->getFlashdata('success') ?>');
            }, 500);
            <?php endif; ?>
        });
        </script>

        <style>
        .swal2-toast {
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }



        /* White text untuk semua */
        .swal2-toast .swal2-title {
            color: white !important;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }

        /* Progress bar putih */
        .swal2-toast .swal2-timer-progress-bar {
            background: rgba(255, 255, 255, 0.5) !important;
        }

        /* Icon putih */
        .swal2-toast .swal2-icon {
            color: white !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
        }



        /* Row update animation */
        @keyframes subtleHighlight {
            0% {
                background-color: rgba(16, 185, 129, 0.1);
            }

            100% {
                background-color: transparent;
            }
        }

        .row-updated {
            animation: subtleHighlight 1s ease-out;
        }

        /* Button hover effects */
        .btn-group .btn-sm {
            transition: all 0.2s ease;
        }

        .btn-group .btn-sm:hover {
            transform: translateY(-1px);
        }

        /* SweetAlert modal */
        .swal2-popup {
            padding: 1.5rem;
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .swal2-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .swal2-html-container {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .swal2-confirm,
        .swal2-cancel {
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
        }

        .swal2-confirm {
            background: #10b981 !important;
        }

        .swal2-confirm:hover {
            background: #059669 !important;
        }

        .swal2-cancel {
            background: #6b7280 !important;
        }

        .swal2-cancel:hover {
            background: #4b5563 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .swal2-toast {
                width: auto;
                min-width: 280px;
                max-width: 90%;
                margin: 0.5rem;
            }
        }
        </style>

        <style>
        /* Edit Modal Styling */
        .edit-user-modal {
            max-height: 70vh;
            overflow-y: auto;
            padding-right: 5px;
        }

        .edit-user-modal .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .edit-user-modal .form-control,
        .edit-user-modal .form-select {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 0.875rem;
        }

        .edit-user-modal .form-control:focus,
        .edit-user-modal .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .edit-user-modal .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
        }

        .edit-user-modal .card {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
        }

        .edit-user-modal .invalid-feedback {
            font-size: 0.75rem;
        }

        /* Scrollbar for modal */
        .edit-user-modal::-webkit-scrollbar {
            width: 6px;
        }

        .edit-user-modal::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .edit-user-modal::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .edit-user-modal::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* SweetAlert modal sizing */
        .swal2-popup.swal2-modal {
            max-width: 600px;
            width: 90% !important;
        }
        </style>

    </div>
</div>
</div>





<!-- END layout-wrapper -->