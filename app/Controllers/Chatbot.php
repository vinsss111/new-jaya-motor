<?php

namespace App\Controllers;

class Chatbot extends BaseController
{
    public function index()
    {
        // Terima POST baik dari AJAX biasa maupun fetch tanpa header X-Requested-With.
        if (! $this->request->is('post')) {
            return $this->response->setStatusCode(403)->setBody('Akses langsung tidak diizinkan');
        }

        $response = service('response');
        $response->setContentType('application/json');

        // Ambil input pesan dari user dan ubah ke huruf kecil semua
        $pesan_user = strtolower(trim($this->request->getPost('pesan') ?? ''));

        if (empty($pesan_user)) {
            return $response->setJSON(['status' => 'success', 'balasan' => 'Halo! Ada yang bisa saya bantu?']);
        }

        // KNOWLEDGE BASE CHATBOT (Daftar Kata Kunci & Jawaban Langsung di PHP)
        $rules = [
            'halo' => [
                'Halo! Selamat datang di New Jaya Motor Batam. Ada yang bisa kami bantu mengenai sparepart atau layanan motor Anda?',
                'Hai! Selamat datang di New Jaya Motor. Saya siap bantu cek stok, lokasi, atau cara pesan sparepart.',
                'Halo! Mau cari sparepart apa hari ini? Saya bantu pilih dan jelaskan cara checkout lewat WhatsApp.'
            ],
            'hai' => [
                'Hai! Silakan ketik pertanyaan seperti "stok", "lokasi", "cara pesan", atau "WhatsApp".',
                'Hai! Kalau Anda butuh bantuan memilih sparepart, tinggal ketik saja nama produknya atau kata kunci terkait.',
            ],
            'stok' => [
                'Untuk melihat ketersediaan stok, buka katalog sparepart di halaman utama. Kalau tersedia, langsung klik Tambah ke Keranjang.',
                'Stok bisa dilihat pada halaman katalog. Jika barang habis, kami juga bisa bantu pesankan Pre-Order untuk Anda.',
                'Semua stok tercantum di katalog. Barang yang tersedia bisa langsung dipesan melalui tombol Tambah ke Keranjang.'
            ],
            'katalog' => [
                'Katalog sparepart ada di halaman utama. Anda bisa lihat foto, harga, kategori, dan stok setiap item.',
                'Semua produk ditampilkan di katalog. Silakan cari berdasarkan kategori atau klik tombol Tambah untuk memasukkan ke keranjang.'
            ],
            'pre order' => [
                'Kalau sparepart yang Anda cari tidak ada di katalog, kami bisa bantu pesan Pre-Order. Silakan hubungi WhatsApp admin untuk detail lebih lanjut.',
                'Tidak menemukan barang di katalog? Tenang, kami bisa bantu pesankan sparepart yang spesifik melalui WhatsApp.'
            ],
            'alamat' => [
                'Alamat workshop kami: Tanjung Buntung, Kec. Bengkong, Kota Batam, Kepulauan Riau 29444.',
                'New Jaya Motor berada di Tanjung Buntung, Bengkong, Batam. Datang langsung untuk cek sparepart atau service motor.'
            ],
            'lokasi' => [
                'Workshop kami ada di Tanjung Buntung, Bengkong, Batam. Kunjungi langsung untuk melihat stock sparepart dan service motor.',
                'Anda bisa datang ke alamat Tanjung Buntung, Kec. Bengkong, Kota Batam. Kami siapkan pelayanan cepat dan ramah.'
            ],
            'whatsapp' => [
                'Untuk pesan dan tanya stok lebih cepat, klik tombol WhatsApp di website atau langsung hubungi admin via WA.',
                'Chat lewat WhatsApp untuk konfirmasi harga, stok, dan pre-order agar kami bisa bantu lebih cepat.'
            ],
            'kontak' => [
                'Kontak WhatsApp kami tersedia di bagian Kontak. Silakan kirim pesan untuk tanya stok, order, atau support service motor.',
                'Hubungi kami via WhatsApp untuk informasi lengkap tentang sparepart dan layanan motor di Batam.'
            ],
            'jam' => [
                'Kami buka setiap hari dari jam 09:00 sampai 20:00 WIB. Silakan datang pada jam kerja tersebut ya.',
                'Jam buka workshop New Jaya Motor: 09:00 - 20:00 WIB setiap hari.',
            ],
            'buka' => [
                'Workshop buka setiap hari jam 09:00 - 20:00 WIB. Waktu ini untuk konsultasi sparepart dan servis motor.',
                'Kami beroperasi setiap hari dari pagi hingga malam. Silakan datang atau chat WA untuk konfirmasi sebelum berkunjung.'
            ],
            'cara pesan' => [
                'Cara pesan: pilih sparepart di katalog, klik Tambah ke Keranjang, lalu buka keranjang dan isi nama. Setelah itu klik Checkout untuk kirim pesan ke WhatsApp.',
                'Pesan sparepart mudah: tambahkan barang ke keranjang, isi nama, pilih opsi pengiriman, lalu kirim ke WhatsApp admin.'
            ],
            'checkout' => [
                'Checkout akan mengirimkan ringkasan pesanan ke WhatsApp. Pastikan data nama dan alamat sudah benar sebelum kirim.',
                'Saat checkout, sistem akan membuat pesan otomatis untuk WhatsApp admin. Tinggal cek, lalu kirimkan pesanan Anda.'
            ],
            'bayar' => [
                'Pembayaran saat ini dilakukan tunai saat barang diambil di toko. Sistem kami mengutamakan pesan dulu baru bayar saat serah terima.',
                'Untuk pembayaran, Anda bisa COD tunai saat pengambilan barang di toko setelah pesanan disetujui admin.'
            ],
            'harga' => [
                'Harga sparepart tercantum di katalog sebagai harga terbarui. Jika Anda butuh diskon atau penawaran paket, tanya langsung via WhatsApp.',
                'Semua harga di website adalah harga pas. Jika ingin info harga khusus atau ongkir, silakan konfirmasi lewat WA.'
            ],
            'pengiriman' => [
                'Opsi pengiriman tersedia dengan Kurir Batam. Untuk estimasi ongkir dan waktu antar, chat WA admin saja.',
                'Anda bisa pilih Ambil di Toko atau Kirim Kurir Batam saat checkout. Info ongkir akan dikirim via WhatsApp.'
            ],
            'ambil' => [
                'Opsi Ambil di Toko memungkinkan Anda mengambil sendiri barang dari workshop kami di Batam.',
                'Kalau ingin langsung ambil di toko, pilih opsi Ambil di Toko saat checkout dan datang ke lokasi kami.'
            ],
            'kurir' => [
                'Opsi Kirim Kurir khusus untuk wilayah Batam. Pesan akan dikemas dan dikirim setelah admin konfirmasi.',
                'Bila pilih Kirim Kurir Batam, kami akan atur pengiriman dari workshop ke alamat Anda.'
            ],
            'mekanik' => [
                'Mekanik kami berpengalaman dan terbiasa menangani service motor serta penggantian sparepart dengan teliti.',
                'Tim mekanik New Jaya Motor ahli dalam perawatan motor. Kami juga siap bantu konsultasi suku cadang terbaik.'
            ],
            'service' => [
                'Selain sparepart, kami juga menyediakan service motor dengan tenaga mekanik yang profesional.',
                'Butuh service motor atau setting mesin? Kami melayani service dan sparepart dalam satu tempat.'
            ],
            'kualitas' => [
                'Kami hanya menggunakan sparepart grade A dan original agar motor Anda tetap awet dan aman.',
                'Kualitas adalah prioritas kami. Semua suku cadang yang kami jual dijaga mutu dan keasliannya.'
            ]
        ];

        $jawaban_ditemukan = null;

        // Mencocokkan kalimat user dengan kata kunci di atas
        foreach ($rules as $keyword => $jawaban) {
            if (strpos($pesan_user, $keyword) !== false) {
                $jawaban_ditemukan = is_array($jawaban) ? $jawaban[array_rand($jawaban)] : $jawaban;
                break; // Stop perulangan jika sudah ada kata kunci yang nyangkut
            }
        }

        // Jawaban cadangan jika tidak ada kata kunci yang cocok (Fallback)
        if (!$jawaban_ditemukan) {
            $jawaban_ditemukan = "Maaf, saya belum memahami pertanyaan Anda. Coba ketik kata kunci singkat seperti: 'stok', 'jam buka', 'lokasi', 'bayar', atau 'cara pesan'.";
        }

        return $response->setJSON([
            'status'  => 'success',
            'balasan' => $jawaban_ditemukan
        ]);
    }
}