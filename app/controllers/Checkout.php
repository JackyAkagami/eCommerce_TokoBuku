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

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASEURL . "/checkout");
            exit;
        }

        $metode = $_POST['metode_pembayaran'];
        $cart = $_SESSION['cart'];

        // Hitung total
        $total = 0;
        foreach ($cart as $c) {
            $total += $c['harga'] * $c['qty'];
        }

        // kosongkan keranjang setelah bayar
        unset($_SESSION['cart']);

        header("Location: " . BASEURL . "/checkout/success");
        exit;
    }

    public function success()
    {
        $this->view('checkout_success'); // kita buat file baru
    }
}
