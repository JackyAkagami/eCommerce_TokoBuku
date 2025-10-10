<?php
// Kelas App adalah inti (core) dari aplikasi MVC
// Bertugas untuk membaca URL, lalu menentukan controller, method, dan parameter yang dipanggil
class App {
    // Controller default -> jika tidak ada yang ditentukan di URL
    protected $controller = 'Home';

    // Method default -> jika tidak ada yang ditentukan di URL
    protected $method = 'index';

    // Parameter default (kosong)
    protected $params = [];

    // Constructor dijalankan otomatis saat App dipanggil
    public function __construct() {
        // Ambil hasil parsing URL
        $url = $this->parseURL();

        // ================================
        // 1. Tentukan Controller
        // ================================
        // Jika ada controller yang sesuai dengan segment pertama URL
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            // Ganti controller default dengan controller dari URL
            $this->controller = ucfirst($url[0]);
            unset($url[0]); // hapus index pertama agar tidak jadi parameter
        }

        // Load file controller yang dipilih
        require_once '../app/controllers/' . $this->controller . '.php';
        // Instansiasi object controller
        $this->controller = new $this->controller;

        // ================================
        // 2. Tentukan Method
        // ================================
        // Jika segment kedua URL ada, dan sesuai dengan method di controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1]; // gunakan method dari URL
            unset($url[1]); // hapus index kedua agar tidak jadi parameter
        }

        // ================================
        // 3. Tentukan Parameter
        // ================================
        // Jika masih ada sisa segment di URL, jadikan sebagai parameter
        $this->params = $url ? array_values($url) : [];

        // ================================
        // 4. Jalankan Controller + Method + Parameter
        // ================================
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi untuk memecah URL jadi array
    public function parseURL() {
        if (isset($_GET['url'])) {
            // Hilangkan '/' di akhir, lalu filter karakter berbahaya
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // Pecah URL berdasarkan '/' lalu jadikan array
            return explode('/', $url);
        }
        // Jika tidak ada URL, kembalikan array kosong
        return [];
    }
}
