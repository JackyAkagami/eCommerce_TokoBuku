<?php
// app/controllers/Admin.php
class Admin extends Controller {

    public function __construct() {
        // pastikan session jalan
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // cek login & role admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    // dashboard admin
    public function dashboard() {
        $produkModel = $this->model('Produk_model');
        $data['products'] = $produkModel->getAllProducts();
        $data['title'] = 'Admin Dashboard';
        $this->view('admin/dashboard', $data);
    }

    public function uploadProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama_produk'];
        $stok = $_POST['stok'];
        $desk = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $diskon = isset($_POST['diskon']) ? 1 : 0;
        $diskon_persen = $diskon ? $_POST['diskon_persen'] : 0;

        // Proses upload banyak gambar
        $files = $_FILES['gambar'];
        $gambar1 = '';
        $gambar2 = '';

        for ($i = 0; $i < count($files['name']); $i++) {
            if (!empty($files['name'][$i])) {
                $filename = basename($files['name'][$i]);
                $target = '../public/img/' . $filename;
                move_uploaded_file($files['tmp_name'][$i], $target);

                if ($i == 0) $gambar1 = $filename;
                if ($i == 1) $gambar2 = $filename;
            }
        }

        // Simpan ke database
        $produkModel = $this->model('Produk_model');
        $produkModel->insertProduct($nama, $desk, $harga, $stok, $gambar1, $gambar2, $kategori, $diskon, $diskon_persen);

        header('Location: ' . BASEURL . '/admin/dashboard');
        exit;
    }
}


    public function deleteProduct($id) {
        $this->model('Produk_model')->deleteProduct($id);
        header('Location: ' . BASEURL . '/admin/dashboard');
        exit;
    }

    public function editProduct($id) {
        $produkModel = $this->model('Produk_model');
        $data['product'] = $produkModel->getProductById($id);
        $this->view('admin/edit_product', $data);
    }

   public function updateProduct($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil semua data dari form
        $nama = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $kategori = $_POST['kategori'];
        $diskon = isset($_POST['diskon']) ? 1 : 0;
        $diskon_persen = $diskon ? $_POST['diskon_persen'] : 0;

        // Variabel gambar default
        $gambar = null;
        $gambar2 = null;

        // ====== Proses upload gambar ======
        if (!empty($_FILES['gambar']['name'][0])) {
            $uploadDir = '../public/img/';

            // Buat folder jika belum ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Jika user pilih dua gambar
            if (count($_FILES['gambar']['name']) >= 2) {
                $gambar = basename($_FILES['gambar']['name'][0]);
                $gambar2 = basename($_FILES['gambar']['name'][1]);

                move_uploaded_file($_FILES['gambar']['tmp_name'][0], $uploadDir . $gambar);
                move_uploaded_file($_FILES['gambar']['tmp_name'][1], $uploadDir . $gambar2);
            } 
            // Jika user hanya pilih 1 gambar
            else {
                $gambar = basename($_FILES['gambar']['name'][0]);
                move_uploaded_file($_FILES['gambar']['tmp_name'][0], $uploadDir . $gambar);
            }
        }

        // ====== Update ke database ======
        $this->model('Produk_model')->updateProduct(
            $id,
            $nama,
            $deskripsi,
            $harga,
            $stok,
            $kategori,
            $diskon,
            $diskon_persen,
            $gambar,
            $gambar2
        );

        // Redirect kembali ke dashboard admin
        header('Location: ' . BASEURL . '/admin/dashboard');
        exit;
    }
}

}
