<?php include_once APPROOT . '/views/templates/header.php'; ?>

<!-- Hero Banner -->
<section class="hero">
  <!-- Video background -->
  <video autoplay muted loop playsinline>
    <source src="video/hero.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <!-- Overlay transparan agar teks lebih jelas -->
  <div class="overlay"></div>
  
  <!-- Konten teks di sisi kiri bawah -->
  <div class="hero-left">
    <h2>Enhance your spiritual experience with comfortable and quality prayer equipment.</h2>
  </div>
  
  <!-- Tombol di sisi kanan bawah -->
  <div class="hero-right">
    <a href="news.php" class="btn">More info</a>
  </div>
</section>

<!-- Highlight Products -->
<section class="products">
    <div class="section-header">
        <h3>Highlight Products</h3>
        <!-- Link menuju halaman semua produk -->
        <a href="<?= BASEURL; ?>/Produk" class="view-all">View All</a>
    </div>
    <div class="product-grid">
        <!-- Produk highlight ditampilkan secara statis -->
        <div class="product-card">
            <img src="<?= BASEURL; ?>/img/book1.jpg" alt="Product 1">
            <p class="title">Ramadan Activity Book</p>
            <p class="price">Rp. 145.000</p>
        </div>
        <div class="product-card">
            <img src="<?= BASEURL; ?>/img/book2.jpg" alt="Product 2">
            <p class="title">Modul Alat Peraga Anak</p>
            <p class="price">Rp. 120.000</p>
        </div>
        <div class="product-card">
            <img src="<?= BASEURL; ?>/img/book3.jpg" alt="Product 3">
            <p class="title">Pendidikan Agama Islam</p>
            <p class="price">Rp. 90.000</p>
        </div>
    </div>
</section>

<!-- Gallery / Promo -->
<section class="gallery">
  <div class="section-header">
    <h3>Promo</h3>
    <a href="#" class="view-all">View All</a>
  </div>
  <div class="gallery-grid">
    <!-- Promo Item 1 -->
    <div class="gallery-item">
      <img src="<?= BASEURL; ?>/img/promo1.jpg" alt="Promo 1">
      <div class="overlay">
        <p>Dates are a typical food that is often found during the fasting month. 
        This is one of the benefits of dates</p>
      </div>
    </div>

    <!-- Promo Item 2 -->
    <div class="gallery-item">
      <img src="<?= BASEURL; ?>/img/promo2.jpg" alt="Promo 2">
      <div class="overlay">
        <p>Special Eid gift packages to celebrate with your family and loved ones.</p>
      </div>
    </div>
  </div>
</section>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
