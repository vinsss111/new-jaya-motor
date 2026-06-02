<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - New Jaya Motor</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/image/logo.png'); ?>">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .reset-card {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border-top: 5px solid #dc3545;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #495057;
        }

        .form-control {
            padding: 11px 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        }

        .btn-action {
            border-radius: 8px;
            font-weight: 600;
            padding: 12px;
        }

        .status-msg { font-size: 0.75rem; margin-top: 5px; font-weight: 600; }
        
        hr { opacity: 0.1; }
    </style>
</head>
<body>

    <div class="reset-card">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Reset Password</h4>
            <p class="text-muted small">Verifikasi identitas untuk mengubah password admin.</p>
        </div>

        <form action="<?= base_url('login/proses_reset'); ?>" method="POST" id="formReset">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password Lama</label>
                <div class="input-group">
                    <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="••••••••" required>
                    <button class="btn btn-outline-danger px-4" type="button" id="btnCek">Verifikasi</button>
                </div>
                <div id="pesanCek" class="status-msg text-center"></div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password_baru" id="password_baru" class="form-control" placeholder="Minimal 6 karakter" required disabled>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_baru" id="konfirmasi_baru" class="form-control" placeholder="Ulangi password baru" required disabled>
            </div>

            <button type="submit" id="btnSubmit" class="btn btn-danger btn-action w-100 mb-3" disabled>
                SIMPAN PERUBAHAN
            </button>
            
            <div class="text-center">
                <a href="<?= base_url('login'); ?>" class="text-decoration-none small text-muted">Kembali ke Login</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $('#btnCek').click(function() {
            const username = $('#username').val();
            const passLama = $('#password_lama').val();

            if(!username || !passLama) {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Username dan Password lama wajib diisi!' });
                return;
            }

            $(this).html('<span class="spinner-border spinner-border-sm"></span>').attr('disabled', true);

            $.ajax({
                url: "<?= base_url('login/cek_password_lama'); ?>",
                type: "POST",
                data: { username: username, password_lama: passLama },
                dataType: "JSON",
                success: function(response) {
                    if(response.status === 'match') {
                        $('#btnCek').html('<i class="bi bi-check"></i>').removeClass('btn-outline-danger').addClass('btn-success');
                        $('#pesanCek').text('Password lama cocok!').css('color', '#28a745');
                        $('#username, #password_lama').attr('readonly', true);
                        $('#password_baru, #konfirmasi_baru, #btnSubmit').removeAttr('disabled');
                    } else {
                        $('#btnCek').html('Verifikasi').removeAttr('disabled');
                        $('#pesanCek').text('Data tidak sesuai!').css('color', '#dc3545');
                        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Username atau Password lama salah!' });
                    }
                }
            });
        });
    });
    </script>
</body>
</html>