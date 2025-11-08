<?php
// Controller untuk mengatur logika produk
class Produk extends Controller {
    private $produkModel;

    // Constructor: dijalankan otomatis saat controller dipanggil
    public function __construct() {
        // Panggil model Produk_model agar bisa digunakan di semua method
        $this->produkModel = $this->model('Produk_model');
    }

    // ===============================
    //  HALAMAN DAFTAR PRODUK + PAGINATION
    // ===============================
    public function index($page = 1) {
        $limit = 15; // 3 kolom × 5 baris per halaman
        $offset = ($page - 1) * $limit;

        // Hitung total produk
        $totalProduk = $this->produkModel->getTotalProduk();
        $totalPages = ceil($totalProduk / $limit);

        // Ambil produk sesuai halaman aktif
        $data['products'] = $this->produkModel->getProdukPaginated($limit, $offset);

        // Data tambahan untuk pagination dan judul
        $data['current_page'] = $page;
        $data['total_pages'] = $totalPages;
        $data['title'] = 'Daftar Produk';

        // Tampilkan halaman dengan urutan view
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }

    // ===============================
    //  HALAMAN DETAIL PRODUK
    // ===============================
    public function detail($id) {
        $data['title'] = 'Detail Produk';
        $data['product'] = $this->produkModel->getProductById($id);

        if (!$data['product']) {
            // Jika tidak ada produk dengan ID tersebut
            die("❌ Produk tidak ditemukan.");
        }

        // Tampilkan detail produk
        $this->view('templates/header', $data);
        $this->view('produk/detail', $data);
        $this->view('templates/footer');
    }
}
