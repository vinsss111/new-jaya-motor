<?php

namespace App\Controllers;

use App\Models\SparepartModel;

class Index extends BaseController
{
    protected $sparepartModel;

    public function __construct()
    {
        // Memuat model di CI4 via properti class
        $this->sparepartModel = new SparepartModel();
    }

    public function index()
    {
        $data['spareparts'] = $this->sparepartModel->get_all_spareparts();
        return view('Index', $data); // Di CI4 menggunakan return view()
    }

    public function checkout()
    {
        // CI4 Response Service untuk JSON Header
        $response = service('response');
        $response->setContentType('application/json');

        // Mengambil raw input stream (JSON payload) di CI4
        $rawInput = $this->request->getBody();
        $data     = json_decode($rawInput, true);

        if (!empty($data['keranjang'])) {
            $insert = [
                'nama_customer'      => $data['nama_customer'],
                'metode_pengambilan' => $data['metode_pengambilan'],
                'item_barang'        => json_encode($data['keranjang']),
                'total_bayar'        => $data['total'],
                'status'             => 'pending',
                'tanggal_pesan'      => date('Y-m-d H:i:s')
            ];

            // Menggunakan Query Builder CI4 via instance DB global
            $db = \Config\Database::connect();
            if ($db->table('pesanan')->insert($insert)) {
                return $response->setJSON(['status' => 'success', 'message' => 'Pesanan berhasil dicatat, menunggu persetujuan admin']);
            } else {
                return $response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan pesanan']);
            }
        } else {
            return $response->setJSON(['status' => 'error', 'message' => 'Keranjang kosong']);
        }
    }

}