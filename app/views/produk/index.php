<div class="container product-page">
  <h2 class="page-title">Product List</h2>

  <div class="filter-tabs">
  <a href="<?= BASEURL; ?>/produk/index" class="tab <?= empty($data['selected_kategori']) ? 'active' : ''; ?>">Semua</a>
  <?php foreach ($data['categories'] as $c): ?>
    <a href="<?= BASEURL; ?>/produk/index/1/<?= $c['id']; ?>"
       class="tab <?= ($data['selected_kategori'] == $c['id']) ? 'active' : ''; ?>">
      <?= htmlspecialchars($c['nama_kategori']); ?>
    </a>
  <?php endforeach; ?>
</div>


  <?php if (empty($data['products'])): ?>
    <p class="text-center text-muted">No products available.</p>
  <?php else: ?>
    <div class="product-grid">
      <?php foreach ($data['products'] as $p): ?>
        <div class="product-card">
  <a href="<?= BASEURL; ?>/produk/detail/<?= $p['id']; ?>" class="card-link"></a>

  <div class="image-wrapper">
    <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar']); ?>"
      alt="<?= htmlspecialchars($p['nama_produk']); ?>" class="img-front">

    <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar2'] ?? $p['gambar']); ?>"
      alt="<?= htmlspecialchars($p['nama_produk']); ?>" class="img-back">

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

<style>
  .filter-tabs {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-bottom: 25px;
  flex-wrap: wrap;
}

.filter-tabs .tab {
  padding: 8px 16px;
  border-radius: 20px;
  background-color: #f3f3f3;
  color: #333;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.2s ease;
}

.filter-tabs .tab:hover {
  background-color: #ddd;
}

.filter-tabs .tab.active {
  background-color: #0b6e4f; /* warna hijau kayak di contoh */
  color: white;
}
  /* Biar seluruh kartu bisa diklik tanpa ganggu layout */
.product-card {
  position: relative;
}

.product-card .card-link {
  position: absolute;
  inset: 0; /* atas, kanan, bawah, kiri 0 */
  z-index: 10;
  text-decoration: none;
  color: inherit;
}

</style>