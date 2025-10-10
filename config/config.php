<?php
// ==========================
// Konfigurasi Database
// ==========================
// Host server database (default: localhost)
define('DB_HOST', 'localhost');
// Username untuk koneksi database
define('DB_USER', 'root');
// Password untuk koneksi database
define('DB_PASS', '');
// Nama database yang digunakan
define('DB_NAME', 'ecommerce');

// ==========================
// Konfigurasi Path Project
// ==========================
// APPROOT = path absolut ke folder "app"
define('APPROOT', __DIR__ . '/../app');

// ==========================
// Konfigurasi Base URL
// ==========================
// BASEURL digunakan untuk membuat link absolut di project
// Sesuaikan dengan nama folder project di htdocs/ (XAMPP) atau www/ (Laragon)
define('BASEURL', 'http://localhost:3000/E-Commerce/public');
