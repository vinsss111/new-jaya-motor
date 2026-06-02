<?php

namespace App\Controllers;

use App\Models\SparepartModel;

class Dashboard extends BaseController
{
    protected $sparepartModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session        = service('session');
        $this->sparepartModel = new SparepartModel();
        $this->db             = \Config\Database::connect();

        // Validasi login auth di constructor
        if (!$this->session->get('id_user')) {
            $this->session->setFlashdata('error', 'Silakan login terlebih dahulu!');
            // Gunakan exit/redirect di CI4 constructor dengan aman via script or middleware (disarankan pakai Filters nanti)
            header('Location: ' . base_url('login'));
            exit;
        }

        $this->ensure_pesanan_table();
    }

    private function ensure_pesanan_table()
    {
        // CI4 Forge / Database checking method
        if (!$this->db->tableExists('pesanan')) {
            $sql = "CREATE TABLE `pesanan` (
              `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
              `nama_customer` varchar(100) NOT NULL,
              `metode_pengambilan` varchar(50) NOT NULL,
              `item_barang` longtext NOT NULL COMMENT 'JSON array berisi detail barang',
              `total_bayar` int(11) NOT NULL,
              `status` enum('pending','approved','dibatalkan') NOT NULL DEFAULT 'pending',
              `tanggal_pesan` datetime NOT NULL,
              `tanggal_approve` datetime DEFAULT NULL,
              PRIMARY KEY (`id_pesanan`),
              KEY `status` (`status`),
              KEY `tanggal_pesan` (`tanggal_pesan`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            
            $this->db->query($sql);
        }
    }

    public function index()
    {
        // Mengambil query param (?p=xxx) di CI4
        $page = $this->request->getGet('p') ?? 'dashboard';
        
        $data['page']         = $page;
        $data['spareparts']   = $this->sparepartModel->get_all_spareparts();
        $data['log_masuk']    = $this->sparepartModel->get_log_masuk();
        $data['log_keluar']   = $this->sparepartModel->get_log_keluar();
        $data['pesanan_list'] = $this->sparepartModel->get_all_pesanan();
        
        if ($page === 'inventory') {
            $data['page_title'] = "Master Data Inventory";
        } elseif ($page === 'masuk') {
            $data['page_title'] = "Log Barang Masuk (Restock)";
        } elseif ($page === 'keluar') {
            $data['page_title'] = "Log Barang Keluar (Terjual)";
        } elseif ($page === 'pesanan') {
            $data['page_title'] = "Daftar Pesanan (Menunggu Persetujuan)";
        } else {
            $data['page_title'] = "Dashboard Overview";
        }

        return view('admin/dashboard', $data);
    }

    public function tambah()
    {
        $gambarName = 'default.png';

        // Mengambil validasi file upload native di CI4
        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Validasi tipe dan ukuran (maksimal 2MB)
            if (in_array($fileGambar->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif']) && $fileGambar->getSize() <= 2048 * 1024) {
                
                $gambarName = $fileGambar->getRandomName(); // Mirip encrypt_name = TRUE
                $fileGambar->move(ROOTPATH . 'public/uploads/', $gambarName); // Dipindah ke folder public/uploads/

            } else {
                $this->session->setFlashdata('error', 'Format gambar salah atau ukuran melebihi 2MB.');
                return redirect()->to('dashboard');
            }
        }

        $stok_awal = $this->request->getPost('stok');

        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $stok_awal,
            'gambar'      => $gambarName
        ];

        $this->sparepartModel->insert_sparepart($data);
        $id_barang = $this->sparepartModel->getInsertID(); // Dapatkan ID insert terbaru di CI4 Model
        
        if ($stok_awal > 0) {
            $data_masuk = [
                'id_sparepart' => $id_barang,
                'jumlah'       => $stok_awal,
                'tanggal'      => date('Y-m-d H:i:s'),
                'keterangan'   => 'Tambah Barang Baru'
            ];
            $this->db->table('barang_masuk')->insert($data_masuk);
        }
        
        $this->session->setFlashdata('sukses', 'Data barang berhasil ditambahkan!');
        return redirect()->to('dashboard');
    }

    public function edit()
    {
        $id         = $this->request->getPost('id_sparepart');
        $old_gambar = $this->request->getPost('old_gambar');
        $new_stok   = $this->request->getPost('stok');
        $gambarName = $old_gambar;

        $barang_lama = $this->sparepartModel->get_sparepart_by_id($id);
        $old_stok    = $barang_lama['stok'];

        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            if (in_array($fileGambar->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif']) && $fileGambar->getSize() <= 2048 * 1024) {
                
                $gambarName = $fileGambar->getRandomName();
                $fileGambar->move(ROOTPATH . 'public/uploads/', $gambarName);

                // Hapus gambar lama
                if ($old_gambar !== 'default.png' && file_exists(ROOTPATH . 'public/uploads/' . $old_gambar)) {
                    unlink(ROOTPATH . 'public/uploads/' . $old_gambar);
                }
            } else {
                $this->session->setFlashdata('error', 'Format gambar salah atau ukuran melebihi 2MB.');
                return redirect()->to('dashboard');
            }
        }

        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $new_stok,
            'gambar'      => $gambarName
        ];

        $this->sparepartModel->update_sparepart($id, $data);
        
        if ($new_stok != $old_stok) {
            $selisih_stok = $new_stok - $old_stok;
            $data_masuk = [
                'id_sparepart' => $id,
                'jumlah'       => abs($selisih_stok),
                'tanggal'      => date('Y-m-d H:i:s'),
                'keterangan'   => 'Update Stok Manual'
            ];
            $this->db->table('barang_masuk')->insert($data_masuk);
        }
        
        $this->session->setFlashdata('sukses', 'Data barang berhasil diperbarui!');
        return redirect()->to('dashboard');
    }

    public function hapus($id)
    {
        $item = $this->sparepartModel->get_sparepart_by_id($id);
        
        if ($item['gambar'] !== 'default.png' && file_exists(ROOTPATH . 'public/uploads/' . $item['gambar'])) {
            unlink(ROOTPATH . 'public/uploads/' . $item['gambar']);
        }

        $this->sparepartModel->delete_sparepart($id);
        $this->session->setFlashdata('sukses', 'Data barang beserta gambar berhasil dihapus!');
        return redirect()->to('dashboard');
    }

    public function approve_pesanan($id)
    {
        $this->sparepartModel->approve_pesanan($id);
        $this->session->setFlashdata('sukses', 'Pesanan berhasil disetujui! Barang telah dicatat di Barang Keluar dan stok berkurang.');
        return redirect()->to('dashboard?p=pesanan');
    }

    public function batalkan_pesanan($id)
    {
        $this->sparepartModel->batalkan_pesanan($id);
        $this->session->setFlashdata('sukses', 'Pesanan berhasil dibatalkan!');
        return redirect()->to('dashboard?p=pesanan');
    }
}