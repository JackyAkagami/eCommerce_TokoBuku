<?php
// Model User_model digunakan untuk mengakses data user dari database
class User_model {
    private $db;

    // Constructor dijalankan otomatis saat objek dibuat
    public function __construct() {
        // Membuat instance Database agar bisa dipakai untuk query
        $this->db = new Database;
    }

    // Cari user berdasarkan email
    public function getUserByEmail($email) {
        // Query untuk mencari user dengan email tertentu
        $this->db->query("SELECT * FROM users WHERE email = :email");
        // Binding parameter email agar aman dari SQL Injection
        $this->db->bind(':email', $email);
        // Ambil satu baris data user
        return $this->db->single();
    }

    // Registrasi user baru
    public function register($nama, $gender, $email, $password, $alamat = null, $no_hp = null) {
        // Query untuk menambahkan user baru ke tabel users
        // Role default selalu 'user'
        $this->db->query("INSERT INTO users (nama, gender, email, password, role, alamat, no_hp) 
                          VALUES (:nama, :gender, :email, :password, 'user', :alamat, :no_hp)");
        // Binding semua parameter
        $this->db->bind(':nama', $nama);
        $this->db->bind(':gender', $gender);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':alamat', $alamat);
        $this->db->bind(':no_hp', $no_hp);
        // Eksekusi query insert
        return $this->db->execute();
    }

    // Ambil semua user (biasanya untuk admin)
    public function getAllUsers() {
        // Query untuk mengambil semua data user
        $this->db->query("SELECT * FROM users");
        // Kembalikan hasil dalam bentuk array
        return $this->db->resultSet();
    }

    // Update password berdasarkan email
    public function updatePasswordByEmail($email, $newPassword) {
        // Query untuk update password user sesuai email
        $this->db->query("UPDATE users SET password = :password WHERE email = :email");
        // Binding parameter password dan email
        $this->db->bind(':password', $newPassword);
        $this->db->bind(':email', $email);
        // Eksekusi query update
        return $this->db->execute();
    }
}
