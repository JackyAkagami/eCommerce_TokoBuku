<?php include_once APPROOT . '/views/templates/header.php'; ?>

<!-- Hero Banner -->
<section class="hero">
  <video autoplay muted loop playsinline>
    <source src="video/hero.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="overlay"></div>
  
  <div class="hero-left">
    <h2>Enhance your spiritual experience with comfortable and quality prayer equipment.</h2>
  </div>
  
  <div class="hero-right">
    <a href="news.php" class="btn">More info</a>
  </div>
</section>

<!-- Highlight Produk Dinamis -->
<section class="products">
  <div class="section-header">
    <h3>Highlight Products</h3>
    <a href="<?= BASEURL; ?>/Produk" class="view-all">View All</a>
  </div>

  <div class="product-grid">
    <?php if (!empty($data['highlight'])): ?>
      <?php foreach ($data['highlight'] as $p): ?>
        <div class="product-card">
          <div class="image-wrapper">
            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar']); ?>" 
                 alt="<?= htmlspecialchars($p['nama_produk']); ?>" 
                 class="img-front">

            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($p['gambar2'] ?? $p['gambar']); ?>" 
                 alt="<?= htmlspecialchars($p['nama_produk']); ?>" 
                 class="img-back">
          </div>

          <div class="info">
            <p class="title"><?= htmlspecialchars($p['nama_produk']); ?></p>

            <?php if (!empty($p['diskon']) && $p['diskon'] == 1): ?>
              <p class="price">
                Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                <span class="old">Rp <?= number_format($p['harga'] / (1 - $p['diskon_persen'] / 100), 0, ',', '.'); ?></span>
              </p>
            <?php else: ?>
              <p class="price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada produk terbaru.</p>
    <?php endif; ?>
  </div>
</section>

<!-- Gallery / Promo -->
<section class="gallery">
  <div class="section-header">
    <h3>Promo</h3>
    <a href="#" class="view-all">View All</a>
  </div>
  <div class="gallery-grid">
    <div class="gallery-item">
      <img src="<?= BASEURL; ?>/img/promo1.jpg" alt="Promo 1">
      <div class="overlay">
        <p>Dates are a typical food that is often found during the fasting month. This is one of the benefits of dates</p>
      </div>
    </div>

    <div class="gallery-item">
      <img src="<?= BASEURL; ?>/img/promo2.jpg" alt="Promo 2">
      <div class="overlay">
        <p>Special Eid gift packages to celebrate with your family and loved ones.</p>
      </div>
    </div>
  </div>
</section>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
