<?php

class Checkout extends Controller
{
    public function index()
    {
        // Kalau keranjang kosong → kembali ke cart
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header("Location: " . BASEURL . "/cart");
            exit;
        }

        $this->view('checkout'); // karena file-nya checkout.php
    }

    // ====== BUY NOW: langsung checkout 1 produk ======
    public function buynow()
    {
        // Hanya boleh via POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASEURL . "/produk");
            exit;
        }

        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $qty       = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;

        if ($productId <= 0 || $qty <= 0) {
            header("Location: " . BASEURL . "/produk");
            exit;
        }

        // ambil detail produk dari model Produk
        $produkModel = $this->model('Produk_model');   // sesuaikan dengan nama modelmu
        $product     = $produkModel->getProductById($productId);

        if (!$product) {
            header("Location: " . BASEURL . "/produk");
            exit;
        }

        // simpan ke session khusus single product checkout
        $_SESSION['single_checkout'] = [
            'id'    => $product['id'],
            'nama'  => $product['nama_produk'],
            'harga' => $product['harga'],
            'qty'   => $qty,
            'gambar' => $product['gambar'] ?? ''
        ];

        // arahkan ke halaman checkout khusus single product
        header("Location: " . BASEURL . "/checkout/single");
        exit;
    }

    // Halaman checkout untuk 1 produk (Buy now)
    public function single()
    {
        if (empty($_SESSION['single_checkout'])) {
            header("Location: " . BASEURL . "/produk");
            exit;
        }

        $data['item'] = $_SESSION['single_checkout'];
        $data ['mode'] = 'single';

        // buat view baru: views/checkout_single.php
        $this->view('checkout', $data);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASEURL . "/checkout");
            exit;
        }

        // kamu bisa bedakan: pembayaran dari cart atau dari single
        // misal pakai hidden input "mode"
        $metode = $_POST['metode_pembayaran'];

        // default: ambil dari cart
        $cart = $_SESSION['cart'] ?? [];

        // kalau mode single, ambil dari session single_checkout
        if (isset($_POST['mode']) && $_POST['mode'] === 'single' && isset($_SESSION['single_checkout'])) {
            $item = $_SESSION['single_checkout'];
            $cart = [
                [
                    'harga' => $item['harga'],
                    'qty'   => $item['qty']
                ]
            ];
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $c) {
            $total += $c['harga'] * $c['qty'];
        }

        // kosongkan keranjang setelah bayar
        unset($_SESSION['cart']);
        unset($_SESSION['single_checkout']);

        header("Location: " . BASEURL . "/checkout/success");
        exit;
    }

    public function success()
    {
        $this->view('checkout_success'); // kita buat file baru
    }
}
