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


        <div class="container-fluid py-4">
            <!-- Header Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2 fw-semibold">
                                <i class="ri-car-line me-2 text-primary"></i>Manajemen Kendaraan
                            </h4>
                            <h2 class="mb-1 fw-bold">Kelola Data Kendaraan</h2>
                            <p class="mb-0 text-muted">Kelola semua data kendaraan, jenis, status, dan harga</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-primary bg-opacity-10 d-inline-block rounded-pill px-3 py-1">
                                <i class="ri-car-line me-1 text-primary"></i>
                                <small id="totalKendaraan"><?= count($kendaraan) ?> Kendaraan</small>
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

            <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ri-error-warning-line me-2"></i> <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <!-- Search and Filter Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="ri-search-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchInput"
                                    placeholder="Cari nama/no plat...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="filterJenis">
                                <option value="">Semua Jenis</option>
                                <?php foreach ($jenis_kendaraan as $jenis): ?>
                                <option value="<?= $jenis['idtabel'] ?>"><?= htmlspecialchars($jenis['nama']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <?php foreach ($status_kendaraan as $status): ?>
                                <option value="<?= $status['idtabel'] ?>"><?= htmlspecialchars($status['nama']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 btn-add-kendaraan"
                                    <?= (($user['role_id'] ?? 0) != 1) ? 'disabled' : '' ?>>
                                    <i class="ri-add-line me-1"></i>Tambah Kendaraan
                                </button>
                                <a href="<?= base_url('kendaraan/export') ?>" class="btn btn-outline-primary">
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

            <!-- Kendaraan Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th width="5%" class="text-center py-3">No</th>
                                    <th width="25%" class="py-3">Kendaraan</th>
                                    <th width="15%" class="py-3">No Plat</th>
                                    <th width="10%" class="py-3">Jenis</th>
                                    <th width="10%" class="py-3">Status</th>
                                    <th width="12%" class="py-3">Harga/Jam</th>
                                    <th width="12%" class="py-3">Harga/Hari</th>
                                    <th width="11%" class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php if (empty($kendaraan)): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="ri-car-line fs-1 text-muted opacity-50 d-block mb-2"></i>
                                        <span class="text-muted">Belum ada data kendaraan</span>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <?php
                                    // URL untuk mengakses gambar melalui route
                                        $imageBaseUrl = base_url('kendaraan/image/');
                                    foreach ($kendaraan as $index => $k):
                                        $fotoName = $k['foto'] ?? 'default-car.png';
                                        $fotoUrl = $imageBaseUrl . $fotoName;


                                        ?>
                                <tr data-id="<?= $k['idtabel'] ?>">
                                    <td class="text-center fw-semibold align-middle"><?= $index + 1 ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="<?= $fotoUrl ?>" alt="<?= htmlspecialchars($k['nama']) ?>"
                                                    class="rounded"
                                                    style="width: 60px; height: 40px; object-fit: cover;"
                                                    onerror="this.onerror=null; this.src='<?= $imageBaseUrl ?>default-car.png'">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-semibold"><?= htmlspecialchars($k['nama']) ?></h6>
                                                <small class="text-muted">
                                                    <i class="ri-time-line me-1"></i>
                                                    <?= date('d/m/Y', strtotime($k['created_at'])) ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-dark bg-opacity-10 text-dark px-3 py-2">
                                            <?= htmlspecialchars($k['no_plat'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                            <?= htmlspecialchars($k['jenis_kendaraan'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <?php
                                                $statusClass = 'bg-secondary bg-opacity-10 text-secondary';
                                        if ($k['status_kendaraan'] == 'Tersedia') {
                                            $statusClass = 'bg-success bg-opacity-10 text-success';
                                        }
                                        if ($k['status_kendaraan'] == 'Disewa') {
                                            $statusClass = 'bg-warning bg-opacity-10 text-warning';
                                        }
                                        if ($k['status_kendaraan'] == 'Rusak') {
                                            $statusClass = 'bg-danger bg-opacity-10 text-danger';
                                        }
                                        ?>
                                        <span class="badge <?= $statusClass ?> px-3 py-2">
                                            <?= htmlspecialchars($k['status_kendaraan'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-semibold text-primary">
                                            Rp <?= number_format($k['harga_perjam'], 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-semibold text-primary">
                                            Rp <?= number_format($k['harga_perhari'], 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-sm" role="group">

                                            <button class="btn btn-outline-warning btn-sm btn-edit" title="Edit"
                                                data-id="<?= $k['idtabel'] ?>"
                                                data-nama="<?= htmlspecialchars($k['nama']) ?>"
                                                <?= (($user['role_id'] ?? 0) != 1) ? 'disabled' : '' ?>>
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus"
                                                data-id="<?= $k['idtabel'] ?>"
                                                data-nama="<?= htmlspecialchars($k['nama']) ?>"
                                                <?= (($user['role_id'] ?? 0) != 1) ? 'disabled' : '' ?>>
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Info -->
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted" id="counterText">Menampilkan <?= count($kendaraan) ?>
                                kendaraan</small>
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

        const imageBaseUrl = '<?= base_url('kendaraan/image/') ?>';

        // Data dan state
        let allKendaraanData = <?= json_encode($kendaraan) ?>;
        let filteredKendaraan = [];
        let currentUserRole = <?= ($user['role_id'] ?? 0) ?>;
        let currentFilePreview = null;


        // ==================== ADD KENDARAAN MODAL ====================
        function showAddKendaraanModal() {
            showMinimalNotification('Memuat data...', 'info');

            $.ajax({
                url: `${baseUrl}kendaraan/get-form-data`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        renderAddKendaraanModal(response.data);
                    } else {
                        showMinimalNotification('Gagal memuat data form', 'error');
                    }
                },
                error: function() {
                    showMinimalNotification('Koneksi gagal', 'error');
                }
            });
        }


        function renderAddKendaraanModal(formData) {
            const html = `
    <div class="add-kendaraan-modal">
        <form id="addKendaraanForm" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="row g-3">
                <!-- Foto Kendaraan -->
                <div class="col-12">
                    <label class="form-label">Foto Kendaraan</label>
                    <div class="text-center mb-3">
                        <div class="position-relative d-inline-block">
                          <img id="fotoPreview" src="${imageBaseUrl}default-car.png" 
                                 class="rounded border" 
                                 style="width: 200px; height: 120px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('fotoInput').click()">
                            <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1 m-1" 
                                 style="cursor: pointer;"
                                 onclick="document.getElementById('fotoInput').click()">
                                <i class="ri-camera-line text-white" style="font-size: 12px;"></i>
                            </div>
                        </div>
                        <input type="file" 
                               class="form-control d-none" 
                               id="fotoInput" 
                               name="foto" 
                               accept="image/*"
                               onchange="previewImage(this, 'fotoPreview')">
                        <div class="mt-2">
                            <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG</small>
                        </div>
                    </div>
                </div>
                
                <!-- Nama Kendaraan -->
                <div class="col-12">
                    <label class="form-label">Nama Kendaraan <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           name="nama" 
                           placeholder="Contoh: Toyota Avanza"
                           required>
                    <div class="invalid-feedback">Harap isi nama kendaraan</div>
                </div>
                
                <!-- No Plat -->
                <div class="col-12">
                    <label class="form-label">No Plat <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           name="no_plat" 
                           placeholder="Contoh: P 1234 HI"
                           required>
                    <div class="invalid-feedback">Harap isi nomor plat</div>
                </div>
                
                <!-- Jenis Kendaraan -->
                <div class="col-md-6">
                    <label class="form-label">Jenis Kendaraan <span class="text-danger">*</span></label>
                    <select class="form-select" name="idjenis_kendaraan" required>
                        <option value="">Pilih Jenis</option>
                        ${formData.jenis_kendaraan.map(jenis => `
                            <option value="${jenis.idtabel}">${escapeHtml(jenis.nama)}</option>
                        `).join('')}
                    </select>
                    <div class="invalid-feedback">Harap pilih jenis kendaraan</div>
                </div>
                
                <!-- Status Kendaraan -->
                <div class="col-md-6">
                    <label class="form-label">Status Kendaraan <span class="text-danger">*</span></label>
                    <select class="form-select" name="idstatus_kendaraan" required>
                        <option value="">Pilih Status</option>
                        ${formData.status_kendaraan.map(status => `
                            <option value="${status.idtabel}">${escapeHtml(status.nama)}</option>
                        `).join('')}
                    </select>
                    <div class="invalid-feedback">Harap pilih status kendaraan</div>
                </div>
                
                <!-- Harga Per Jam -->
                <div class="col-md-6">
                    <label class="form-label">Harga Per Jam <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" 
                               class="form-control" 
                               name="harga_perjam" 
                               placeholder="0"
                               min="1000"
                               required>
                    </div>
                    <div class="invalid-feedback">Harap isi harga per jam</div>
                </div>
                
                <!-- Harga Per Hari -->
                <div class="col-md-6">
                    <label class="form-label">Harga Per Hari <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" 
                               class="form-control" 
                               name="harga_perhari" 
                               placeholder="0"
                               min="1000"
                               required>
                    </div>
                    <div class="invalid-feedback">Harap isi harga per hari</div>
                </div>
            </div>
        </form>
    </div>
    `;

            Swal.fire({
                title: `<div class="d-flex align-items-center">
            <i class="ri-add-line me-2 text-primary"></i>
            <span>Tambah Kendaraan Baru</span>
        </div>`,
                html: html,
                showCancelButton: true,
                confirmButtonText: '<i class="ri-save-line me-1"></i> Simpan',
                cancelButtonText: '<i class="ri-close-line me-1"></i> Batal',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                width: '500px',
                didOpen: () => {
                    initAddFormValidation();
                    currentFilePreview = null;
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const form = document.getElementById('addKendaraanForm');
                        if (form.checkValidity()) {
                            const formData = new FormData(form);
                            const data = Object.fromEntries(formData.entries());

                            // Convert to number
                            data.harga_perjam = parseInt(data.harga_perjam);
                            data.harga_perhari = parseInt(data.harga_perhari);

                            // Validate harga
                            if (data.harga_perjam < 1000 || data.harga_perhari < 1000) {
                                Swal.showValidationMessage('Harga minimal Rp 1.000');
                                resolve(false);
                                return;
                            }

                            // Add file if exists
                            const fileInput = document.getElementById('fotoInput');
                            if (fileInput.files.length > 0) {
                                formData.append('foto', fileInput.files[0]);
                            }

                            resolve(formData);
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
                    submitAddKendaraan(result.value);
                }
            });
        }

        function initAddFormValidation() {
            const form = document.getElementById('addKendaraanForm');
            form.classList.remove('was-validated');

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


        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                // Validasi ukuran file
                if (file.size > 2 * 1024 * 1024) {
                    showMinimalNotification('Ukuran file maksimal 2MB', 'error');
                    input.value = '';
                    preview.src = imageBaseUrl + 'default-car.png'; // PERBAIKAN DI SINI
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    showMinimalNotification('Format file harus JPG, JPEG, atau PNG', 'error');
                    input.value = '';
                    preview.src = imageBaseUrl + 'default-car.png'; // PERBAIKAN DI SINI
                    return;
                }

                // Preview local file
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = imageBaseUrl + 'default-car.png'; // PERBAIKAN DI SINI
            }
        }

        function submitAddKendaraan(formData) {
            // Tambahkan CSRF token ke FormData
            formData.append(csrfName, csrfToken);

            // Debug: Lihat isi FormData
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: `${baseUrl}kendaraan/ajax-store`,
                type: 'POST',
                data: formData,
                processData: false, // Penting: jangan proses data
                contentType: false, // Penting: jangan set content type
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                },
                success: function(response) {
                    if (response.status === 'success') {
                        addNewKendaraanToData(response.data);
                        showMinimalNotification('✓ Kendaraan berhasil ditambahkan');

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
                                    <i class="ri-car-line me-1"></i>
                                    ${escapeHtml(response.data.nama)} telah ditambahkan
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
                                showAddKendaraanModal();
                            }
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
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Response:', xhr.responseText);

                    if (xhr.status === 403) {
                        showMinimalNotification('Sesi telah berakhir. Silakan refresh halaman.', 'error');
                        setTimeout(() => window.location.reload(), 2000);
                    } else if (xhr.status === 413) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file melebihi batas maksimal 2MB.',
                            confirmButtonColor: '#ef4444'
                        });
                    } else {
                        let errorMsg = 'Koneksi gagal';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).join('<br>');
                        } else if (xhr.responseText) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                if (response.errors) {
                                    errorMsg = Object.values(response.errors).join('<br>');
                                } else if (response.message) {
                                    errorMsg = response.message;
                                }
                            } catch (e) {
                                errorMsg = xhr.responseText.substring(0, 100);
                            }
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


        function addNewKendaraanToData(newKendaraan) {
            allKendaraanData.unshift(newKendaraan);

            const searchTerm = $('#searchInput').val().toLowerCase().trim();
            const filterJenis = $('#filterJenis').val();
            const filterStatus = $('#filterStatus').val();

            let shouldAddToFiltered = true;

            if (searchTerm) {
                const namaMatch = newKendaraan.nama.toLowerCase().includes(searchTerm);
                const platMatch = newKendaraan.no_plat.toLowerCase().includes(searchTerm);

                // Kendaraan hanya akan ditampilkan jika cocok dengan nama ATAU no_plat
                if (!namaMatch && !platMatch) {
                    shouldAddToFiltered = false;
                }
            }


            if (filterJenis && newKendaraan.idjenis_kendaraan != filterJenis) {
                shouldAddToFiltered = false;
            }

            if (filterStatus && newKendaraan.idstatus_kendaraan != filterStatus) {
                shouldAddToFiltered = false;
            }

            if (shouldAddToFiltered) {
                filteredKendaraan.unshift(newKendaraan);
                addKendaraanToTable(newKendaraan);
            }

            updateCounter(filteredKendaraan.length, allKendaraanData.length);
        }



        function addKendaraanToTable(kendaraan) {
            const statusClass = getStatusClass(kendaraan.status_kendaraan);
            const fotoName = kendaraan.foto || 'default-car.png';
            const fotoUrl = `${imageBaseUrl}${fotoName}`;

            const newRow = `
        <tr class="new-kendaraan-row" data-id="${kendaraan.idtabel}">
            <td class="text-center fw-semibold align-middle">1</td>
            <td class="align-middle">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <img src="${fotoUrl}" 
                             alt="${escapeHtml(kendaraan.nama)}"
                             class="rounded"
                             style="width: 60px; height: 40px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='${imageBaseUrl}default-car.png'">
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-semibold">${escapeHtml(kendaraan.nama)}</h6>
                        <small class="text-muted">
                            <i class="ri-time-line me-1"></i>
                            ${formatDate(kendaraan.created_at)}
                        </small>
                    </div>
                </div>
            </td>
            <td class="align-middle">
                <span class="badge bg-dark bg-opacity-10 text-dark px-3 py-2">
                    ${escapeHtml(kendaraan.no_plat || '-')}
                </span>
            </td>
            <td class="align-middle">
                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                    ${escapeHtml(kendaraan.jenis_kendaraan || '-')}
                </span>
            </td>
            <td class="align-middle">
                <span class="badge ${statusClass} px-3 py-2">
                    ${escapeHtml(kendaraan.status_kendaraan || '-')}
                </span>
            </td>
            <td class="align-middle">
                <span class="fw-semibold text-primary">
                    Rp ${formatNumber(kendaraan.harga_perjam)}
                </span>
            </td>
            <td class="align-middle">
                <span class="fw-semibold text-primary">
                    Rp ${formatNumber(kendaraan.harga_perhari)}
                </span>
            </td>
            <td class="text-center align-middle">
                <div class="btn-group btn-group-sm" role="group">
                
                    <button class="btn btn-outline-warning btn-sm btn-edit" title="Edit"
                        data-id="${kendaraan.idtabel}"
                        data-nama="${escapeHtml(kendaraan.nama)}"
                        ${(currentUserRole != 1) ? 'disabled' : ''}>
                        <i class="ri-edit-line"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus"
                        data-id="${kendaraan.idtabel}"
                        data-nama="${escapeHtml(kendaraan.nama)}"
                        ${(currentUserRole != 1) ? 'disabled' : ''}>
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            </td>
        </tr>
    `;


            const $tableBody = $('#tableBody');
            if ($tableBody.find('tr').length > 0 && !$tableBody.find('tr').first().hasClass('no-data')) {
                $tableBody.prepend(newRow);
            } else {
                $tableBody.html(newRow);
            }

            renumberTableRows();

            $tableBody.find('tr.new-kendaraan-row').addClass('highlight-new');
            setTimeout(() => {
                $tableBody.find('tr.new-kendaraan-row').removeClass('highlight-new new-kendaraan-row');
            }, 2000);
        }



        // ==================== EDIT KENDARAAN MODAL ====================
        function editKendaraanModal(kendaraanId, kendaraanNama) {
            showMinimalNotification('Memuat data...', 'info');

            $.ajax({
                url: `${baseUrl}kendaraan/get-edit-data/${kendaraanId}`,
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

        function showEditModal(kendaraanData) {

            const fotoName = kendaraanData.foto || 'default-car.png';
            const fotoUrl = `${imageBaseUrl}${fotoName}`;

            const html = `
    <div class="edit-kendaraan-modal">
        <form id="editKendaraanForm" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="row g-3">
                <!-- Foto Kendaraan -->
                <div class="col-12">
                    <label class="form-label">Foto Kendaraan</label>
                    <div class="text-center mb-3">
                        <div class="position-relative d-inline-block">
                            <img id="editFotoPreview" src="${fotoUrl}" 
                                 class="rounded border" 
                                 style="width: 200px; height: 120px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('editFotoInput').click()">
                            <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1 m-1" 
                                 style="cursor: pointer;"
                                 onclick="document.getElementById('editFotoInput').click()">
                                <i class="ri-camera-line text-white" style="font-size: 12px;"></i>
                            </div>
                        </div>
                        <input type="file" 
                               class="form-control d-none" 
                               id="editFotoInput" 
                               name="foto" 
                               accept="image/*"
                               onchange="previewImage(this, 'editFotoPreview')">
                        <div class="mt-2">
                            <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG</small>
                            ${kendaraanData.foto && kendaraanData.foto !== 'default-car.png' ? `
                                <br>
                                <small class="text-danger">
                                    <i class="ri-information-line me-1"></i>
                                    Upload foto baru akan mengganti foto yang lama
                                </small>
                            ` : ''}
                        </div>
                    </div>
                </div>
                
                <!-- Nama Kendaraan -->
                <div class="col-12">
                    <label class="form-label">Nama Kendaraan <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           name="nama" 
                           value="${escapeHtml(kendaraanData.nama || '')}"
                           required>
                    <div class="invalid-feedback">Harap isi nama kendaraan</div>
                </div>
                
                <!-- No Plat -->
                <div class="col-12">
                    <label class="form-label">No Plat <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           name="no_plat" 
                           value="${escapeHtml(kendaraanData.no_plat || '')}"
                           required>
                    <div class="invalid-feedback">Harap isi nomor plat</div>
                </div>
                
                <!-- Jenis Kendaraan -->
                <div class="col-md-6">
                    <label class="form-label">Jenis Kendaraan <span class="text-danger">*</span></label>
                    <select class="form-select" name="idjenis_kendaraan" required>
                        <option value="">Pilih Jenis</option>
                        ${kendaraanData.jenis_kendaraan.map(jenis => `
                            <option value="${jenis.idtabel}" ${kendaraanData.idjenis_kendaraan == jenis.idtabel ? 'selected' : ''}>
                                ${escapeHtml(jenis.nama)}
                            </option>
                        `).join('')}
                    </select>
                    <div class="invalid-feedback">Harap pilih jenis kendaraan</div>
                </div>
                
                <!-- Status Kendaraan -->
                <div class="col-md-6">
                    <label class="form-label">Status Kendaraan <span class="text-danger">*</span></label>
                    <select class="form-select" name="idstatus_kendaraan" required>
                        <option value="">Pilih Status</option>
                        ${kendaraanData.status_kendaraan.map(status => `
                            <option value="${status.idtabel}" ${kendaraanData.idstatus_kendaraan == status.idtabel ? 'selected' : ''}>
                                ${escapeHtml(status.nama)}
                            </option>
                        `).join('')}
                    </select>
                    <div class="invalid-feedback">Harap pilih status kendaraan</div>
                </div>
                
                <!-- Harga Per Jam -->
                <div class="col-md-6">
                    <label class="form-label">Harga Per Jam <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" 
                               class="form-control" 
                               name="harga_perjam" 
                               value="${kendaraanData.harga_perjam || 0}"
                               min="1000"
                               required>
                    </div>
                    <div class="invalid-feedback">Harap isi harga per jam</div>
                </div>
                
                <!-- Harga Per Hari -->
                <div class="col-md-6">
                    <label class="form-label">Harga Per Hari <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" 
                               class="form-control" 
                               name="harga_perhari" 
                               value="${kendaraanData.harga_perhari || 0}"
                               min="1000"
                               required>
                    </div>
                    <div class="invalid-feedback">Harap isi harga per hari</div>
                </div>
            </div>
            <input type="hidden" name="kendaraan_id" value="${kendaraanData.idtabel}">
        </form>
    </div>
    `;

            Swal.fire({
                title: `<div class="d-flex align-items-center">
            <i class="ri-edit-line me-2 text-primary"></i>
            <span>Edit Kendaraan</span>
        </div>`,
                html: html,
                showCancelButton: true,
                confirmButtonText: '<i class="ri-save-line me-1"></i> Simpan',
                cancelButtonText: '<i class="ri-close-line me-1"></i> Batal',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                width: '500px',
                didOpen: () => {
                    initEditFormValidation();
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const form = document.getElementById('editKendaraanForm');
                        if (form.checkValidity()) {
                            const formData = new FormData(form);
                            const data = Object.fromEntries(formData.entries());

                            // Convert to number
                            data.harga_perjam = parseInt(data.harga_perjam);
                            data.harga_perhari = parseInt(data.harga_perhari);

                            // Validate harga
                            if (data.harga_perjam < 1000 || data.harga_perhari < 1000) {
                                Swal.showValidationMessage('Harga minimal Rp 1.000');
                                resolve(false);
                                return;
                            }

                            // Add file if exists
                            const fileInput = document.getElementById('editFotoInput');
                            if (fileInput.files.length > 0) {
                                formData.append('foto', fileInput.files[0]);
                            }

                            resolve(formData);
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
                    submitEditKendaraan(result.value);
                }
            });
        }

        function initEditFormValidation() {
            const form = document.getElementById('editKendaraanForm');
            form.classList.remove('was-validated');

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

        function submitEditKendaraan(formData) {
            // Tambahkan CSRF token ke FormData
            formData.append(csrfName, csrfToken);

            // Debug: Lihat isi FormData
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: `${baseUrl}kendaraan/ajax-update`,
                type: 'POST',
                data: formData,
                processData: false, // Penting: jangan proses data
                contentType: false, // Penting: jangan set content type
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                },
                success: function(response) {
                    if (response.status === 'success') {
                        updateKendaraanAfterEdit(response.data);
                        showMinimalNotification('✓ Data berhasil disimpan');

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
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Response:', xhr.responseText);

                    if (xhr.status === 403) {
                        showMinimalNotification('Sesi telah berakhir. Silakan refresh halaman.', 'error');
                        setTimeout(() => window.location.reload(), 2000);
                    } else if (xhr.status === 413) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file melebihi batas maksimal 2MB.',
                            confirmButtonColor: '#ef4444'
                        });
                    } else {
                        let errorMsg = 'Koneksi gagal';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).join('<br>');
                        } else if (xhr.responseText) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                if (response.errors) {
                                    errorMsg = Object.values(response.errors).join('<br>');
                                } else if (response.message) {
                                    errorMsg = response.message;
                                }
                            } catch (e) {
                                errorMsg = xhr.responseText.substring(0, 100);
                            }
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

        function updateKendaraanAfterEdit(updatedKendaraan) {
            // Update in memory arrays
            const index = allKendaraanData.findIndex(k => k.idtabel == updatedKendaraan.idtabel);
            if (index !== -1) {
                allKendaraanData[index] = {
                    ...allKendaraanData[index],
                    ...updatedKendaraan
                };
            }

            const filteredIndex = filteredKendaraan.findIndex(k => k.idtabel == updatedKendaraan.idtabel);
            if (filteredIndex !== -1) {
                filteredKendaraan[filteredIndex] = {
                    ...filteredKendaraan[filteredIndex],
                    ...updatedKendaraan
                };
            }

            // Update table row
            const rows = $('#tableBody tr');
            rows.each(function() {
                const btn = $(this).find('.btn-edit');
                if (btn.length && btn.data('id') == updatedKendaraan.idtabel) {
                    updateTableRowAfterEdit($(this), updatedKendaraan);
                    return false;
                }
            });
        }

        function updateTableRowAfterEdit(row, kendaraan) {
            const statusClass = getStatusClass(kendaraan.status_kendaraan);


            const fotoName = kendaraan.foto || 'default-car.png';
            const fotoUrl = `${imageBaseUrl}${fotoName}`;

            // Update data attributes
            row.find('.btn-edit, .btn-delete').data('nama', kendaraan.nama);

            // Update foto
            row.find('td:nth-child(2) img')
                .attr('src', fotoUrl)
                .attr('alt', kendaraan.nama);

            // Update name
            row.find('td:nth-child(2) h6').text(kendaraan.nama);

            // Update no plat
            row.find('td:nth-child(3) span').text(kendaraan.no_plat || '-');

            // Update jenis
            row.find('td:nth-child(4) span').text(kendaraan.jenis_kendaraan || '-');

            // Update status
            row.find('td:nth-child(5) span')
                .removeClass()
                .addClass(`badge ${statusClass} px-3 py-2`)
                .text(kendaraan.status_kendaraan || '-');

            // Update harga
            row.find('td:nth-child(6) span').text(`Rp ${formatNumber(kendaraan.harga_perjam)}`);
            row.find('td:nth-child(7) span').text(`Rp ${formatNumber(kendaraan.harga_perhari)}`);

            // Highlight animation
            row.addClass('row-updated');
            setTimeout(() => row.removeClass('row-updated'), 1000);
        }


        //        =============== DELETE KENDARAAN ====================
        function deleteKendaraan(kendaraanId, kendaraanNama) {
            Swal.fire({
                title: 'Hapus Kendaraan?',
                html: `<div class="text-center py-2">${escapeHtml(kendaraanNama)}</div>
               <div class="text-danger small mt-2">Data yang dihapus tidak dapat dikembalikan</div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = {
                        [csrfName]: csrfToken,
                        kendaraan_id: kendaraanId
                    };

                    $.ajax({
                        url: `${baseUrl}kendaraan/delete/${kendaraanId}`,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                removeKendaraanFromData(kendaraanId);
                                showMinimalNotification('✓ Kendaraan dihapus');

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            } else {
                                showMinimalNotification(response.message || 'Gagal', 'error');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 403) {
                                showMinimalNotification(
                                    'Sesi telah berakhir. Silakan refresh halaman.', 'error');
                                setTimeout(() => window.location.reload(), 2000);
                            } else {
                                showMinimalNotification('Koneksi gagal', 'error');
                            }
                        }
                    });
                }
            });
        }

        function removeKendaraanFromData(kendaraanId) {
            // Remove from data arrays
            allKendaraanData = allKendaraanData.filter(k => k.idtabel != kendaraanId);
            filteredKendaraan = filteredKendaraan.filter(k => k.idtabel != kendaraanId);

            // Remove from table
            $(`#tableBody tr[data-id="${kendaraanId}"]`).remove();

            // Renumber rows
            renumberTableRows();

            // Update counter
            updateCounter(filteredKendaraan.length, allKendaraanData.length);

            // Show empty state if no data
            if (filteredKendaraan.length === 0) {
                $('#tableBody').html(`
            <tr>
                <td colspan="7" class="text-center py-5">
                    <i class="ri-car-line fs-1 text-muted opacity-50 d-block mb-2"></i>
                    <span class="text-muted">Tidak ada hasil ditemukan</span>
                </td>
            </tr>
        `);
            }
        }

        // ==================== UPDATE STATUS KENDARAAN ====================
        function updateStatusKendaraan(kendaraanId, kendaraanNama) {
            // Create status options
            const statusOptions = <?= json_encode($status_kendaraan) ?>;

            const statusHtml = `
        <div class="mb-3">
            <label class="form-label">Pilih Status Baru</label>
            <select class="form-select" id="statusSelect">
                ${statusOptions.map(status => `
                    <option value="${status.idtabel}">${escapeHtml(status.nama)}</option>
                `).join('')}
            </select>
        </div>
    `;

            Swal.fire({
                title: 'Ubah Status',
                html: `<div class="text-center py-2 mb-3">${escapeHtml(kendaraanNama)}</div>${statusHtml}`,
                showCancelButton: true,
                confirmButtonText: 'Simpan Status',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    const statusId = document.getElementById('statusSelect').value;
                    if (!statusId) {
                        Swal.showValidationMessage('Harap pilih status');
                        return false;
                    }
                    return statusId;
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const data = {
                        [csrfName]: csrfToken,
                        status_id: result.value
                    };

                    $.ajax({
                        url: `${baseUrl}kendaraan/update-status/${kendaraanId}`,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                updateKendaraanAfterEdit(response.data);
                                showMinimalNotification('✓ Status diperbarui');

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            } else {
                                showMinimalNotification(response.message || 'Gagal', 'error');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 403) {
                                showMinimalNotification(
                                    'Sesi telah berakhir. Silakan refresh halaman.', 'error');
                                setTimeout(() => window.location.reload(), 2000);
                            } else {
                                showMinimalNotification('Koneksi gagal', 'error');
                            }
                        }
                    });
                }
            });
        }

        // ==================== UTILITY FUNCTIONS ====================
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function getStatusClass(statusName) {
            switch (statusName) {
                case 'Tersedia':
                    return 'bg-success bg-opacity-10 text-success';
                case 'Disewa':
                    return 'bg-warning bg-opacity-10 text-warning';
                case 'Rusak':
                    return 'bg-danger bg-opacity-10 text-danger';
                default:
                    return 'bg-secondary bg-opacity-10 text-secondary';
            }
        }

        function renumberTableRows() {
            $('#tableBody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
        }

        function updateCounter(filteredCount, totalCount) {
            $('#counterText').text(`Menampilkan ${filteredCount} dari ${totalCount} kendaraan`);
            $('#totalKendaraan').text(`${totalCount} Kendaraan`);
        }

        function filterAndRenderData() {
            const searchTerm = $('#searchInput').val().toLowerCase().trim();
            const filterJenis = $('#filterJenis').val();
            const filterStatus = $('#filterStatus').val();

            filteredKendaraan = allKendaraanData.filter(kendaraan => {
                let match = true;

                if (searchTerm) {
                    const namaMatch = kendaraan.nama.toLowerCase().includes(searchTerm);
                    const platMatch = kendaraan.no_plat.toLowerCase().includes(searchTerm);

                    if (!namaMatch && !platMatch) {
                        match = false;
                    }
                }




                if (filterJenis && kendaraan.idjenis_kendaraan != filterJenis) {
                    match = false;
                }

                if (filterStatus && kendaraan.idstatus_kendaraan != filterStatus) {
                    match = false;
                }

                return match;
            });

            renderTable(filteredKendaraan);
            updateCounter(filteredKendaraan.length, allKendaraanData.length);
        }

        function renderTable(kendaraan) {
            if (kendaraan.length === 0) {
                $('#tableBody').html(`
            <tr>
                <td colspan="8" class="text-center py-5">
                    <i class="ri-search-line fs-1 text-muted opacity-50 d-block mb-2"></i>
                    <span class="text-muted">Tidak ada hasil ditemukan</span>
                </td>
            </tr>
        `);
                return;
            }

            const tableRows = kendaraan.map((k, index) => {
                const statusClass = getStatusClass(k.status_kendaraan);

                // PERBAIKAN: Gunakan imageBaseUrl
                const fotoName = k.foto || 'default-car.png';
                const fotoUrl = `${imageBaseUrl}${fotoName}`;

                return `
            <tr data-id="${k.idtabel}">
                <td class="text-center fw-semibold align-middle">${index + 1}</td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <img src="${fotoUrl}" 
                                 alt="${escapeHtml(k.nama)}"
                                 class="rounded"
                                 style="width: 60px; height: 40px; object-fit: cover;"
                                 onerror="this.onerror=null; this.src='${imageBaseUrl}default-car.png'">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold">${escapeHtml(k.nama)}</h6>
                            <small class="text-muted">
                                <i class="ri-time-line me-1"></i>
                                ${formatDate(k.created_at)}
                            </small>
                        </div>
                    </div>
                </td>
                <td class="align-middle">
                    <span class="badge bg-dark bg-opacity-10 text-dark px-3 py-2">
                        ${escapeHtml(k.no_plat || '-')}
                    </span>
                </td>
                <td class="align-middle">
                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                        ${escapeHtml(k.jenis_kendaraan || '-')}
                    </span>
                </td>
                <td class="align-middle">
                    <span class="badge ${statusClass} px-3 py-2">
                        ${escapeHtml(k.status_kendaraan || '-')}
                    </span>
                </td>
                <td class="align-middle">
                    <span class="fw-semibold text-primary">
                        Rp ${formatNumber(k.harga_perjam)}
                    </span>
                </td>
                <td class="align-middle">
                    <span class="fw-semibold text-primary">
                        Rp ${formatNumber(k.harga_perhari)}
                    </span>
                </td>
                <td class="text-center align-middle">
                    <div class="btn-group btn-group-sm" role="group">
                      
                        <button class="btn btn-outline-warning btn-sm btn-edit" title="Edit"
                            data-id="${k.idtabel}"
                            data-nama="${escapeHtml(k.nama)}"
                            ${(currentUserRole != 1) ? 'disabled' : ''}>
                            <i class="ri-edit-line"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus"
                            data-id="${k.idtabel}"
                            data-nama="${escapeHtml(k.nama)}"
                            ${(currentUserRole != 1) ? 'disabled' : ''}>
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
            }).join('');

            $('#tableBody').html(tableRows);
        }

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

        // ==================== INITIALIZATION ====================
        $(document).ready(function() {
            // Initial state
            filteredKendaraan = [...allKendaraanData];
            updateCounter(allKendaraanData.length, allKendaraanData.length);

            // Event handlers
            $(document).on('click', '.btn-add-kendaraan:not([disabled])', function(e) {
                e.preventDefault();
                showAddKendaraanModal();
            });

            $(document).on('click', '.btn-add-kendaraan[disabled]', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'Hanya admin yang dapat menambahkan kendaraan baru.',
                    confirmButtonColor: '#f59e0b'
                });
            });

            $(document).on('click', '.btn-edit:not([disabled])', function(e) {
                e.preventDefault();
                const kendaraanId = $(this).data('id');
                const kendaraanNama = $(this).data('nama');
                editKendaraanModal(kendaraanId, kendaraanNama);
            });

            $(document).on('click', '.btn-edit[disabled]', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'Hanya admin yang dapat mengedit kendaraan.',
                    confirmButtonColor: '#f59e0b'
                });
            });

            $(document).on('click', '.btn-delete:not([disabled])', function(e) {
                e.preventDefault();
                const kendaraanId = $(this).data('id');
                const kendaraanNama = $(this).data('nama');
                deleteKendaraan(kendaraanId, kendaraanNama);
            });

            $(document).on('click', '.btn-delete[disabled]', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'Hanya admin yang dapat menghapus kendaraan.',
                    confirmButtonColor: '#f59e0b'
                });
            });

            $(document).on('dblclick', 'td:nth-child(4)', function() {
                if (currentUserRole == 1) {
                    const kendaraanId = $(this).closest('tr').data('id');
                    const kendaraanNama = $(this).closest('tr').find('h6').text();
                    updateStatusKendaraan(kendaraanId, kendaraanNama);
                }
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
            $('#filterJenis, #filterStatus').on('change', function() {
                filterAndRenderData();
            });

            // Session messages
            <?php if (session()->getFlashdata('success')): ?>
            setTimeout(() => {
                showMinimalNotification('<?= session()->getFlashdata('success') ?>');
            }, 500);
            <?php endif; ?>
        });

        function printTable() {
            window.print();
        }
        </script>

        <style>
        .highlight-new {
            animation: highlightFade 2s ease-out;
            background-color: rgba(16, 185, 129, 0.1) !important;
        }

        @keyframes highlightFade {
            0% {
                background-color: rgba(16, 185, 129, 0.3);
            }

            100% {
                background-color: rgba(16, 185, 129, 0.1);
            }
        }

        .row-updated {
            animation: subtleHighlight 1s ease-out;
        }

        @keyframes subtleHighlight {
            0% {
                background-color: rgba(59, 130, 246, 0.1);
            }

            100% {
                background-color: transparent;
            }
        }

        .badge {
            font-weight: 500;
        }

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
        }

        .swal2-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .swal2-html-container {
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
                gap: 4px;
            }

            .btn-group .btn-sm {
                width: 100%;
            }
        }
        </style>


    </div>
</div>






<!-- END layout-wrapper -->