<?php
// Model Produk_model digunakan untuk mengakses data produk dari database
class Produk_model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // ============================================================
    // 🔹 Ambil semua produk (tanpa pagination)
    // ============================================================
    public function getAllProducts() {
        $this->db->query("
            SELECT p.*, c.nama_kategori 
            FROM products p 
            LEFT JOIN categories c ON p.id_kategori = c.id
            ORDER BY p.id DESC
        ");
        return $this->db->resultSet();
    }

    // ============================================================
    // 🔹 Ambil produk dengan pagination (limit & offset)
    // ============================================================
    public function getProdukPaginated($limit, $offset) {
        $this->db->query("
            SELECT p.*, c.nama_kategori 
            FROM products p 
            LEFT JOIN categories c ON p.id_kategori = c.id
            ORDER BY p.id DESC
            LIMIT :limit OFFSET :offset
        ");
        $this->db->bind(':limit', (int)$limit);
        $this->db->bind(':offset', (int)$offset);
        return $this->db->resultSet();
    }

    // ============================================================
    // 🔹 Hitung total produk (untuk pagination)
    // ============================================================
    public function getTotalProduk() {
        $this->db->query("SELECT COUNT(*) AS total FROM products");
        $result = $this->db->single();
        return $result ? $result['total'] : 0;
    }

    // ============================================================
    // 🔹 Ambil produk berdasarkan ID
    // ============================================================
    public function getProductById($id) {
        $this->db->query("
            SELECT p.*, c.nama_kategori 
            FROM products p 
            LEFT JOIN categories c ON p.id_kategori = c.id
            WHERE p.id = :id
        ");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // ============================================================
    // 🔹 Tambah produk baru
    // ============================================================
    public function insertProduct($nama, $deskripsi, $harga, $stok, $gambar, $gambar2, $id_kategori, $diskon, $diskon_persen) {
        if ($diskon == 1) {
            $harga = $harga - ($harga * $diskon_persen / 100);
        }

        $this->db->query("
            INSERT INTO products 
            (nama_produk, deskripsi, harga, stok, gambar, gambar2, id_kategori, diskon, diskon_persen)
            VALUES 
            (:nama, :desk, :harga, :stok, :gambar, :gambar2, :id_kategori, :diskon, :diskon_persen)
        ");
        $this->db->bind(':nama', $nama);
        $this->db->bind(':desk', $deskripsi);
        $this->db->bind(':harga', $harga);
        $this->db->bind(':stok', $stok);
        $this->db->bind(':gambar', $gambar);
        $this->db->bind(':gambar2', $gambar2);
        $this->db->bind(':id_kategori', $id_kategori);
        $this->db->bind(':diskon', $diskon);
        $this->db->bind(':diskon_persen', $diskon_persen);

        return $this->db->execute();
    }

    // ============================================================
    // 🔹 Update produk
    // ============================================================
    public function updateProduct($id, $nama, $deskripsi, $harga, $stok, $id_kategori, $diskon, $diskon_persen, $gambar = null, $gambar2 = null)
{
    if ($diskon == 1) {
        $harga = $harga - ($harga * $diskon_persen / 100);
    }

    // Query dasar
    $sql = "
        UPDATE products SET 
            nama_produk = :nama,
            deskripsi = :desk,
            harga = :harga,
            stok = :stok,
            id_kategori = :id_kategori,
            diskon = :diskon,
            diskon_persen = :diskon_persen
    ";

    // Tambahkan kolom gambar jika ada file baru
    if ($gambar) {
        $sql .= ", gambar = :gambar";
    }
    if ($gambar2) {
        $sql .= ", gambar2 = :gambar2";
    }

    $sql .= " WHERE id = :id";

    $this->db->query($sql);
    $this->db->bind(':nama', $nama);
    $this->db->bind(':desk', $deskripsi);
    $this->db->bind(':harga', $harga);
    $this->db->bind(':stok', $stok);
    $this->db->bind(':id_kategori', $id_kategori);
    $this->db->bind(':diskon', $diskon);
    $this->db->bind(':diskon_persen', $diskon_persen);
    $this->db->bind(':id', $id);

    if ($gambar) $this->db->bind(':gambar', $gambar);
    if ($gambar2) $this->db->bind(':gambar2', $gambar2);

    return $this->db->execute();
}


    // ============================================================
    // 🔹 Hapus produk
    // ============================================================
    public function deleteProduct($id) {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // 🔹 Ambil 3 produk terbaru untuk highlight di home
public function getLatestProducts($limit = 3) {
    $this->db->query("
        SELECT p.*, c.nama_kategori 
        FROM products p
        LEFT JOIN categories c ON p.id_kategori = c.id
        ORDER BY p.id DESC
        LIMIT :limit
    ");
    $this->db->bind(':limit', $limit);
    return $this->db->resultSet();
}

}
