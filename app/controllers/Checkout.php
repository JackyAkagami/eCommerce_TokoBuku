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

    // ===== 1. AMBIL CART =====
    $cart = $_SESSION['cart'] ?? [];

    // mode single checkout
    if (
        isset($_POST['mode']) &&
        $_POST['mode'] === 'single' &&
        isset($_SESSION['single_checkout'])
    ) {
        $item = $_SESSION['single_checkout'];

        $cart = [
            [
                'id'    => $item['id'],     // WAJIB
                'harga' => $item['harga'],
                'qty'   => $item['qty']
            ]
        ];
    }

    if (empty($cart)) {
        header("Location: " . BASEURL . "/cart");
        exit;
    }

    // ===== 2. HITUNG TOTAL =====
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['harga'] * $item['qty'];
    }

    // ===== 3. SIMPAN KE DATABASE =====
    $pesananModel = $this->model('Pesanan_model');

    $orderId = $pesananModel->createOrder(
        $_SESSION['user']['id'],
        $total,
        'pending'
    );

    foreach ($cart as $item) {
        $pesananModel->addOrderItem(
            $orderId,
            $item['id_produk'],     // id produk
            $item['qty'],
            $item['harga']
        );
    }

    // ===== 4. BERSIHKAN SESSION =====
    unset($_SESSION['cart']);
    unset($_SESSION['single_checkout']);

    // ===== 5. REDIRECT =====
    header("Location: " . BASEURL . "/checkout/success");
    exit;
}
    public function success()
    {
        $this->view('checkout_success'); // kita buat file baru
    }
}
