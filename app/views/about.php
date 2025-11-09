<?php include_once APPROOT . '/views/templates/header.php'; ?>

<section class="about">
  <div class="container">
    <h2>About Nadi Bookstore</h2>
    <p class="subtitle">Your trusted source for Qur'an and prayer essentials.</p>

    <div class="about-content">
      <div class="about-text">
        <p>
          Nadi Bookstore adalah toko yang berdedikasi menyediakan perlengkapan ibadah berkualitas, 
          termasuk Al-Qur’an, sajadah, mukena, dan buku-buku Islami. 
          Kami hadir untuk mendukung perjalanan spiritual setiap pelanggan dengan menghadirkan produk 
          yang nyaman, indah, dan bermakna.
        </p><br>
        <p>
          Sejak berdiri, Nadi Bookstore berkomitmen memberikan pelayanan terbaik dan menjadi bagian dari 
          kehidupan ibadah masyarakat Indonesia. Kami percaya bahwa kenyamanan dalam beribadah 
          akan meningkatkan kedekatan dengan Sang Pencipta.
        </p>
      </div>
      <div class="about-image">
        <img src="<?= BASEURL; ?>/img/about-store.jpg" alt="About Nadi Bookstore">
      </div>
    </div>

    <div class="about-vision">
      <h3>Our Vision & Mission</h3>
      <div class="vision-mission">
        <div class="vision">
          <h4>Vision</h4><br>
          <p>
            Menjadi toko perlengkapan ibadah terdepan yang menginspirasi dan mendukung umat 
            dalam memperdalam nilai spiritual.
          </p>
        </div>
        <div class="mission">
          <h4>Mission</h4><br>
          <ul>
            <li>Menyediakan produk berkualitas dan nyaman digunakan.</li>
            <li>Meningkatkan pelayanan dengan kejujuran dan tanggung jawab.</li>
            <li>Mendorong literasi Islam melalui buku dan media edukatif.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>

<style>
.about {
  padding: 60px 0;
  text-align: center;
}

.about .container {
  max-width: 1000px;
  margin: auto;
  padding: 0 20px;
}

.about h2 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.about .subtitle {
  color: #777;
  margin-bottom: 40px;
}

.about-content {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: 40px;
  margin-bottom: 60px;
}

.about-text {
  flex: 1 1 400px;
  text-align: left;
  line-height: 1.8;
}

.about-image img {
  width: 400px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.about-vision h3 {
  margin-bottom: 20px;
  font-size: 1.5rem;
}

.vision-mission {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  text-align: left;
  gap: 30px;
}

.vision, .mission {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  width: 45%;
}

.mission ul {
  margin: 0;
  padding-left: 20px;
}

.mission li {
  list-style: disc;
  margin-bottom: 10px;
}
</style>