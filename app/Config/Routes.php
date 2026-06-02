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
$routes->post('Index/checkout', 'Index::checkout');

// Halaman Autentikasi Admin (Gunakan huruf kecil untuk URI demi standar web)
$routes->get('Login', 'Login::index');
$routes->post('Login/proses', 'Login::proses');
$routes->get('Login/logout', 'Login::logout');
$routes->get('Login/reset_password', 'Login::reset_password');
$routes->post('Login/proses_reset', 'Login::proses_reset');
$routes->post('Login/cek_password_lama', 'Login::cek_password_lama');

// Halaman Manajemen Panel (Dashboard Admin)
$routes->get('Dashboard', 'Dashboard::index');
$routes->post('Dashboard/tambah', 'Dashboard::tambah');
$routes->post('Dashboard/edit', 'Dashboard::edit');
$routes->get('Dashboard/hapus/(:num)', 'Dashboard::hapus/$1');
$routes->get('Dashboard/approve_pesanan/(:num)', 'Dashboard::approve_pesanan/$1');
$routes->get('Dashboard/batalkan_pesanan/(:num)', 'Dashboard::batalkan_pesanan/$1');

// Fitur Integrasi Chatbot AI
$routes->post('api/chatbot', 'Chatbot::index');