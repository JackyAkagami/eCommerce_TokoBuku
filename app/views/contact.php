<?php include_once APPROOT . '/views/templates/header.php'; ?>

<section class="contact">
  <div class="container">
    <h2>Contact Us</h2>
    <p class="subtitle">Get in touch with Nadi Bookstore</p>

    <div class="contact-content">
      <div class="contact-info">
        <h3>Store Information</h3>
        <ul>
          <li><i class="fas fa-map-marker-alt"></i> Cibubur Indah 3 Jalan Jambore Raya Blok B No.8 RT.5, Jl. Jambore No.8, RT.5/RW.11, Cibubur, Kec. Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13720</li>
          <li><i class="fas fa-phone"></i> +62-816-744-833</li>
          <li><i class="fas fa-envelope"></i>TokoNadiBerkah@gmail.com</li>
          <li><i class="fas fa-clock"></i> Senin - Sabtu: 08.00 - 20.00</li>
        </ul>
      </div>

      <div class="contact-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3102648479917!2d106.8887252!3d-6.353866099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ecc1e2b2e693%3A0x4f92c6ec656b7975!2sToko%20Nadi!5e0!3m2!1sid!2sid!4v1762510275509!5m2!1sid!2sid" 
          width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>
    </div>
  </div>
</section>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>


<style>
.contact {
  color: #000;
  padding: 60px 0;
  text-align: center;
}

.contact .container {
  max-width: 1000px;
  margin: auto;
  padding: 0 20px;
}

.contact h2 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.contact .subtitle {
  color: #777;
  margin-bottom: 40px;
}

.contact-content {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-start;
  justify-content: space-around;
  gap: 40px;
}

.contact-info {
  flex: 1 1 400px;
  text-align: left;
}

.contact-info h3 {
  margin-bottom: 20px;
}

.contact-info ul {
  list-style: none;
  padding: 0;
}

.contact-info li {
  margin-bottom: 15px;
  font-size: 1rem;
}

.contact-info i {
  margin-right: 10px;
  color: #ffd369;
}

.contact-map {
  flex: 1 1 400px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}
</style>