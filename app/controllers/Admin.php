<?php
// Kelas Admin adalah controller yang khusus digunakan untuk halaman admin
class Admin extends Controller {

    // Konstruktor dijalankan otomatis setiap kali class dipanggil
    public function __construct() {
        // Cek apakah user sudah login atau belum
        if (!isset($_SESSION['user'])) {
            // Jika belum login, alihkan ke halaman home
            header('Location: ' . BASEURL . '/home');
            exit; // hentikan eksekusi script
        }

        // Cek apakah role user adalah admin
        if ($_SESSION['user']['role'] !== 'admin') {
            // Jika bukan admin, alihkan ke halaman home
            header('Location: ' . BASEURL . '/home');
            exit; // hentikan eksekusi script
        }
    }

    // Method default ketika membuka /admin
    public function index() {
        // Judul halaman
        $data['title'] = 'Dashboard Admin';

        // Panggil view 'admin/dashboard' dengan data
        $this->view('admin/dashboard', $data);
    }

    // Method untuk halaman kelola produk
    public function produk() {
        // Judul halaman
        $data['title'] = 'Kelola Produk';

        // Panggil view 'admin/produk_index' dengan data
        $this->view('admin/produk_index', $data);
    }
}
