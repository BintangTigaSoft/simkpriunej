<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login - SiKuje' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        max-width: 400px;
        width: 100%;
    }

    .login-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .login-body {
        padding: 30px;
    }

    .btn-login {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }

    .btn-sso {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-sso:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .logo {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <div class="logo-placeholder">
                <i class="fas fa-user-shield fa-3x"></i>
            </div>
            <h3 class="mb-2">SimKPRI</h3>
            <p class="mb-0">SIM KPRI UNEJ</p>
        </div>

        <div class="login-body">
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="text-center mb-4">
                <h4>Selamat Datang</h4>
                <p class="text-muted">Silakan pilih metode login</p>
            </div>

            <div class="d-grid gap-3">
                <!-- Login via SSO UNEJ -->
                <a href="<?= base_url('auth/sso') ?>" class="btn btn-sso">
                    <i class="fas fa-university me-2"></i> Login via SSO UNEJ
                </a>

                <!-- Login Manual -->
                <a href="<?= base_url('auth/form') ?>" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login Manual
                </a>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted mb-0">
                    <small>© <?= date('Y') ?> SiKuje - Universitas Jember</small>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>