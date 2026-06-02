<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Login extends BaseController
{
    protected $authModel;
    protected $session;

    public function __construct()
    {
        helper(['form', 'session']);
        $this->authModel = new AuthModel();
        $this->session   = service('session'); // Inisialisasi Session Service CI4
    }

    public function index()
    {
        // Pengecekan session di CI4
        if ($this->session->get('id_user')) {
            return redirect()->to('dashboard');
        }
        return view('admin/Login');
    }

    public function proses()
    {
        // Menggunakan $this->request->getPost() sebagai pengganti $this->input->post()
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->authModel->get_user_by_username($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session_data = [
                    'id_user'      => $user['id_user'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'] ?? $user['nama'] // Menyesuaikan jika nama kolom berbeda
                ];
                $this->session->set($session_data);
                
                $this->session->setFlashdata('sukses', 'Selamat datang, ' . $this->session->get('nama_lengkap'));
                return redirect()->to('dashboard');
            } else {
                $this->session->setFlashdata('error', 'Password yang Anda masukkan salah!');
                return redirect()->to('Login');
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('Login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('Login');
    }

    public function reset_password()
    {
        return view('admin/Login_reset');
    }

    public function proses_reset()
    {
        $username        = $this->request->getPost('username');
        $password_lama   = $this->request->getPost('password_lama');
        $password_baru   = $this->request->getPost('password_baru');
        $konfirmasi_baru = $this->request->getPost('konfirmasi_baru');

        $user = $this->authModel->get_user_by_username($username);

        if ($user) {
            if (password_verify($password_lama, $user['password'])) {
                if ($password_baru === $konfirmasi_baru) {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    
                    $db = \Config\Database::connect();
                    $db->table('users')->where('username', $username)->update(['password' => $password_hash]);

                    $this->session->setFlashdata('sukses', 'Password berhasil diperbarui! Silakan Login.');
                    return redirect()->to('Login');
                } else {
                    $this->session->setFlashdata('error', 'Konfirmasi password baru tidak cocok!');
                    return redirect()->to('Login/reset_password');
                }
            } else {
                $this->session->setFlashdata('error', 'Password lama salah!');
                return redirect()->to('Login/reset_password');
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('Login/reset_password');
        }
    }

    public function cek_password_lama()
    {
        // Validasi request AJAX di CI4
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        }

        $username      = $this->request->getPost('username');
        $password_lama = $this->request->getPost('password_lama');

        $user = $this->authModel->get_user_by_username($username);

        if ($user && password_verify($password_lama, $user['password'])) {
            return $this->response->setJSON(['status' => 'match']);
        }
        
        return $this->response->setJSON(['status' => 'nomatch']);
    }
}