<div class="container products">

    <div class="section-header">

        <h2>Daftar Produk</h2>
        
        <form method="GET" action="<?= BASEURL; ?>/produk">
            <label for="kategori" style="font-weight: bold;">Filter kategori:</label>
            <select id="kategori" name="kategori" class="custom-dropdown"
                onchange="window.location='<?= BASEURL ?>/produk/index/'+this.value;">
                <option value="">Semua Kategori</option>
                <?php foreach ($data['categories'] as $category): ?>
                    <option value="<?= $category['id']; ?>" <?= ($data['selected_kategori'] == $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- Grid untuk menampilkan kumpulan produk -->
    <div class="product-grid">
        <!-- Cek apakah ada produk di database -->
        <?php if (!empty($data['products'])): ?>
            <!-- Looping semua produk yang dikirim dari controller -->
            <?php foreach ($data['products'] as $product): ?>
                <div class="product-card">
                    <!-- Gambar produk -->
                    <!-- Jika gambar kosong, gunakan gambar default 'noimage.jpg' -->
                    <img src="<?= BASEURL; ?>/img/<?= $product['gambar'] ?: 'noimage.jpg'; ?>"
                        alt="<?= $product['nama_produk']; ?>">

                    <!-- Nama produk -->
                    <h4><?= $product['nama_produk']; ?></h4>

                    <!-- Harga produk, diformat ribuan -->
                    <p>Rp. <?= number_format($product['harga'], 0, ',', '.'); ?></p>

                    <!-- Tombol detail menuju halaman detail produk berdasarkan ID -->
                    <a href="<?= BASEURL; ?>/Produk/detail/<?= $product['id']; ?>" class="btn">Detail</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Pesan kalau tidak ada produk -->
            <p style="text-align:center;">Belum ada produk tersedia.</p>
        <?php endif; ?>
    </div>
</div>