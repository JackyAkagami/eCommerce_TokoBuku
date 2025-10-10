<?php
// Kelas Produk adalah controller untuk mengatur logika terkait produk
class Produk extends Controller {
    private $produkModel;

    // Constructor dijalankan saat objek Produk dibuat
    // Digunakan untuk memanggil model Produk_model agar bisa diakses di controller ini
    public function __construct() {
        $this->produkModel = $this->model('Produk_model');
    }

    // Method index untuk menampilkan daftar semua produk
    public function index() {
        // Judul halaman
        $data['title'] = 'Daftar Produk';

        // Ambil semua produk dari model
        $data['products'] = $this->produkModel->getAllProducts();

        // Load bagian header, konten utama (daftar produk), dan footer
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }

    // Method detail untuk menampilkan detail dari sebuah produk berdasarkan ID
    public function detail($id) {
        // Judul halaman
        $data['title'] = 'Detail Produk';

        // Ambil data produk sesuai ID dari model
        $data['product'] = $this->produkModel->getProductById($id);

        // Jika produk tidak ditemukan, tampilkan pesan error
        if (!$data['product']) {
            die("Produk tidak ditemukan.");
        }

        // Load bagian header, konten detail produk, dan footer
        $this->view('templates/header', $data);
        $this->view('produk/detail', $data);
        $this->view('templates/footer');
    }
}
