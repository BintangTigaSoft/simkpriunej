<?php
// Default values
$user = $user ?? [
    'nama_lengkap' => 'User',
    'email' => '',
    'nmrole' => 'Pengguna',
    'nmfakultas' => 'Fakultas',
    'user_sso' => '',
    'is_active' => 1
];
$page_title = $page_title ?? 'Profil';
$base_url = $base_url ?? base_url();
?>
<!-- Profile Page -->
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                </div>
                <h5 class="card-title"><?= htmlspecialchars($user['nama_lengkap']) ?></h5>
                <p class="text-muted"><?= htmlspecialchars($user['nmrole']) ?></p>
                <p class="card-text">
                    <small class="text-muted">
                        <i class="fas fa-university me-1"></i>
                        <?= htmlspecialchars($user['nmfakultas']) ?>
                    </small>
                </p>

                <!-- Status Badge -->
                <div class="mt-3">
                    <?php if (($user['is_active'] ?? 0) == 1): ?>
                    <span class="badge bg-success">Akun Aktif</span>
                    <?php else: ?>
                    <span class="badge bg-danger">Akun Tidak Aktif</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i> Informasi Profil</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                        </tr>
                        <tr>
                            <th>Username SSO</th>
                            <td><?= htmlspecialchars($user['user_sso'] ?? $_SESSION['user_sso'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($user['email'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= htmlspecialchars($user['nmrole'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Fakultas/Unit</th>
                            <td><?= htmlspecialchars($user['nmfakultas'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>ID User</th>
                            <td><?= htmlspecialchars($user['id_user'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Login Terakhir</th>
                            <td><?= date('d/m/Y H:i:s', $_SESSION['login_time'] ?? time()) ?></td>
                        </tr>
                        <tr>
                            <th>Metode Login</th>
                            <td>
                                <?php if (($_SESSION['login_method'] ?? 'sso') === 'sso'): ?>
                                <span class="badge bg-danger">SSO UNEJ</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Manual</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4">
                    <a href="<?= $base_url ?>dashboard" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>