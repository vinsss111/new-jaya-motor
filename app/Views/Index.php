<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Jaya Motor</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/image/logo.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css');?> ">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container justify-content-between">
            <a class="navbar-brand fw-bold fs-3" href="#home"><img src="<?= base_url('assets/image/logo.png'); ?>" style="width:70px;"> New Jaya<span class="text-danger"> Motor</span></a>
            
            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link text-white" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white mx-2" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link text-white mx-2" href="#product">Produk</a></li>
                    <li class="nav-item"><a class="nav-link text-white mx-2" href="#contact">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="mobile-bottom-nav d-lg-none">
        <a href="#home" class="nav-item text-decoration-none">
            <i class="bi bi-house-door-fill"></i>
            <span>Home</span>
        </a>
        <a href="#about" class="nav-item text-decoration-none">
            <i class="bi bi-info-square-fill"></i>
            <span>Tentang</span>
        </a>
        <a href="#product" class="nav-item text-decoration-none">
            <i class="bi bi-box-seam-fill"></i>
            <span>Produk</span>
        </a>
        <a href="#contact" class="nav-item text-decoration-none">
            <i class="bi bi-telephone-fill"></i>
            <span>Kontak</span>
        </a>
    </nav>

    <div id="home">
        <header class="hero text-center text-lg-start">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 class="display-2 mb-3">Solusi Cerdas Untuk <br><span class="text-danger">Performa Motor</span></h1>
                        <p class="lead mb-4">Mekanik bersertifikat, suku cadang original, dan teknologi diagnosa modern untuk kenyamanan berkendara Anda.</p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="#services" class="btn btn-danger btn-lg px-5 py-3 rounded-pill">Lihat Layanan</a>
                            <a href="#about" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-5 bg-danger text-white">
            <div class="container">
                <div class="row text-center g-4 justify-content-center">
                    <div class="col-6 col-md-4">
                        <h2 class="fw-bold">10+</h2>
                        <p class="mb-0 opacity-75">Tahun Pengalaman</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <h2 class="fw-bold">800+</h2>
                        <p class="mb-0 opacity-75">Motor Tertangani</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <h2 class="fw-bold">3</h2>
                        <p class="mb-0 opacity-75">Mekanik Ahli</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-5">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h6 class="text-danger fw-bold text-uppercase ls-2">Layanan Utama</h6>
                    <h2 class="display-5 fw-bold">Perawatan Menyeluruh</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card service-card p-5 text-center">
                            <i class="bi bi-wrench-adjustable icon-box mb-3"></i>
                            <h4 class="fw-bold">Servis Berkala</h4>
                            <p class="text-muted">Pembersihan CVT, ganti oli, dan kalibrasi sistem injeksi secara menyeluruh.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card service-card p-5 text-center">
                            <i class="bi bi-cpu icon-box mb-3"></i>
                            <h4 class="fw-bold">Remapping ECU</h4>
                            <p class="text-muted">Optimasi software mesin untuk meningkatkan torsi dan efisiensi bahan bakar.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card service-card p-5 text-center">
                            <i class="bi bi-shield-check icon-box mb-3"></i>
                            <h4 class="fw-bold">Overhaul</h4>
                            <p class="text-muted">Rekondisi mesin total dengan standar pabrikan dan garansi komponen original.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<hr class="border-dark opacity-100"><br><br>

    <div id="about">
        <div class="text-center">
            <div class="container">
                <h1 class="display-4 fw-bold">Dedikasi Untuk <span class="text-danger">Keamanan</span> Berkendara</h1>
                <p class="lead opacity-75">Kami bukan sekadar bengkel, kami adalah partner motor Anda.</p>
            </div>
        </div>

        <section class="py-5">
            <div class="container py-4">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="<?= base_url('assets/image/images.jpg'); ?>" class="img-fluid rounded-4 shadow-lg" style="width: 550px;" alt="Workshop">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">Histori</h2>
                        <p class="text-muted" style="text-align: justify;">New Jaya Motor berdiri dari keresahan pemilik motor akan sulitnya menemukan bengkel yang jujur. Sejak tahun 200x didirikannya New Jaya Motor ini, kami berkomitmen memberikan transparansi penuh dan harga yang adil ketika melayani customer.</p>
                        <p class="text-muted">Setiap mekanik kami telah memiliki pengalaman dalam bidang mesin serta juga ada yang kuliah jurusan mesin.</p>
                        <div class="row mt-4 g-4">
                            <div class="col-md-6">
                                <div class="p-3 border-start border-danger border-4">
                                    <h5 class="fw-bold mb-1"><i class="bi bi-award text-danger me-2"></i> Kualitas</h5>
                                    <p class="small text-muted mb-0">Hanya menggunakan sparepart grade A dan original.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border-start border-danger border-4">
                                    <h5 class="fw-bold mb-1"><i class="bi bi-clock-history text-danger me-2"></i> Ketepatan</h5>
                                    <p class="small text-muted mb-0">Estimasi pengerjaan yang akurat dan tepat waktu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container text-center py-5">
                <h2 class="fw-bold mb-5">Mekanik Ahli Kami</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/image/ava.jpg'); ?>" class="rounded-circle team-img mb-3" alt="Rian">
                        <h4 class="fw-bold mb-1">Bang Anam</h4>
                        <p class="text-danger fw-semibold">Senior Mekanik</p>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/image/ava.jpg'); ?>" class="rounded-circle team-img mb-3" alt="Eko">
                        <h4 class="fw-bold mb-1">Aphen Guo</h4>
                        <p class="text-danger fw-semibold">Senior Mekanik</p>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/image/ava.jpg'); ?>" class="rounded-circle team-img mb-3" alt="Dani">
                        <h4 class="fw-bold mb-1">Mas Koni</h4>
                        <p class="text-danger fw-semibold">Senior Mekanik</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

<hr class="border-dark opacity-100">

    <div id="product" class="pb-5">
        <section class="text-dark text-center py-5">
            <div class="container">
                <h2 class="display-5 fw-bold mb-3">Katalog <span class="text-danger">Sparepart</span></h2>
                <p class="lead text-secondary">Kami menyediakan berbagai pilihan suku cadang untuk berbagai tipe motor.</p>
            </div>
        </section>

        <section class="product-section">
            <div class="container">
                <div class="row g-4">
                    <?php foreach($spareparts as $item): ?>
                        <div class="col-6 col-lg-3">
                            <div class="product-card h-100 d-flex flex-column">
                                <div class="product-img-container">
                                    <img src="<?= base_url('uploads/' . $item['gambar']); ?>" 
                                         class="card-img-top p-3" 
                                         alt="<?= $item['nama_barang']; ?>" 
                                         onerror="this.src='<?= base_url('assets/image/logo.png'); ?>'">
                                </div>
                                <div class="p-3 text-center flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="badge-category mb-2 d-inline-block"><?= $item['kategori']; ?></span>
                                        <h6 class="fw-bold"><?= $item['nama_barang']; ?></h6>
                                        <p class="text-danger fw-bold mb-1">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                                        <p class="small text-muted mb-3">Stok: <?= $item['stok']; ?></p>
                                    </div>
                                    
                                    <button class="btn btn-outline-danger w-100 btn-sm btn-tambah-keranjang" 
                                            onclick="tambahKeranjang(<?= $item['id_sparepart']; ?>, '<?= $item['nama_barang']; ?>', <?= $item['harga']; ?>, <?= $item['stok']; ?>)">
                                        <i class="bi bi-cart-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                
                <div class="mt-5 text-center bg-white p-5 rounded-4 shadow-sm border">
                    <h4 class="fw-bold">Cari Sparepart Spesifik?</h4>
                    <p class="text-muted">Jika barang yang Anda cari tidak ada di katalog, kami bisa bantu pesankan (Pre-Order).</p>
                    <a href="https://wa.me/6282173639451" class="btn btn-danger px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-whatsapp me-2"></i>Tanya Stok via WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </div>

<hr class="border-dark opacity-100">

    <div id="contact">
        <section class="text-dark text-center py-5">
            <div class="container py-4">
                <h2 class="display-5 fw-bold mb-2">Lokasi <span class="text-danger">& Kontak</span></h2>
                <p class="lead text-secondary opacity-75">Kunjungi workshop kami untuk perawatan motor terbaik di Batam.</p>
            </div>
        </section>

        <section class="contact-section" style="margin-top: -80px; padding-bottom: 40px; position: relative; z-index: 2;">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="card contact-card h-100 p-4 text-center border-bottom border-danger border-4" style="box-shadow: 0 5px 15px rgb(0 0 0 / 65%); ">
                            <i class="bi bi-geo-alt-fill text-danger fs-1 mb-3"></i>
                            <h5 class="fw-bold">Alamat</h5>
                            <p class="small text-muted mb-0">Tanjung Buntung, Kec. Bengkong, Kota Batam, Kepulauan Riau 29444</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card contact-card h-100 p-4 text-center border-bottom border-danger border-4" style="box-shadow: 0 5px 15px rgb(0 0 0 / 65%); ">
                            <i class="bi bi-whatsapp text-danger fs-1 mb-3"></i>
                            <h5 class="fw-bold">WhatsApp</h5>
                          <a href="#"  class="text-danger fw-bold text-decoration-none fs-5">0821 1234 5678</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card contact-card h-100 p-4 text-center border-bottom border-danger border-4" style="box-shadow: 0 5px 15px rgb(0 0 0 / 65%); ">
                            <i class="bi bi-clock-fill text-danger fs-1 mb-3"></i>
                            <h5 class="fw-bold">Jam Kerja</h5>
                            <p class="mb-0 text-muted">Buka Setiap Hari<br><span class="text-dark fw-bold">09:00 - 20:00 WIB</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7">
                        <div class="map-container" style="box-shadow: 0 5px 15px rgb(0 0 0 / 65%); ">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d591.4676367929392!2d104.0355594!3d1.1618909!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d989c15772eecf%3A0x957be38b252a105c!2sNew%20Jaya%20Motor!5e1!3m2!1sen!2sid!4v1774949684783!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                           </iframe>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center text-lg-start">
                        <h2 class="fw-bold mb-3">Workshop Kami</h2>
                        <p class="text-muted mb-4" style="text-align: justify;">Kami berlokasi di area strategis Bengkong. Mekanik kami siap melayani berbagai kebutuhan servis motor Anda dengan jujur dan transparan.</p>
                        
                        <a href="https://maps.app.goo.gl/K3UBeeB5T8fHn9Uv8" 
                           target="_blank" 
                           class="btn btn-danger btn-lg rounded-pill px-5 shadow mb-4 w-100">
                            <i class="bi bi-map-fill me-2"></i>Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-dark text-white py-5">
        <div class="container text-center">
            <h3 class="fw-bold mb-4">New Jaya<span class="text-danger"> Motor</span></h3>
            <p class="text-secondary mb-4">Tanjung Buntung, Kec. Bengkong, Kota Batam, <br> Kepulauan Riau 29444</p>
            <div class="d-flex justify-content-center gap-3 mb-4">

            </div>
            <hr class="opacity-25">
            <p class="small mb-0 opacity-50">© 2026 New Jaya Motor. All rights reserved.</p>
        </div>
    </footer>


    <!-- cart -->

    <button class="btn rounded-circle position-fixed shadow-lg d-none d-lg-block" style="bottom: 100px; right: 20px; width: 60px; height: 60px; z-index: 1000;" data-bs-toggle="modal" data-bs-target="#cartModal">
        <i class="bi bi-cart-fill fs-3"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" id="jumlah-keranjang-desktop">0</span>
    </button>

    <button class="btn rounded-circle position-fixed shadow-lg d-block d-lg-none" style="bottom: 170px; right: 20px; width: 60px; height: 60px; z-index: 1000;" data-bs-toggle="modal" data-bs-target="#cartModal">
        <i class="bi bi-cart-fill fs-3"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" id="jumlah-keranjang-mobile">0</span>
    </button>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-cart3 me-2"></i>Detail Pesanan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0">Daftar Barang</h6>
                                <button class="btn btn-sm btn-outline-danger" onclick="clearKeranjang()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="isi-keranjang"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card border-0 rounded-3 p-3">
                                <h6 class="fw-bold mb-3">Informasi Pemesan</h6>
                                <div class="mb-3">
                                    <label class="small fw-bold">Nama Lengkap</label>
                                    <input type="text" id="nama_pemesan" class="form-control" placeholder="Nama Anda">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold">Metode</label>
                                    <select id="metode_ambil" class="form-select">
                                        <option value="Ambil di Toko">Ambil di Toko</option>
                                        <option value="Kirim Kurir">Kirim Kurir (Batam)</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fs-5">Total</span>
                                    <span id="total-harga" class="fs-5 fw-bold text-danger">Rp 0</span>
                                </div>
                                <button type="button" class="btn btn-success w-100 fw-bold py-2 shadow-sm" onclick="checkoutWA()">
                                    <i class="bi bi-whatsapp me-2"></i>Kirim Ke WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- chatbot -->

    <div class="d-none d-lg-block" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
        <button id="btn-open-chat-desktop" class="btn btn-danger rounded-circle shadow-lg btn-open-chat" style="width: 60px; height: 60px;">
            <i class="bi bi-chat-dots-fill fs-3"></i>
        </button>
    </div>

    <div class="d-block d-lg-none" style="position: fixed; bottom: 90px; right: 20px; z-index: 9999;">
        <button id="btn-open-chat-mobile" class="btn btn-danger rounded-circle shadow-lg btn-open-chat" style="width: 60px; height: 60px;">
            <i class="bi bi-chat-dots-fill fs-3"></i>
        </button>
    </div>

    <div id="chat-box" class="card d-none shadow-lg position-fixed" style="bottom: 100px; right: 20px; width: 320px; border-radius: 15px; overflow: hidden; border: none; z-index: 9999;">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center py-3">
            <span class="fw-bold"><i class="bi bi-robot me-2"></i> Assistant</span>
            <button type="button" class="btn-close btn-close-white" id="btn-close-chat"></button>
        </div>
        <div id="chat-content" class="card-body bg-light" style="height: 300px; overflow-y: auto; font-size: 0.9rem;">
            <div class="mb-2"><strong>Bot:</strong> Halo! Ada yang bisa saya bantu hari ini?</div>
        </div>
        <div class="card-footer bg-white p-2">
            <div class="input-group">
                <input type="text" id="input-pesan" class="form-control border-0" placeholder="Tulis pesan..." style="box-shadow: none;">
                <button class="btn btn-danger" id="btn-kirim"><i class="bi bi-send"></i></button>
            </div>
        </div>
    </div>

<script>
    // Ambil semua elemen yang diperlukan
    const btnsOpen = document.querySelectorAll('.btn-open-chat'); // Mengambil semua tombol dengan class ini
    const btnClose = document.getElementById('btn-close-chat');
    const chatBox = document.getElementById('chat-box');
    const chatContent = document.getElementById('chat-content');
    const inputPesan = document.getElementById('input-pesan');
    const btnKirim = document.getElementById('btn-kirim');

    // Fungsi untuk membuka chat
    btnsOpen.forEach(btn => {
        btn.onclick = () => { 
            chatBox.classList.remove('d-none'); 
            // Sembunyikan semua tombol buka saat chat terbuka
            btnsOpen.forEach(b => b.classList.add('d-none')); 
        };
    });

    // Fungsi untuk menutup chat
    btnClose.onclick = () => { 
        chatBox.classList.add('d-none'); 
        // Tampilkan kembali semua tombol buka
        btnsOpen.forEach(b => b.classList.remove('d-none')); 
    };

    async function kirimKeBot() {
        const pesan = inputPesan.value.trim();
        if (!pesan) return;

        // Tampilkan pesan user ke layar chat
        chatContent.innerHTML += `<div class="text-end mb-2"><span class="bg-white p-2 rounded shadow-sm d-inline-block text-dark">${pesan}</span></div>`;
        inputPesan.value = '';
        chatContent.scrollTop = chatContent.scrollHeight;

        try {
            // Helper untuk ambil CSRF cookie (nama cookie diset di app/Config/Security.php)
            function getCookie(name) {
                const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
                return v ? decodeURIComponent(v[2]) : null;
            }

            // Menembak ke rute internal Vercel yang sudah didaftarkan di Routes.php
            const response = await fetch('<?= base_url("api/chatbot"); ?>', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': getCookie('csrf_cookie_name') || ''
                },
                credentials: 'same-origin',
                // Mengirim data dengan format x-www-form-urlencoded agar terbaca oleh getPost() di CI4
                body: 'pesan=' + encodeURIComponent(pesan)
            });
            
            if (!response.ok) throw new Error('Server error');
            
            const data = await response.json();
            
            // Tampilkan balasan otomatis dari Controller Chatbot.php
            chatContent.innerHTML += `<div class="mb-2"><strong>Bot:</strong> <span class="bg-danger text-white p-2 rounded shadow-sm d-inline-block">${data.balasan}</span></div>`;
            chatContent.scrollTop = chatContent.scrollHeight;
        } catch (err) {
            console.error('Error Chatbot:', err);
            chatContent.innerHTML += `<div class="text-center small text-muted">Bot sedang tidak merespon...</div>`;
            chatContent.scrollTop = chatContent.scrollHeight;
        }
    }

    btnKirim.onclick = kirimKeBot;
    inputPesan.onkeypress = (e) => { if(e.key === 'Enter') kirimKeBot(); };
</script>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    let keranjang = JSON.parse(localStorage.getItem('keranjang_jayamotor')) || [];

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    };

    // 1. Fungsi Tambah (Utama)
    function tambahKeranjang(id, nama, harga, stokMax) {
        if (stokMax <= 0) {
            Swal.fire('Maaf', 'Stok barang sedang habis', 'error');
            return;
        }

        let item = keranjang.find(i => i.id_sparepart === id);
        if (item) {
            if (item.qty < stokMax) {
                item.qty += 1;
            } else {
                Swal.fire('Limit Stok', 'Anda sudah mengambil semua stok tersedia', 'warning');
                return;
            }
        } else {
            keranjang.push({ id_sparepart: id, nama: nama, harga: harga, qty: 1, stok: stokMax });
        }
        
        simpanDanRender();
        Swal.fire({ icon: 'success', title: 'Masuk Keranjang', timer: 800, showConfirmButton: false });
    }

    // 2. Fungsi Kurangi 1 by 1
    function kurangiBarang(id) {
        let index = keranjang.findIndex(i => i.id_sparepart === id);
        if (index !== -1) {
            keranjang[index].qty -= 1;
            if (keranjang[index].qty <= 0) {
                keranjang.splice(index, 1); // Hapus jika nol
            }
        }
        simpanDanRender();
    }

    // 3. Fungsi Tambah 1 by 1 (Dari dalam Cart)
    function tambahBarangSatu(id) {
        let item = keranjang.find(i => i.id_sparepart === id);
        if (item && item.qty < item.stok) {
            item.qty += 1;
            simpanDanRender();
        } else {
            Swal.fire('Stok Terbatas', 'Tidak bisa menambah lebih banyak', 'warning');
        }
    }

    // 4. Fungsi Kosongkan Keranjang
    function clearKeranjang() {
        Swal.fire({
            title: 'Kosongkan?',
            text: "Semua barang di keranjang akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus Semua'
        }).then((result) => {
            if (result.isConfirmed) {
                keranjang = [];
                simpanDanRender();
            }
        });
    }

    // 5. Fungsi Render Tampilan
    function simpanDanRender() {
        localStorage.setItem('keranjang_jayamotor', JSON.stringify(keranjang));
        
        let html = '';
        let totalHarga = 0;
        let totalQty = 0;

        if (keranjang.length === 0) {
            html = '<tr><td colspan="3" class="text-center text-muted py-4">Keranjang kosong</td></tr>';
        } else {
            keranjang.forEach(item => {
                let sub = item.harga * item.qty;
                totalHarga += sub;
                totalQty += item.qty;

                html += `
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">${item.nama}</div>
                            <div class="small text-muted">${formatRupiah(item.harga)}</div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group border rounded-pill overflow-hidden shadow-sm">
                                <button class="btn btn-sm btn-light px-3" onclick="kurangiBarang(${item.id_sparepart})">-</button>
                                <span class="btn btn-sm btn-white disabled fw-bold text-dark px-3">${item.qty}</span>
                                <button class="btn btn-sm btn-light px-3" onclick="tambahBarangSatu(${item.id_sparepart})">+</button>
                            </div>
                        </td>
                        <td class="text-end fw-bold text-danger">${formatRupiah(sub)}</td>
                    </tr>
                `;
            });
        }

        document.getElementById('isi-keranjang').innerHTML = html;
        const jumlahDesktop = document.getElementById('jumlah-keranjang-desktop');
        const jumlahMobile = document.getElementById('jumlah-keranjang-mobile');
        if (jumlahDesktop) jumlahDesktop.innerText = totalQty;
        if (jumlahMobile) jumlahMobile.innerText = totalQty;
        document.getElementById('total-harga').innerText = formatRupiah(totalHarga);
    }

    // Panggil saat load
    document.addEventListener("DOMContentLoaded", function() {
        // Migration: Clear localStorage jika masih pakai struktur lama (field 'id' bukan 'id_sparepart')
        let savedKeranjang = localStorage.getItem('keranjang_jayamotor');
        if (savedKeranjang) {
            let tempKeranjang = JSON.parse(savedKeranjang);
            if (tempKeranjang.length > 0 && tempKeranjang[0].id && !tempKeranjang[0].id_sparepart) {
                // Struktur lama ditemukan, hapus dan reset
                localStorage.removeItem('keranjang_jayamotor');
                keranjang = [];
                console.log('Struktur keranjang lama dihapus. Silakan refresh halaman.');
            }
        }
        simpanDanRender();
    });

    // Fungsi Checkout ke WhatsApp
    function checkoutWA() {
        const nama = document.getElementById('nama_pemesan').value;
        const metode = document.getElementById('metode_ambil').value;

        if (keranjang.length === 0) {
            Swal.fire('Opps!', 'Keranjang Anda masih kosong', 'warning');
            return;
        }
        if (nama === "") {
            Swal.fire('Data Belum Lengkap', 'Mohon isi nama Anda terlebih dahulu', 'info');
            return;
        }

        let pesan = `*PESANAN BARU - NEW JAYA MOTOR*\n`;
        pesan += `------------------------------------------\n`;
        pesan += `*Nama:* ${nama}\n`;
        pesan += `*Metode:* ${metode}\n`;
        pesan += `------------------------------------------\n\n`;
        
        let total = 0;
        keranjang.forEach((item, index) => {
            let sub = item.harga * item.qty;
            pesan += `${index + 1}. *${item.nama}*\n`;
            pesan += `   ${item.qty} x ${formatRupiah(item.harga)} = ${formatRupiah(sub)}\n`;
            total += sub;
        });

        pesan += `\n*TOTAL PEMBAYARAN: ${formatRupiah(total)}*`;
        pesan += `\n\nMohon dicek ketersediaan barangnya ya min. Terima kasih!`;

        // Kirim data checkout ke server untuk record pesanan
        let checkoutData = {
            nama_customer: nama,
            metode_pengambilan: metode,
            keranjang: keranjang,
            total: total
        };

        // AJAX request untuk menyimpan pesanan
        function getCookie(name) {
            const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? decodeURIComponent(v[2]) : null;
        }

        fetch('<?= base_url("index/checkout"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCookie('csrf_cookie_name') || ''
            },
            credentials: 'same-origin',
            body: JSON.stringify(checkoutData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil!',
                    text: 'Pesanan Anda telah dikirim ke WhatsApp dan menunggu persetujuan admin. Terima kasih!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc2626'
                }).then(() => {
                    localStorage.removeItem('keranjang_jayamotor');
                    keranjang = [];
                    simpanDanRender();
                    document.getElementById('nama_pemesan').value = '';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat memproses pesanan',
                    confirmButtonColor: '#dc2626'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Terjadi kesalahan jaringan', 'error');
        });

        let noWA = "6281234567801"; 
        window.open(`https://wa.me/${noWA}?text=${encodeURIComponent(pesan)}`, '_blank');
    }

    // Panggil fungsi saat halaman pertama kali dimuat agar keranjang yang tersimpan muncul
    // (Sudah dipanggil oleh listener migrasi di atas)
</script>

</body>
</html>