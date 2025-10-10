<?php
// Controller Home → controller utama yang dipanggil pertama kali
class Home extends Controller {
    
    // Method default (index) → dipanggil otomatis saat akses /home
    public function index() {
        // Render / load view bernama "home" dari folder views/home.php
        $this->view('home');
    }
}
