<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Halaman Utama Katalog (Index)
$routes->get('/', 'Index::index');
$routes->post('index/checkout', 'Index::checkout');

// Halaman Autentikasi (Login)
$routes->get('login', 'Login::index');
$routes->post('login/proses', 'Login::proses');
$routes->get('login/logout', 'Login::logout');
$routes->get('login/reset_password', 'Login::reset_password');
$routes->post('login/proses_reset', 'Login::proses_reset');
$routes->post('login/cek_password_lama', 'Login::cek_password_lama');

// Halaman Manajemen Panel (Dashboard)
$routes->get('dashboard', 'Dashboard::index');
$routes->post('dashboard/tambah', 'Dashboard::tambah');
$routes->post('dashboard/edit', 'Dashboard::edit');
$routes->get('dashboard/hapus/(:num)', 'Dashboard::hapus/$1');
$routes->get('dashboard/approve_pesanan/(:num)', 'Dashboard::approve_pesanan/$1');
$routes->get('dashboard/batalkan_pesanan/(:num)', 'Dashboard::batalkan_pesanan/$1');

//chatbot
$routes->post('api/chatbot', 'Chatbot::index');