<?php

class Cart extends Controller
{
    // Halaman Cart
    public function index()
    {
        $this->view('cart');
    }

    // Tambah produk ke cart
    public function add($id)
{
    $product = $this->model('Produk_model')->getProductById($id);

    if (!$product) {
        header('Location: ' . BASEURL . '/shop');
        exit;
    }

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = [
            'id_produk' => $id,
            'nama' => $product['nama_produk'],
            'harga' => $product['harga'],
            'qty' => 1,
            'gambar' => $product['gambar']
        ];
    } else {
        $_SESSION['cart'][$id]['qty'] += 1;
    }

    header('Location: ' . BASEURL . '/cart');
}

    // Hapus produk dari cart
    public function remove($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        header('Location: ' . BASEURL . '/cart');
        exit;
    }

}
