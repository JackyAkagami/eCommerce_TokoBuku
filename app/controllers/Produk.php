<?php
// Controller untuk mengatur logika produk
class Produk extends Controller
{
    private $produkModel;

    // Constructor: dijalankan otomatis saat controller dipanggil
    public function __construct()
    {
        // Panggil model Produk_model agar bisa digunakan di semua method
        $this->produkModel = $this->model('Produk_model');
    }

    // ===============================
    //  HALAMAN DAFTAR PRODUK + PAGINATION
    // ===============================
    public function index($page = 1, $kategoriId = null) {
    $limit = 15;
    $offset = ($page - 1) * $limit;

    $produkModel = $this->produkModel;

    // Ambil semua kategori yang digunakan produk
    $data['categories'] = $produkModel->getCategoriesUsed();

    if ($kategoriId) {
        $totalProduk = $produkModel->getTotalProdukByCategory($kategoriId);
        $data['products'] = $produkModel->getProdukPaginatedByCategory($limit, $offset, $kategoriId);
        $data['selected_kategori'] = $kategoriId;
    } else {
        $totalProduk = $produkModel->getTotalProduk();
        $data['products'] = $produkModel->getProdukPaginated($limit, $offset);
        $data['selected_kategori'] = null;
    }

    $data['current_page'] = $page;
    $data['total_pages'] = ceil($totalProduk / $limit);
    $data['title'] = 'Daftar Produk';

    $this->view('templates/header', $data);
    $this->view('produk/index', $data);
    $this->view('templates/footer');
}

    // ===============================
    //  HALAMAN DETAIL PRODUK
    // ===============================
    public function detail($id)
    {
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
