<!-- Content for Dashboard -->
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h4 class="card-title mb-1">Selamat Datang, <?= htmlspecialchars($user['nama_lengkap']) ?>!</h4>
                        <p class="card-text text-muted">
                            Anda login sebagai <strong><?= htmlspecialchars($user['nmrole']) ?></strong>
                            dari <strong><?= htmlspecialchars($user['nmfakultas']) ?></strong>
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($user['email']) ?>
                            | <i class="fas fa-user me-1"></i> <?= htmlspecialchars($user['username']) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row">
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card card-custom text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Data</h6>
                        <h2 class="mb-0">128</h2>
                    </div>
                    <div>
                        <i class="fas fa-database fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card card-custom text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Aktif</h6>
                        <h2 class="mb-0">98</h2>
                    </div>
                    <div>
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card card-custom text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Pending</h6>
                        <h2 class="mb-0">15</h2>
                    </div>
                    <div>
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card card-custom text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Tolak</h6>
                        <h2 class="mb-0">15</h2>
                    </div>
                    <div>
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i> Aktivitas Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Aktivitas</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Login sistem (<?= htmlspecialchars($user['login_method']) ?>)</td>
                                <td><?= date('d/m/Y H:i', $_SESSION['login_time'] ?? time()) ?></td>
                                <td><span class="badge bg-success">Sukses</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Update profil</td>
                                <td>04/02/2026 09:30</td>
                                <td><span class="badge bg-success">Sukses</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Upload dokumen</td>
                                <td>03/02/2026 14:20</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan info role_id untuk debugging jika perlu -->
<!-- <?php if (ENVIRONMENT !== 'production'): ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Debug Info</h6>
            </div>
            <div class="card-body">
                <pre><?= print_r($user, true) ?></pre>
                <pre>Role ID: <?= $user['role_id'] ?></pre>
                <pre>Image: <?= $user['image'] ?></pre>
            </div>
        </div>
    </div>
</div>
<?php endif; ?> -->