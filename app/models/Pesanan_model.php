<?php
// Model Pesanan_model berfungsi untuk mengakses data pesanan dari database
class Pesanan_model {
    private $db;

    // Constructor dipanggil saat objek dibuat
    public function __construct() {
        // Buat instance Database agar bisa digunakan untuk query
        $this->db = new Database;
    }

    // Ambil semua pesanan + nama user + email + daftar produk yang dibeli
    public function getAllOrders() {
        // NOTE:
        // - orders      : tabel pesanan
        // - users       : tabel user
        // - order_items : detail pesanan (id, id_order, id_produk, jumlah, harga_satuan, subtotal)
        // - products    : tabel produk (punya kolom nama_produk)
        $this->db->query("
            SELECT 
                o.*, 
                u.nama  AS nama_user,
                u.email AS email,
                GROUP_CONCAT(
                    CONCAT(p.nama_produk, ' (', oi.jumlah, 'x)')
                    SEPARATOR '||'
                ) AS items
            FROM orders o
            JOIN users u        ON o.id_user   = u.id
            JOIN order_items oi ON oi.id_order = o.id
            JOIN products p     ON p.id        = oi.id_produk
            GROUP BY o.id
            ORDER BY o.tanggal_order DESC
        ");
        // Kembalikan hasil dalam bentuk array (banyak data)
        return $this->db->resultSet();
    }

    // Ambil satu pesanan berdasarkan ID
    public function getOrderById($id) {
        // Query join antara orders dan users, dengan filter id pesanan
        $this->db->query("SELECT o.*, u.nama AS nama_user 
                          FROM orders o 
                          JOIN users u ON o.id_user = u.id
                          WHERE o.id = :id");
        // Binding parameter id agar aman dari SQL Injection
        $this->db->bind(':id', $id);
        // Ambil satu baris data pesanan
        return $this->db->single();
    }

    // Ambil item/barang yang ada di dalam sebuah pesanan
    public function getOrderItems($id_order) {
        // Query join antara order_items dan products
        $this->db->query("SELECT oi.*, p.nama_produk 
                          FROM order_items oi 
                          JOIN products p ON oi.id_produk = p.id
                          WHERE oi.id_order = :id_order");
        // Binding parameter id_order
        $this->db->bind(':id_order', $id_order);
        // Kembalikan hasil dalam bentuk array (banyak data)
        return $this->db->resultSet();
    }
}
