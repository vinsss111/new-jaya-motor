<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - New Jaya Motor</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/image/logo.png'); ?>">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f4f7f6; /* Abu-abu sangat muda */
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border-top: 5px solid #dc3545; /* Aksen merah di atas */
        }

        .login-header img {
            max-width: 80px;
            margin-bottom: 20px;
        }

        .login-header h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #495057;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        }

        .btn-login {
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            background-color: #dc3545;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #bb2d3b;
            transform: translateY(-1px);
        }

        .footer-link {
            text-decoration: none;
            color: #dc3545;
            font-weight: 600;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .copyright {
            font-size: 0.8rem;
            color: #adb5bd;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header text-center">
            <img src="<?= base_url('assets/image/logo.png'); ?>" alt="Logo">
            <h4>Selamat Datang</h4>
            <p>Silakan masuk ke akun admin Anda</p>
        </div>

        <form action="<?= base_url('login/proses'); ?>" method="POST" class="mt-4">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" placeholder="Username" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="Password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-danger btn-login w-100">
                MASUK SEKARANG
            </button>

            <div class="text-center mt-4">
                <a href="<?= base_url('login/reset_password'); ?>" class="small text-muted text-decoration-none">
                    Lupa password? <span class="footer-link">Reset di sini</span>
                </a>
            </div>
        </form>

        <div class="copyright">
            &copy; 2026 New Jaya Motor
        </div>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php $session = service('session'); ?>
    <script>
        <?php if($session->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= $session->getFlashdata('error'); ?>',
                confirmButtonColor: '#dc3545'
            });
        <?php endif; ?>
    </script>
</body>
</html>