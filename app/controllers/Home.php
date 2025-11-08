<?php
// Controller Home → controller utama yang dipanggil pertama kali
class Home extends Controller {
    
    // Method default (index) → dipanggil otomatis saat akses /
    public function index() {
        // Judul halaman
        $data['title'] = 'Home';

        // Panggil model Produk_model untuk ambil data
        $produkModel = $this->model('Produk_model');
        $data['highlight'] = $produkModel->getLatestProducts(3); // ambil 3 produk terbaru

        // Tampilkan halaman home + kirim data ke view
        $this->view('templates/header', $data);
        $this->view('home', $data);
        $this->view('templates/footer');
    }
}
