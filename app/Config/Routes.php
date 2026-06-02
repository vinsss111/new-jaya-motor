<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// 1. Pengaturan Konfigurasi Utama Router
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Index');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);

// Mengaktifkan Override 404 agar tidak memakai template bawaan jika error
$routes->set404Override();
// Halaman Utama Katalog & Fitur Pemesanan Publik
$routes->get('/', 'Index::index');      
$routes->post('index/checkout', 'Index::checkout');

// Halaman Autentikasi Admin (Gunakan huruf kecil untuk URI demi standar web)
$routes->get('login', 'Login::index');
$routes->post('login/proses', 'Login::proses');
$routes->get('login/logout', 'Login::logout');  
$routes->get('login/reset_password', 'Login::reset_password');
$routes->post('login/proses_reset', 'Login::proses_reset');
$routes->post('login/cek_password_lama', 'Login::cek_password_lama');

// Halaman Manajemen Panel (Dashboard Admin)
$routes->get('dashboard', 'Dashboard::index');
$routes->post('dashboard/tambah', 'Dashboard::tambah');
$routes->post('dashboard/edit', 'Dashboard::edit');
$routes->get('dashboard/hapus/(:num)', 'Dashboard::hapus/$1');
$routes->get('dashboard/approve_pesanan/(:num)', 'Dashboard::approve_pesanan/$1');
$routes->get('dashboard/batalkan_pesanan/(:num)', 'Dashboard::batalkan_pesanan/$1');

// Fitur Integrasi Chatbot AI
$routes->post('api/chatbot', 'Chatbot::index');