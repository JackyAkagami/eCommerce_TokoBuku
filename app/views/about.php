<?php include_once APPROOT . '/views/templates/header.php'; ?>

<section class="about">
  <div class="container">
    <h2>About Nadi Bookstore</h2>
    <p class="subtitle">Your trusted source for Qur'an and prayer essentials.</p>

    <div class="about-content">
      <div class="about-text">
        <p>
          Nadi Bookstore adalah toko yang berdedikasi menyediakan berbagai perlengkapan ibadah dan literasi Islami berkualitas tinggi. 
          Kami menghadirkan beragam pilihan produk seperti Al-Qur’an, sajadah, mukena, tasbih, hingga buku-buku bernuansa Islami yang 
          menginspirasi dan menenangkan hati. Setiap produk yang kami tawarkan dipilih dengan cermat agar mampu mendukung kenyamanan 
          dan kekhusyukan dalam beribadah.
        </p><br>
        <p>
          Sejak awal berdiri, Nadi Bookstore berkomitmen untuk memberikan pelayanan terbaik kepada setiap pelanggan. 
          Kami percaya bahwa kualitas produk yang baik harus diiringi dengan kehangatan pelayanan, sehingga setiap 
          kunjungan ke Nadi Bookstore menjadi pengalaman yang berkesan dan bermakna. Dengan semangat berbagi kebaikan, 
          kami terus berinovasi dalam menyediakan produk yang tidak hanya indah secara tampilan, tetapi juga memiliki 
          nilai spiritual yang mendalam.
        </p><br>
        <p>
          Kami juga memahami bahwa kebutuhan masyarakat terhadap perlengkapan ibadah dan bacaan Islami terus berkembang. 
          Oleh karena itu, Nadi Bookstore senantiasa berusaha mengikuti perkembangan zaman dengan menghadirkan 
          layanan yang modern, mudah diakses, dan terpercaya. Visi kami adalah menjadi sahabat terbaik bagi setiap 
          individu dalam menumbuhkan kecintaan terhadap ibadah dan ilmu pengetahuan Islam.
        </p><br>
        <p>
          Melalui setiap halaman buku dan setiap helai sajadah, kami berharap Nadi Bookstore dapat menjadi bagian dari 
          perjalanan spiritual Anda, membantu mendekatkan diri kepada Sang Pencipta dengan penuh keikhlasan dan ketenangan. 
          Terima kasih telah mempercayakan kebutuhan ibadah Anda kepada kami.
        </p>
      </div>
    </div>

    <div class="about-vision">
      <h3>Our Vision & Mission</h3>
      <div class="vision-mission">
        <div class="vision">
          <h4>Vision</h4><br>
          <p>
            Menjadi toko perlengkapan ibadah terdepan yang tidak hanya menyediakan produk berkualitas, 
            tetapi juga menginspirasi dan mendukung umat dalam memperdalam nilai-nilai spiritual. 
            Nadi Bookstore bertekad menjadi sahabat terpercaya dalam setiap langkah menuju kehidupan 
            yang lebih beriman, penuh makna, dan berlandaskan kebaikan.
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