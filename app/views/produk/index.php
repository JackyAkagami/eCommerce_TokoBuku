<div class="container product-page">
  <h2 class="page-title">Product List</h2>

  <?php if (empty($data['products'])): ?>
    <p class="text-center text-muted">No products available.</p>
  <?php else: ?>
    <div class="product-grid">
      <?php foreach ($data['products'] as $p): ?>
        <div class="product-card">
          <div class="image-wrapper">
            <!-- Gambar utama -->
            <img 
              src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar']); ?>" 
              alt="<?= htmlspecialchars($p['nama_produk']); ?>" 
              class="img-front">

            <!-- Gambar hover -->
            <img 
              src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar2'] ?? $p['gambar']); ?>" 
              alt="<?= htmlspecialchars($p['nama_produk']); ?>" 
              class="img-back">

            <!-- Badge diskon -->
            <?php if (!empty($p['diskon']) && $p['diskon'] == 1): ?>
              <div class="discount-badge"><?= htmlspecialchars($p['diskon_persen']); ?>%</div>
            <?php endif; ?>
          </div>

          <div class="info">
            <h5 class="name"><?= htmlspecialchars($p['nama_produk']); ?></h5>

            <?php if (!empty($p['diskon']) && $p['diskon'] == 1): ?>
              <p class="price">
                Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                <span class="old">
                  Rp <?= number_format($p['harga'] / (1 - $p['diskon_persen'] / 100), 0, ',', '.'); ?>
                </span>
              </p>
            <?php else: ?>
              <p class="price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- PAGINATION -->
    <?php if (!empty($data['total_pages']) && $data['total_pages'] > 1): ?>
      <div class="pagination">
        <!-- Tombol Previous -->
        <?php if ($data['current_page'] > 1): ?>
          <a href="<?= BASEURL; ?>/produk/index/<?= $data['current_page'] - 1; ?>" class="page-btn">←</a>
        <?php endif; ?>

        <!-- Nomor Halaman -->
        <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
          <a href="<?= BASEURL; ?>/produk/index/<?= $i; ?>" 
             class="page-number <?= $i == $data['current_page'] ? 'active' : ''; ?>">
            <?= $i; ?>
          </a>
        <?php endfor; ?>

        <!-- Tombol Next -->
        <?php if ($data['current_page'] < $data['total_pages']): ?>
          <a href="<?= BASEURL; ?>/produk/index/<?= $data['current_page'] + 1; ?>" class="page-btn">→</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  <?php endif; ?>
</div>
