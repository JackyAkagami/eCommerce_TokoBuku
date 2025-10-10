<?php
// Memanggil file konfigurasi utama (isi: BASEURL, DB_HOST, DB_USER, dsb.)
require_once __DIR__ . '/../config/config.php';

// Load core utama MVC
// App.php  -> Kelas untuk routing (mengatur URL, controller, method, parameter)
// Controller.php -> Kelas dasar controller untuk memanggil model & view
// Database.php   -> Kelas untuk koneksi dan query database
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
