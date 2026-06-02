<?php

/**
 * DEBUG & TEST CONTROLLER
 * File ini untuk testing dan debugging order approval workflow
 * 
 * CARA PAKAI:
 * 1. Rename file ini ke 'Debug.php'
 * 2. Akses di browser: base_url/debug/test_approval_flow
 * 3. Atau: base_url/debug/check_pesanan_structure
 * 
 * JANGAN LUPA HAPUS FILE INI SETELAH SELESAI TESTING!
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class DebugController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_sparepart');
    }

    // Test struktur data di pesanan
    public function check_pesanan_structure($id_pesanan = null) {
        if (!$id_pesanan) {
            echo "<h2>Test Pesanan Structure</h2>";
            echo "<p>Penggunaan: /debug/check_pesanan_structure/[ID_PESANAN]</p>";
            
            // Get latest pesanan
            $query = $this->db->select('id_pesanan, nama_customer, item_barang, status')
                              ->from('pesanan')
                              ->order_by('tanggal_pesan', 'DESC')
                              ->limit(5)
                              ->get();
            
            if ($query->num_rows() > 0) {
                echo "<h3>5 Pesanan Terakhir:</h3>";
                echo "<ul>";
                foreach ($query->result_array() as $row) {
                    echo "<li>";
                    echo "ID: " . $row['id_pesanan'] . " | ";
                    echo "Nama: " . $row['nama_customer'] . " | ";
                    echo "Status: " . $row['status'] . " | ";
                    echo "<a href='" . base_url('debug/check_pesanan_structure/' . $row['id_pesanan']) . "'>CHECK</a>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            return;
        }

        // Ambil pesanan berdasarkan ID
        $pesanan = $this->Model_sparepart->get_pesanan_by_id($id_pesanan);
        
        if (!$pesanan) {
            echo "<h2 style='color:red;'>Pesanan ID " . $id_pesanan . " tidak ditemukan!</h2>";
            return;
        }

        echo "<h2>Pesanan ID: " . $pesanan['id_pesanan'] . "</h2>";
        echo "<p><strong>Nama Customer:</strong> " . $pesanan['nama_customer'] . "</p>";
        echo "<p><strong>Status:</strong> " . $pesanan['status'] . "</p>";
        
        echo "<h3>Raw JSON Data:</h3>";
        echo "<pre>" . htmlspecialchars($pesanan['item_barang']) . "</pre>";
        
        echo "<h3>Decoded Items:</h3>";
        $items = json_decode($pesanan['item_barang'], true);
        
        if (!is_array($items)) {
            echo "<p style='color:red;'>ERROR: item_barang bukan valid JSON!</p>";
            return;
        }

        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>id_sparepart</th><th>nama</th><th>harga</th><th>qty</th><th>stok</th><th>Status</th></tr>";
        
        foreach ($items as $item) {
            $status = isset($item['id_sparepart']) ? "✓ OK" : "✗ MISSING id_sparepart";
            $statusColor = isset($item['id_sparepart']) ? "green" : "red";
            
            echo "<tr>";
            echo "<td style='color:" . $statusColor . ";'>" . (isset($item['id_sparepart']) ? $item['id_sparepart'] : 'N/A') . "</td>";
            echo "<td>" . (isset($item['nama']) ? $item['nama'] : 'N/A') . "</td>";
            echo "<td>" . (isset($item['harga']) ? $item['harga'] : 'N/A') . "</td>";
            echo "<td>" . (isset($item['qty']) ? $item['qty'] : 'N/A') . "</td>";
            echo "<td>" . (isset($item['stok']) ? $item['stok'] : 'N/A') . "</td>";
            echo "<td style='color:" . $statusColor . ";'>" . $status . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Test approve
        echo "<h3>Test Approve:</h3>";
        echo "<a href='" . base_url('debug/test_approve/' . $pesanan['id_pesanan']) . "' style='padding:10px; background-color:#4CAF50; color:white; text-decoration:none;'>TEST APPROVE</a>";
    }

    // Test approve function
    public function test_approve($id_pesanan = null) {
        if (!$id_pesanan) {
            echo "<p>ID pesanan tidak ada</p>";
            return;
        }

        echo "<h2>Testing Approve untuk Pesanan ID: " . $id_pesanan . "</h2>";

        // Get pesanan before approve
        $pesanan_before = $this->Model_sparepart->get_pesanan_by_id($id_pesanan);
        echo "<p><strong>Status Sebelum:</strong> " . $pesanan_before['status'] . "</p>";

        // Test approve
        $result = $this->Model_sparepart->approve_pesanan($id_pesanan);
        
        if ($result) {
            echo "<p style='color:green;'><strong>✓ Approve berhasil dijalankan</strong></p>";
            
            // Get pesanan after approve
            $pesanan_after = $this->Model_sparepart->get_pesanan_by_id($id_pesanan);
            echo "<p><strong>Status Sesudah:</strong> " . $pesanan_after['status'] . "</p>";
            
            // Check barang_keluar
            $query = $this->db->select('*')
                              ->from('barang_keluar')
                              ->where('nama_customer', $pesanan_before['nama_customer'])
                              ->order_by('tanggal', 'DESC')
                              ->limit(10)
                              ->get();
            
            echo "<h3>Barang Keluar yang dibuat:</h3>";
            if ($query->num_rows() > 0) {
                echo "<p style='color:green;'><strong>✓ " . $query->num_rows() . " record barang_keluar ditemukan</strong></p>";
                echo "<table border='1' cellpadding='5' cellspacing='0'>";
                echo "<tr><th>id_keluar</th><th>id_sparepart</th><th>jumlah</th><th>tanggal</th><th>total_harga</th></tr>";
                foreach ($query->result_array() as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_keluar'] . "</td>";
                    echo "<td>" . $row['id_sparepart'] . "</td>";
                    echo "<td>" . $row['jumlah'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['total_harga'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color:red;'><strong>✗ Tidak ada record barang_keluar ditemukan!</strong></p>";
            }
            
        } else {
            echo "<p style='color:red;'><strong>✗ Approve GAGAL</strong></p>";
        }

        echo "<p><a href='" . base_url('debug/check_pesanan_structure/' . $id_pesanan) . "'>Kembali</a></p>";
    }

    // Check stock changes
    public function check_stock_changes($id_sparepart = null) {
        if (!$id_sparepart) {
            echo "<h2>Check Stock Changes</h2>";
            echo "<p>Penggunaan: /debug/check_stock_changes/[ID_SPAREPART]</p>";
            return;
        }

        $query = $this->db->select('*')
                          ->from('spareparts')
                          ->where('id_sparepart', $id_sparepart)
                          ->get();

        if ($query->num_rows() == 0) {
            echo "<p style='color:red;'>Sparepart ID " . $id_sparepart . " tidak ditemukan!</p>";
            return;
        }

        $sparepart = $query->row_array();
        echo "<h2>Sparepart: " . $sparepart['nama_barang'] . "</h2>";
        echo "<p><strong>Stock Saat Ini:</strong> " . $sparepart['stok'] . "</p>";

        // Check barang_keluar untuk sparepart ini
        $query = $this->db->select('SUM(jumlah) as total_keluar')
                          ->from('barang_keluar')
                          ->where('id_sparepart', $id_sparepart)
                          ->get();

        $result = $query->row_array();
        echo "<p><strong>Total Keluar (dari barang_keluar):</strong> " . ($result['total_keluar'] ?? 0) . "</p>";
    }

}

/* End of file Debug.php */
/* Location: ./application/controllers/Debug.php */
