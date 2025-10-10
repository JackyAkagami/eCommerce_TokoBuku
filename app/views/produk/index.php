<div class="container">
    <!-- Judul halaman daftar produk -->
    <h2>Daftar Produk</h2>

    <!-- Grid untuk menampilkan kumpulan produk -->
    <div class="product-grid">
        <!-- Looping semua produk yang dikirim dari controller -->
        <?php foreach ($data['products'] as $product): ?>
            <div class="product-card">
                <!-- Gambar produk -->
                <!-- Jika gambar kosong, gunakan gambar default 'noimage.jpg' -->
                <img src="<?= BASEURL; ?>/img/<?= $product['gambar'] ?: 'noimage.jpg'; ?>" alt="<?= $product['nama_produk']; ?>">

                <!-- Nama produk -->
                <h4><?= $product['nama_produk']; ?></h4>

                <!-- Harga produk, diformat ribuan -->
                <p>Rp. <?= number_format($product['harga'], 0, ',', '.'); ?></p>

                <!-- Tombol detail menuju halaman detail produk berdasarkan ID -->
                <a href="<?= BASEURL; ?>/Produk/detail/<?= $product['id']; ?>" class="btn">Detail</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
