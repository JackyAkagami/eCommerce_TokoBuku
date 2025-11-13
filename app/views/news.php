<?php include_once APPROOT . '/views/templates/header.php'; ?>

<section class="news-section" style="padding: 60px 90px; background: #FFFEF2;">
  <div class="news-header" style="text-align:center; margin-bottom: 40px;">
    <h2 style="font-size:28px; font-weight:600; color:#333;">News & Articles</h2>
    <p style="color:#666; font-size:14px; margin-top:8px;">Get the latest updates and insights from Nadi Bookstore</p>
  </div>

  <div class="news-grid" style="display:grid; grid-template-columns:repeat(3, 1fr); gap:30px;">
    
    <!-- Artikel 1 -->
    <div class="news-card" style="background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
      <div style="padding:18px;">
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">Pentingnya Membaca Al-Qur'an Setiap Hari</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Membaca Al-Qur'an setiap hari merupakan amalan yang sangat mulia dan penuh...</p>
        <a href="#" class="read-more" data-article="1" style="color:#586053; font-weight:bold; font-size:13px; text-decoration:underline;">Read More</a>
      </div>
    </div>

    <!-- Artikel 2 -->
    <div class="news-card" style="background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
      <div style="padding:18px;">
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">Menemukan Ketenangan Melalui Rutinitas Salat</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Salat harian bukan hanya sekadar kewajiban spiritual, tetapi juga menjadi cara terbaik...</p>
        <a href="#" class="read-more" data-article="2" style="color:#586053; font-weight:bold; font-size:13px; text-decoration:underline;">Read More</a>
      </div>
    </div>

    <!-- Artikel 3 -->
    <div class="news-card" style="background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
      <div style="padding:18px;">
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">Memilih Perlengkapan Salat yang Tepat</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Memilih perlengkapan salat yang nyaman dan bersih merupakan hal penting untuk...</p>
        <a href="#" class="read-more" data-article="3" style="color:#586053; font-weight:bold; font-size:13px; text-decoration:underline;">Read More</a>
      </div>
    </div>

  </div>
</section>

<!-- Modal Popup -->
<div id="newsModal" class="modal">
  <div class="modal-content">
    <span id="closeModal">&times;</span>
    <h2 id="modalTitle"></h2>
    <p id="modalContent"></p>
  </div>
</div>

<style>
/* Modal Style */
.modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1000;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transition: opacity 0.4s ease;
}
.modal.show {
  display: flex;
  opacity: 1;
}
.modal-content {
  background: #fff;
  width: 65%;
  max-width: 750px;
  padding: 25px 35px;
  border-radius: 10px;
  position: relative;
  animation: fadeInUp 0.4s ease;
}
#closeModal {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 22px;
  cursor: pointer;
  color: #666;
}
#closeModal:hover {
  color: #000;
}
#modalTitle {
  font-size: 22px;
  font-weight: 600;
  color: #333;
  margin-bottom: 10px;
}
#modalContent {
  color: #555;
  font-size: 15px;
  line-height: 1.7;
  text-align: justify;
}

/* Animation */
@keyframes fadeInUp {
  from { transform: translateY(40px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
</style>

<script>
const articles = {
  1: {
    title: "Pentingnya Membaca Al-Qur'an Setiap Hari",
    content: `Membaca Al-Qur'an setiap hari merupakan amalan yang sangat mulia dan penuh keberkahan. Dengan membaca kalam Allah secara rutin, hati kita menjadi tenang, pikiran lebih jernih, dan jiwa senantiasa terhubung dengan Sang Pencipta. Setiap ayat yang dibaca bukan hanya membawa pahala, tetapi juga menjadi cahaya yang menuntun kita dalam menjalani kehidupan sehari-hari.<br><br>
    Meskipun hanya membaca beberapa ayat setiap hari, hal tersebut dapat memberikan pengaruh besar, terhadap keimanan dan ketenangan batin. Melalui Al-Qur'an, kita diajarkan tentang kesabaran, rasa syukur, ketulusan, dan tujuan hidup yang sebenarnya. Kebiasaan membaca Al-Qur'an membantu kita untuk lebih memahami makna kehidupan dan mendekatkan diri kepada Allah SWT.<br><br>
    Konsistensi adalah kunci utama. Di tengah kesibukan, meluangkan waktu sejenak untuk membaca dan merenungi makna ayat-ayat suci akan menumbuhkan kekuatan spiritual yang luar biasa. Selain itu, membaca Al-Qur'an secara teratur juga dapat meningkatkan kemampuan berbahasa Arab, memperdalam pemahaman agama, serta memberikan ketenangan emosional dalam menghadapi berbagai ujian hidup.<br><br>
    Menjadikan Al-Qur'an sebagai bagian dari rutinitas harian bukan hanya bentuk ibadah, tetapi juga jalan untuk menemukan kedamaian sejati dan petunjuk dalam setiap langkah kehidupan. Dengan membaca dan mengamalkan isi Al-Qur'an, kita senantiasa diingatkan untuk hidup dengan penuh cinta, hikmah, dan ketaatan kepada Allah SWT.`
  },
  2: {
    title: "Menemukan Ketenangan Melalui Rutinitas Salat",
    content: `Salat harian bukan hanya sekadar kewajiban spiritual, tetapi juga menjadi cara terbaik untuk menemukan ketenangan dan keseimbangan dalam hidup. Dengan melaksanakan salat tepat waktu dan penuh keikhlasan, hati kita menjadi lebih tenang, pikiran lebih fokus, dan jiwa terasa lebih damai. Salat membantu kita melepaskan penat, mengurangi stres, serta mengingatkan kembali bahwa segala urusan kehidupan sebaiknya disandarkan kepada Allah SWT.<br><br>
    Menjadikan salat sebagai rutinitas yang konsisten juga melatih kedisiplinan diri dan kemampuan mengatur waktu dengan baik. Setiap waktu salat merupakan jeda berharga yang memberi kesempatan untuk berhenti sejenak dari kesibukan dunia, merenungkan makna kehidupan, serta memperbarui semangat untuk terus berbuat kebaikan. Dengan begitu, salat bukan hanya ibadah, tetapi juga bentuk terapi batin yang menenangkan hati dan memperkuat jiwa.<br><br>
    Melalui salat, kita belajar tentang ketundukan, kesabaran, dan keikhlasan. Setiap gerakan dan bacaan di dalamnya memiliki makna mendalam yang menuntun kita menuju kehidupan yang lebih damai, penuh rasa syukur, dan dekat dengan Allah SWT. Menjadikan salat sebagai pusat dari aktivitas harian akan membawa keberkahan serta menjaga keseimbangan mental, emosional, dan spiritual kita sepanjang hari.`
  },
  3: {
    title: "Memilih Perlengkapan Salat yang Tepat",
    content: `Memilih perlengkapan salat yang nyaman dan bersih merupakan hal penting untuk meningkatkan kekhusyukan dalam beribadah. Perlengkapan seperti sajadah yang lembut, mukena atau sarung yang ringan, serta Al-Qur’an yang rapi dan terawat dapat menciptakan suasana tenang dan membantu kita lebih fokus saat beribadah kepada Allah SWT. Kenyamanan dalam beribadah bukan hanya soal fisik, tetapi juga membantu menumbuhkan rasa khusyuk dan ketenangan hati.<br><br>
    Sajadah yang dibuat dari bahan berkualitas akan memberikan rasa nyaman saat sujud, serta lebih awet digunakan dalam jangka panjang. Begitu pula dengan mukena atau sarung yang ringan dan mudah menyerap keringat, akan mendukung konsentrasi dan membuat ibadah terasa lebih tenang. Perlengkapan ibadah yang baik bukan hanya memperindah tampilan, tetapi juga mencerminkan rasa hormat dan kesungguhan kita dalam beribadah.<br><br>
    Di Nadi Bookstore, kami percaya bahwa setiap perlengkapan ibadah memiliki makna spiritual tersendiri. Setiap helai kain, setiap jahitan, dan setiap motif yang kami pilih mengandung niat untuk menghadirkan keindahan dalam kesederhanaan. Kami ingin membantu setiap umat Muslim menemukan kenyamanan dan ketenangan dalam setiap gerakan ibadahnya, sehingga salat tidak hanya menjadi rutinitas, tetapi juga momen berharga untuk mendekatkan diri kepada Sang Pencipta.`
  }
};

const modal = document.getElementById('newsModal');
const modalTitle = document.getElementById('modalTitle');
const modalContent = document.getElementById('modalContent');
const closeModal = document.getElementById('closeModal');

document.querySelectorAll('.read-more').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const id = e.target.getAttribute('data-article');
    modalTitle.innerHTML = articles[id].title;
    modalContent.innerHTML = articles[id].content;
    modal.classList.add('show');
  });
});

closeModal.addEventListener('click', () => {
  modal.classList.remove('show');  
});
</script>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
