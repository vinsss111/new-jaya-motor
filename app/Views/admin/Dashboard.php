<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS New Jaya Motor - Management System</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/image/logo.png'); ?>">

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-active: #1e293b;
            --primary-red: #dc2626;
            --bg-body: #f1f5f9;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-body); 
            color: #334155;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: #94a3b8;
            padding: 1.5rem 1rem;
            z-index: 1000;
        }
        .sidebar .brand {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            padding-bottom: 2rem;
            border-bottom: 1px solid #1e293b;
            margin-bottom: 1.5rem;
        }
        .nav-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: block;
            color: #64748b;
        }
        .nav-item { margin-bottom: 0.5rem; }
        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: 0.2s;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background: var(--sidebar-active);
            color: white;
            border-left: 4px solid var(--primary-red);
        }
        .nav-link-custom i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* MAIN CONTENT */
        .content-wrapper {
            margin-left: 260px;
            padding: 2rem;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .badge-stock {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        /* Thumbnail Image */
        .img-zoomable {
            cursor: zoom-in;
            transition: transform 0.2s;
        }
        .img-zoomable:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <?php 
        // Tangkap parameter URL (passed from Controller in CI4)
        $page = isset($page) ? $page : 'dashboard'; 
    ?>

    <div class="sidebar d-flex flex-column">
        <div class="brand">
            <i class="bi bi-tools text-danger me-2"></i> New Jaya <span class="text-danger">Motor</span>
        </div>

        <span class="nav-label">Menu</span>
        <div class="nav-item">
            <a href="?p=dashboard" class="nav-link-custom <?= ($page == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Overview
            </a>
        </div>
        <div class="nav-item">
            <a href="?p=inventory" class="nav-link-custom <?= ($page == 'inventory') ? 'active' : '' ?>">
                <i class="bi bi-box-seam-fill"></i> Data Sparepart
            </a>
        </div>

        <span class="nav-label mt-4">Log Transaksi</span>
        <div class="nav-item">
            <a href="?p=masuk" class="nav-link-custom <?= ($page == 'masuk') ? 'active' : '' ?>">
                <i class="bi bi-arrow-down-left-circle-fill text-success"></i> Barang Masuk
            </a>
        </div>
        <div class="nav-item">
            <a href="?p=keluar" class="nav-link-custom <?= ($page == 'keluar') ? 'active' : '' ?>">
                <i class="bi bi-arrow-up-right-circle-fill text-danger"></i> Barang Keluar
            </a>
        </div>

        <span class="nav-label mt-4">Pesanan</span>
        <div class="nav-item">
            <a href="?p=pesanan" class="nav-link-custom <?= ($page == 'pesanan') ? 'active' : '' ?>">
                <i class="bi bi-clipboard-check text-warning"></i> Pesanan Pending
            </a>
        </div>

        <div class="mt-auto">
            <a href="<?= base_url('login/logout'); ?>" class="btn btn-outline-danger w-100 fw-bold">
                <i class="bi bi-door-open me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        
        <div class="top-bar">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    <?php 
                        if($page == 'inventory') echo "Master Data Inventory";
                        elseif($page == 'masuk') echo "Log Barang Masuk (Restock)";
                        elseif($page == 'keluar') echo "Log Barang Keluar (Terjual)";
                        elseif($page == 'pesanan') echo "Daftar Pesanan (Menunggu Persetujuan)";
                        else echo "Dashboard Overview";
                    ?>
                </h4>
                <p class="text-muted small mb-0">Sabtu, 18 April 2026 | Area: Batam</p>
            </div>
            <?php $session = service('session'); ?>
            <div class="d-flex align-items-center">
                <div class="text-end me-3 d-none d-md-block">
                    <h6 class="mb-0 fw-bold"><?= $session->get('nama_lengkap'); ?></h6>
                    <small class="text-muted">Administrator</small>
                </div>
                <img src="<?= base_url('assets/image/logo.png'); ?>" width="45" height="45" class="rounded-circle border">
            </div>
        </div>

        <?php if($page == 'inventory'): ?>
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Daftar Produk & Sparepart</h5>
                    <button class="btn btn-danger fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Barang
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th>KODE</th>
                                <th>FOTO</th>
                                <th>NAMA BARANG</th>
                                <th>KATEGORI</th>
                                <th>HARGA</th>
                                <th>STOK SAAT INI</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($spareparts as $brg): ?>
                            <tr>
                                <td class="fw-bold"><?= $brg['kode_barang']; ?></td>
                                <td>
                                    <img src="<?= base_url('uploads/'.$brg['gambar']); ?>" 
                                         width="50" height="50" 
                                         class="rounded border shadow-sm img-zoomable" 
                                         onclick="zoomGambar('<?= base_url('uploads/'.$brg['gambar']); ?>')">
                                </td>
                                <td class="fw-semibold text-dark"><?= $brg['nama_barang']; ?></td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary border"><?= $brg['kategori']; ?></span></td>
                                <td class="fw-bold text-success">Rp <?= number_format($brg['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if($brg['stok'] <= 5): ?>
                                        <span class="badge-stock bg-danger text-white px-3"><i class="bi bi-exclamation-circle me-1"></i> <?= $brg['stok']; ?></span>
                                    <?php else: ?>
                                        <span class="badge-stock bg-success bg-opacity-10 text-success px-3"><?= $brg['stok']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-light btn-sm text-primary border shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $brg['id_sparepart']; ?>" title="Edit Barang"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-light btn-sm text-danger border shadow-sm" onclick="konfirmasiHapus('<?= base_url('dashboard/hapus/'.$brg['id_sparepart']); ?>')" title="Hapus Barang"><i class="bi bi-trash3"></i></button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $brg['id_sparepart']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold">Edit Detail Barang</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?= base_url('dashboard/edit'); ?>" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body p-4">
                                                <input type="hidden" name="id_sparepart" value="<?= $brg['id_sparepart']; ?>">
                                                <input type="hidden" name="old_gambar" value="<?= $brg['gambar']; ?>">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Kode Barang</label>
                                                    <input type="text" name="kode_barang" class="form-control" value="<?= $brg['kode_barang']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Nama Barang</label>
                                                    <input type="text" name="nama_barang" class="form-control" value="<?= $brg['nama_barang']; ?>" required>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label small fw-bold">Kategori</label>
                                                        <input type="text" name="kategori" class="form-control" value="<?= $brg['kategori']; ?>" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label small fw-bold">Update Stok Manual</label>
                                                        <input type="number" name="stok" class="form-control" value="<?= $brg['stok']; ?>" required>
                                                        <small class="text-success" style="font-size: 10px;">*Akan terekam ke Log Masuk</small>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Harga Jual (Rp)</label>
                                                    <input type="number" name="harga" class="form-control" value="<?= $brg['harga']; ?>" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label small fw-bold d-block">Ganti Foto Produk (Opsional)</label>
                                                    <img src="<?= base_url('uploads/'.$brg['gambar']); ?>" width="60" class="mb-2 rounded border">
                                                    <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif($page == 'masuk'): ?>
            <div class="table-container">
                <div class="alert bg-opacity-10 mb-4 border-start">
                    <i class="bi bi-info-circle-fill text-success me-2"></i> 
                    <strong>Informasi:</strong> Data di bawah ini terekam otomatis saat Anda melakukan <b>Tambah Barang Baru</b> atau mengupdate/menambah jumlah stok melalui tombol <b>Edit</b>.
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>TANGGAL UPDATE</th>
                                <th>KODE</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH MASUK</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($log_masuk) && count($log_masuk) > 0):
                                    foreach($log_masuk as $masuk):
                            ?>
                            <tr>
                                <td><span class="badge bg-light text-dark border"><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y, H:i', strtotime($masuk['tanggal'])); ?></span></td>
                                <td class="fw-bold"><?= $masuk['kode_barang']; ?></td>
                                <td><?= $masuk['nama_barang']; ?></td>
                                <td><span class="text-success fw-bold">+ <?= $masuk['jumlah']; ?> Pcs</span></td>
                                <td><span class="badge bg-primary"><?= $masuk['keterangan']; ?></span></td>
                            </tr>
                            <?php 
                                    endforeach;
                                else:
                            ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada data barang masuk</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif($page == 'keluar'): ?>
            <div class="table-container">
                <div class="alert bg-opacity-10 mb-4 border-start">
                    <i class="bi bi-cart-check-fill text-danger me-2"></i> 
                    <strong>Informasi:</strong> Data di bawah ini terekam otomatis saat pelanggan melakukan <b>Checkout (Kirim ke WA)</b> di halaman utama. Stok barang terkait akan langsung berkurang.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>TANGGAL CHECKOUT</th>
                                <th>KODE</th>
                                <th>NAMA BARANG</th>
                                <th>JML KELUAR</th>
                                <th>TOTAL HARGA (RP)</th>
                                <th>NAMA CUSTOMER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($log_keluar) && count($log_keluar) > 0):
                                    foreach($log_keluar as $keluar):
                            ?>
                            <tr>
                                <td><span class="badge bg-light text-dark border"><i class="bi bi-clock-history me-1"></i> <?= date('d M Y, H:i', strtotime($keluar['tanggal'])); ?></span></td>
                                <td class="fw-bold"><?= $keluar['kode_barang']; ?></td>
                                <td class="fw-semibold"><?= $keluar['nama_barang']; ?></td>
                                <td><span class="text-danger fw-bold">- <?= $keluar['jumlah']; ?> Pcs</span></td>
                                <td class="fw-bold text-success">Rp <?= number_format($keluar['total_harga'], 0, ',', '.'); ?></td>
                                <td><i class="bi bi-person-circle text-muted me-1"></i> <?= $keluar['nama_customer']; ?></td>
                            </tr>
                            <?php 
                                    endforeach;
                                else:
                            ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada data barang keluar</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif($page == 'pesanan'): ?>
            <div class="table-container">
                <div class="alert bg-opacity-10 mb-4 border-start">
                    <i class="bi bi-info-circle-fill text-info me-2"></i> 
                    <strong>Informasi:</strong> Kelola semua pesanan pelanggan. <b>Approve</b> untuk mencatat sebagai penjualan dan kurangi stok, atau <b>Batalkan</b> jika pelanggan tidak jadi membeli.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>TANGGAL PESANAN</th>
                                <th>NAMA PELANGGAN</th>
                                <th>METODE AMBIL</th>
                                <th>DETAIL BARANG</th>
                                <th>TOTAL (Rp)</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($pesanan_list) && count($pesanan_list) > 0):
                                    foreach($pesanan_list as $pesanan):
                                        $items = json_decode($pesanan['item_barang'], true);
                                        
                                        // Tentukan warna badge berdasarkan status
                                        if ($pesanan['status'] == 'pending') {
                                            $badge_class = 'bg-warning text-dark';
                                            $badge_text = 'Menunggu';
                                        } elseif ($pesanan['status'] == 'approved') {
                                            $badge_class = 'bg-success';
                                            $badge_text = 'Disetujui';
                                        } else {
                                            $badge_class = 'bg-danger';
                                            $badge_text = 'Dibatalkan';
                                        }
                            ?>
                            <tr>
                                <td><span class="badge bg-light text-dark border"><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y, H:i', strtotime($pesanan['tanggal_pesan'])); ?></span></td>
                                <td class="fw-bold"><?= $pesanan['nama_customer']; ?></td>
                                <td><?= $pesanan['metode_pengambilan']; ?></td>
                                <td>
                                    <small>
                                        <?php if(is_array($items)): foreach($items as $item): ?>
                                            <div><?= $item['qty']; ?>x <?= $item['nama']; ?></div>
                                        <?php endforeach; endif; ?>
                                    </small>
                                </td>
                                <td class="fw-bold text-success">Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.'); ?></td>
                                <td class="text-center"><span class="badge <?= $badge_class; ?>"><?= $badge_text; ?></span></td>
                                <td class="text-center">
                                    <?php if ($pesanan['status'] == 'pending'): ?>
                                        <a href="<?= base_url('dashboard/approve_pesanan/'.$pesanan['id_pesanan']); ?>" class="btn btn-sm btn-success me-1" title="Approve Pesanan" onclick="return confirm('Approve pesanan ini?')"><i class="bi bi-check-circle"></i> Approve</a>
                                        <a href="<?= base_url('dashboard/batalkan_pesanan/'.$pesanan['id_pesanan']); ?>" class="btn btn-sm btn-danger" title="Batalkan Pesanan" onclick="return confirm('Batalkan pesanan ini?')"><i class="bi bi-x-circle"></i> Batalkan</a>
                                    <?php elseif ($pesanan['status'] == 'approved'): ?>
                                        <span class="text-success fw-bold"><i class="bi bi-check-all me-1"></i>Sudah Disetujui</span>
                                    <?php else: ?>
                                        <span class="text-danger fw-bold"><i class="bi bi-x-circle me-1"></i>Sudah Dibatalkan</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php 
                                    endforeach;
                                else:
                            ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Tidak ada pesanan</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else: ?>
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="bi bi-box-seam-fill text-primary fs-1 mb-2"></i>
                        <h6 class="text-muted fw-bold">Total Macam Sparepart</h6>
                        <h2 class="fw-bold mb-0"><?= count($spareparts); ?> Item</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-2"></i>
                        <h6 class="text-muted fw-bold">Peringatan Stok Tipis</h6>
                        <h2 class="fw-bold mb-0 text-danger">Buka Data Sparepart</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-dark text-white">
                        <i class="bi bi-graph-up-arrow text-success fs-1 mb-2"></i>
                        <h6 class="text-light fw-bold">Status Sistem</h6>
                        <h4 class="fw-bold text-success mb-0">Online & Siap</h4>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">Tambah Sparepart Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('dashboard/tambah'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="alert alert-warning py-2 small">
                            <i class="bi bi-info-circle me-1"></i> Menyimpan barang baru otomatis akan tercatat di <b>Log Barang Masuk</b>.
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" required placeholder="Contoh: KVB-001">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required placeholder="Contoh: V-Belt Vario">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Kategori</label>
                                <input type="text" name="kategori" class="form-control" required placeholder="Contoh: CVT">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Harga Jual (Rp)</label>
                                <input type="number" name="harga" class="form-control" required placeholder="Contoh: 150000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" required placeholder="Masukkan jumlah stok saat ini">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Upload Foto Barang</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Simpan Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalZoom" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-body p-0 text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    <img src="" id="imgZoomTarget" class="img-fluid rounded shadow-lg border border-3 border-white">
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <?php $session = service('session'); ?>

    <script>
        // Zoom Gambar
        function zoomGambar(src) {
            document.getElementById('imgZoomTarget').src = src;
            var myModal = new bootstrap.Modal(document.getElementById('modalZoom'));
            myModal.show();
        }

        // SweetAlert Notifikasi PHP
        <?php if($session->getFlashdata('sukses')): ?>
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= $session->getFlashdata('sukses'); ?>', timer: 2000, showConfirmButton: false });
        <?php endif; ?>

        // Confirm Hapus
        function konfirmasiHapus(urlDelete) {
            Swal.fire({
                title: 'Hapus Barang?',
                text: "Data ini tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlDelete;
                }
            })
        }
    </script>
</body>
</html>