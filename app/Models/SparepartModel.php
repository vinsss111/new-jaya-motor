<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartModel extends Model
{
    protected $table            = 'spareparts';
    protected $primaryKey       = 'id_sparepart';
    protected $returnType       = 'array';
    
    // Wajib didaftarkan agar bisa insert/update via model CI4
    protected $allowedFields    = ['kode_barang', 'nama_barang', 'kategori', 'stok', 'harga', 'gambar'];

    // ==========================================
    // BAGIAN MASTER DATA SPAREPART
    // ==========================================

    public function get_all_spareparts()
    {
        return $this->orderBy('id_sparepart', 'DESC')->findAll();
    }

    public function get_sparepart_by_id($id)
    {
        return $this->find($id);
    }

    public function insert_sparepart($data)
    {
        return $this->insert($data);
    }

    public function update_sparepart($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_sparepart($id)
    {
        return $this->delete($id);
    }

    // ==========================================
    // BAGIAN TRANSAKSI INVENTORY (STOK)
    // ==========================================

    public function catat_barang_masuk($data_masuk, $id_sparepart, $qty)
    {
        $db = \Config\Database::connect();
        
        // 1. Insert riwayat ke tabel barang_masuk
        $db->table('barang_masuk')->insert($data_masuk);
        
        // 2. Tambahkan stok di tabel spareparts
        $this->where('id_sparepart', $id_sparepart)
             ->set('stok', 'stok+' . (int)$qty, false)
             ->update();
    }

    public function catat_barang_keluar($data_keluar, $id_sparepart, $qty)
    {
        $db = \Config\Database::connect();
        
        // 1. Insert riwayat ke tabel barang_keluar
        $db->table('barang_keluar')->insert($data_keluar);
        
        // 2. Kurangi stok di tabel spareparts
        $this->where('id_sparepart', $id_sparepart)
             ->set('stok', 'stok-' . (int)$qty, false)
             ->update();
    }

    public function get_log_masuk()
    {
        return $this->db->table('barang_masuk')
                    ->select('barang_masuk.*, spareparts.kode_barang, spareparts.nama_barang')
                    ->join('spareparts', 'spareparts.id_sparepart = barang_masuk.id_sparepart')
                    ->orderBy('tanggal', 'DESC')
                    ->get()
                    ->getResultArray();
    }

    public function get_log_keluar()
    {
        return $this->db->table('barang_keluar')
                    ->select('barang_keluar.*, spareparts.kode_barang, spareparts.nama_barang')
                    ->join('spareparts', 'spareparts.id_sparepart = barang_keluar.id_sparepart')
                    ->orderBy('tanggal', 'DESC')
                    ->get()
                    ->getResultArray();
    }

    // ==========================================
    // BAGIAN PESANAN (PENDING ORDERS)
    // ==========================================

    public function simpan_pesanan($data_pesanan)
    {
        return $this->db->table('pesanan')->insert($data_pesanan);
    }

    public function get_pesanan_pending()
    {
        return $this->db->table('pesanan')
                    ->orderBy('tanggal_pesan', 'DESC')
                    ->getWhere(['status' => 'pending'])
                    ->getResultArray();
    }

    public function get_all_pesanan()
    {
        return $this->db->table('pesanan')
                    ->orderBy('tanggal_pesan', 'DESC')
                    ->get()
                    ->getResultArray();
    }

    public function get_pesanan_by_id($id)
    {
        return $this->db->table('pesanan')
                    ->getWhere(['id_pesanan' => $id])
                    ->getRowArray();
    }

    public function approve_pesanan($id_pesanan)
    {
        $pesanan = $this->get_pesanan_by_id($id_pesanan);

        if ($pesanan) {
            $items = json_decode($pesanan['item_barang'], true);

            if (is_array($items) && count($items) > 0) {
                foreach ($items as $item) {
                    if (!isset($item['id_sparepart']) || !isset($item['qty']) || !isset($item['harga'])) {
                        continue;
                    }

                    $id_sparepart = $item['id_sparepart'];
                    $qty          = $item['qty'];
                    $harga        = $item['harga'];
                    $subtotal     = $harga * $qty;

                    $data_keluar = [
                        'id_sparepart'       => $id_sparepart,
                        'jumlah'             => $qty,
                        'tanggal'            => date('Y-m-d H:i:s'),
                        'total_harga'        => $subtotal,
                        'nama_customer'      => $pesanan['nama_customer'],
                        'metode_pengambilan' => $pesanan['metode_pengambilan']
                    ];

                    // Insert ke barang_keluar via Query Builder CI4
                    $this->db->table('barang_keluar')->insert($data_keluar);

                    // Kurangi stok barang
                    $this->where('id_sparepart', $id_sparepart)
                         ->set('stok', 'stok-' . (int)$qty, false)
                         ->update();
                }
            }

            // Update status pesanan menjadi approved
            return $this->db->table('pesanan')
                        ->where('id_pesanan', $id_pesanan)
                        ->update([
                            'status'          => 'approved',
                            'tanggal_approve' => date('Y-m-d H:i:s')
                        ]);
        }
        return false;
    }

    public function batalkan_pesanan($id_pesanan)
    {
        return $this->db->table('pesanan')
                    ->where('id_pesanan', $id_pesanan)
                    ->update([
                        'status'          => 'dibatalkan',
                        'tanggal_approve' => date('Y-m-d H:i:s')
                    ]);
    }
}