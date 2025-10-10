<?php
// Kelas Controller adalah kelas dasar (base class) untuk semua controller
// Fungsinya menyediakan method bantu (helper) untuk memanggil model dan view
class Controller {
    
    // Method untuk memanggil model
    public function model($model) {
        // Load file model dari folder app/models/
        require_once '../app/models/' . $model . '.php';
        
        // Instansiasi object dari model tersebut
        return new $model;
    }

    // Method untuk memanggil view
    public function view($view, $data = []) {
        // Load file view dari folder app/views/
        // $data dikirim agar bisa digunakan di dalam file view
        require_once '../app/views/' . $view . '.php';
    }
}
