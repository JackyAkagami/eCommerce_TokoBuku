<?php
// Model Produk_model digunakan untuk mengakses data produk dari database
class Produk_model
{
    private $db;

    // Constructor otomatis dijalankan saat objek dibuat
    public function __construct()
    {
        // Membuat instance Database agar bisa digunakan untuk query
        $this->db = new Database;
    }

    // Ambil semua produk beserta kategori (jika ada)
    public function getAllProducts()
    {
        // Query join ke tabel categories (pakai LEFT JOIN agar produk tetap muncul walau tidak ada kategori)
        $this->db->query("SELECT p.*, c.nama_kategori 
                          FROM products p 
                          LEFT JOIN categories c ON p.id_kategori = c.id");
        // Kembalikan semua hasil query dalam bentuk array
        return $this->db->resultSet();
    }

    public function getProductsByCategory($id_kategori)
    {
        $query = "SELECT * FROM products WHERE id_kategori = :id_kategori";
        $this->db->query($query);
        $this->db->bind('id_kategori', $id_kategori);
        return $this->db->resultSet();
    }



    // Ambil satu produk berdasarkan ID
    public function getProductById($id)
    {
        // Query untuk mengambil produk beserta nama kategori berdasarkan id produk
        $this->db->query("SELECT p.*, c.nama_kategori 
                          FROM products p 
                          LEFT JOIN categories c ON p.id_kategori = c.id
                          WHERE p.id = :id");
        // Binding parameter id agar aman dari SQL Injection
        $this->db->bind(':id', $id);
        // Kembalikan satu baris data produk
        return $this->db->single();
    }
}
