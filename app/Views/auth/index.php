<?php
$title = $title ?? 'Login - SiKuje';
$base_url = $base_url ?? base_url();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .login-container {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 400px;
    }

    .btn-sso {
        background: #dc3545;
        color: white;
        padding: 12px;
        width: 100%;
        margin-bottom: 15px;
    }

    .btn-manual {
        background: #6c757d;
        color: white;
        padding: 12px;
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center mb-4">SiKuje</h2>
        <p class="text-center text-muted mb-4">Sistem Informasi KPRI Unej</p>

        <!-- Login via SSO -->
        <a href="<?= $base_url ?>auth/sso" class="btn btn-sso">
            <i class="fas fa-university"></i> Login dengan SSO UNEJ
        </a>

        <div class="text-center my-3">ATAU</div>

        <!-- Login Manual -->
        <a href="<?= $base_url ?>auth/form" class="btn btn-manual">
            <i class="fas fa-user"></i> Login Manual
        </a>
    </div>
</body>

</html>