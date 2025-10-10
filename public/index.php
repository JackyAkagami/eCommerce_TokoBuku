<?php
// ==========================
// Session Start
// ==========================
// Jika session belum berjalan, mulai session baru
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================
// Error Reporting
// ==========================
// Menampilkan semua error (berguna saat development)
// Jika di production, biasanya ini dimatikan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ==========================
// Load Initializer
// ==========================
// Memanggil init.php yang akan me-load config & core utama MVC
require_once dirname(__DIR__) . '/app/init.php';

// ==========================
// Jalankan Aplikasi
// ==========================
// Membuat instance App (router utama)
// App akan membaca URL, lalu memanggil controller, method, dan parameter yang sesuai
$app = new App();
