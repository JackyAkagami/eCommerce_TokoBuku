<div class="container">
    <!-- Judul halaman detail produk -->
    <h2><?= $data['product']['nama_produk']; ?></h2>

    <!-- Gambar produk -->
    <!-- Jika produk tidak punya gambar, tampilkan gambar default 'noimage.jpg' -->
    <img src="<?= BASEURL; ?>/img/<?= $data['product']['gambar'] ?: 'noimage.jpg'; ?>" 
         alt="<?= $data['product']['nama_produk']; ?>" width="300">

    <!-- Informasi kategori produk -->
    <!-- Jika tidak ada kategori, tampilkan '-' -->
    <p><strong>Kategori:</strong> <?= $data['product']['nama_kategori'] ?? '-'; ?></p>

    <!-- Informasi deskripsi produk -->
    <p><strong>Deskripsi:</strong> <?= $data['product']['deskripsi']; ?></p>

    <!-- Informasi harga produk -->
    <!-- Format harga dalam format ribuan (contoh: 10.000) -->
    <p><strong>Harga:</strong> Rp. <?= number_format($data['product']['harga'], 0, ',', '.'); ?></p>

    <!-- Informasi stok produk -->
    <p><strong>Stok:</strong> <?= $data['product']['stok']; ?></p>

    <!-- Tombol kembali ke daftar produk -->
    <a href="<?= BASEURL; ?>/Produk" class="btn">Kembali</a>
</div>
