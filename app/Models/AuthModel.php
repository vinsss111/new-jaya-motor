<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id'; // Sesuaikan jika primary key di tabel users berbeda
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'password', 'email', 'nama']; // Sesuaikan dengan kolom tabel users kamu

    /**
     * Mengambil data user berdasarkan username
     */
    public function get_user_by_username($username)
    {
        return $this->where('username', $username)->first();
    }
}