<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KPRI UNEJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root {
        --unej-blue: #1a5f7a;
        --unej-green: #57cc99;
    }

    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-top: 5px solid var(--unej-blue);
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo h3 {
        color: var(--unej-blue);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .logo p {
        color: #6c757d;
        font-size: 14px;
    }

    .btn-unej {
        background: var(--unej-blue);
        border: none;
        color: white;
        padding: 12px;
        font-weight: 600;
    }

    .btn-unej:hover {
        background: #144b60;
        color: white;
    }

    .form-control:focus {
        border-color: var(--unej-blue);
        box-shadow: 0 0 0 0.25rem rgba(26, 95, 122, 0.25);
    }

    .footer-text {
        font-size: 12px;
        color: #6c757d;
        text-align: center;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="logo">
            <h3>KPRI UNEJ</h3>
            <p>Koperasi Pegawai Republik Indonesia<br>Universitas Jember</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/process') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= esc($email) ?>" required
                    placeholder="Email anggota">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required placeholder="Password">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-unej w-100">Login</button>
        </form>

        <div class="footer-text">
            <p>&copy; <?= date('Y') ?> KPRI UNEJ. Hak Cipta Dilindungi.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>