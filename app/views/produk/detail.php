<div class="container">
    <!-- Judul halaman detail produk -->
    <h2><?= $data['product']['nama_produk']; ?></h2>

    <?php 
        // Ambil nama gambar dari database
        $gambar_default = $data['product']['gambar'] ?: 'noimage.jpg';
        // Ubah huruf 'A' menjadi 'B' untuk versi lain
        $gambar_detail = str_replace('A', 'B', $gambar_default);
        // Path gambar versi B
        $path_gambar_detail = "img/" . $gambar_detail;

        // Cek apakah file versi B ada di folder img
        if (file_exists($path_gambar_detail)) {
            $gambar_tampil = $gambar_detail;
        } else {
            $gambar_tampil = $gambar_default;
        }
    ?>

    <!-- Gambar produk -->
    <img src="<?= BASEURL; ?>/img/<?= $gambar_tampil; ?>" 
         alt="<?= $data['product']['nama_produk']; ?>" width="300">

    <!-- Informasi kategori produk -->
    <p><strong>Kategori:</strong> <?= $data['product']['nama_kategori'] ?? '-'; ?></p>

    <!-- Informasi deskripsi produk -->
    <p><strong>Deskripsi:</strong> <?= $data['product']['deskripsi']; ?></p>

    <!-- Informasi harga produk -->
    <p><strong>Harga:</strong> Rp. <?= number_format($data['product']['harga'], 0, ',', '.'); ?></p>

    <!-- Informasi stok produk -->
    <p><strong>Stok:</strong> <?= $data['product']['stok']; ?></p>

    <!-- Tombol kembali ke daftar produk -->
    <a href="<?= BASEURL; ?>/Produk" class="btn">Kembali</a>
</div>
