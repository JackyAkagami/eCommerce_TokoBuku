<?php
// Kelas Pesanan adalah controller untuk mengelola data pesanan (order) di sistem
class Pesanan extends Controller {
    
    // Constructor dijalankan otomatis saat objek Pesanan dibuat
    public function __construct() {
        // Mulai session untuk mengecek apakah user sudah login
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Validasi: hanya admin yang boleh mengakses controller ini
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            // Jika bukan admin, arahkan kembali ke halaman Home
            header("Location: " . BASEURL . "/Home");
            exit;
        }
    }

    // Method index untuk menampilkan semua pesanan
    public function index() {
        // Ambil model pesanan
        $pesananModel = $this->model('Pesanan_model');

        // Ambil semua data pesanan dari database
        $data['pesanan'] = $pesananModel->getAllOrders();

        // Kirim data ke view untuk ditampilkan di halaman admin/pesanan_index.php
        $this->view('admin/pesanan_index', $data);
    }

    // Method detail untuk menampilkan detail sebuah pesanan berdasarkan ID
    public function detail($id) {
        // Ambil model pesanan
        $pesananModel = $this->model('Pesanan_model');

        // Ambil data pesanan berdasarkan ID
        $data['order'] = $pesananModel->getOrderById($id);

        // Ambil item/barang yang ada di dalam pesanan tersebut
        $data['items'] = $pesananModel->getOrderItems($id);

        // Kirim data ke view untuk ditampilkan di halaman admin/pesanan_detail.php
        $this->view('admin/pesanan_detail', $data);
    }
}
