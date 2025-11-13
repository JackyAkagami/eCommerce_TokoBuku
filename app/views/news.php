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
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">The Importance of Reading the Qur'an Daily</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Reading the Qur'an brings peace and guides us toward a better life...</p>
        <a href="#" class="read-more" data-article="1" style="color:#586053; font-weight:bold; font-size:13px; text-decoration:underline;">Read More</a>
      </div>
    </div>

    <!-- Artikel 2 -->
    <div class="news-card" style="background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
      <div style="padding:18px;">
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">Finding Calm Through Prayer Routines</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Prayer is not just worship — it is a way to find peace in everyday chaos...</p>
        <a href="#" class="read-more" data-article="2" style="color:#586053; font-weight:bold; font-size:13px; text-decoration:underline;">Read More</a>
      </div>
    </div>

    <!-- Artikel 3 -->
    <div class="news-card" style="background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
      <div style="padding:18px;">
        <h3 style="font-size:18px; font-weight:600; margin-bottom:10px;">Choosing the Right Prayer Equipment</h3>
        <p style="font-size:14px; color:#555; margin-bottom:15px;">Comfort and quality are essential for creating a meaningful prayer experience...</p>
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
    title: "The Importance of Reading the Qur'an Daily",
    content: `Reading the Qur'an every day strengthens our connection with Allah, increases our understanding of His words, and brings peace to the heart. Even just a few verses a day can have a great impact on our life, reminding us of patience, gratitude, and purpose.<br><br>
    Consistency is key — even when we’re busy, dedicating a short time for recitation helps us reflect and grow spiritually. Moreover, reading the Qur'an regularly improves our focus, language skills, and emotional calmness. It serves as daily guidance in making moral and life decisions.`
  },
  2: {
    title: "Finding Calm Through Prayer Routines",
    content: `Daily prayers not only fulfill our spiritual duties but also provide structured moments of reflection and calmness. By praying on time and with sincerity, we can release stress, regain focus, and maintain a positive state of mind.<br><br>
    Establishing a consistent prayer routine can improve time management and strengthen self-discipline. It’s not only an act of worship but also a way to nurture mental and emotional balance, offering a sacred pause in the middle of our busy daily life.`
  },
  3: {
    title: "Choosing the Right Prayer Equipment",
    content: `Choosing comfortable and clean prayer equipment, such as soft prayer mats and garments, enhances our worship experience. The right equipment helps us maintain focus and humility, creating a peaceful environment during prayer.<br><br>
    A well-made sajadah with quality materials provides comfort for sujud and prolongs its use. Similarly, mukena or sarung that are light and breathable support better concentration during prayer. At Nadi Bookstore, we believe that each piece of worship gear holds not just physical value but spiritual meaning.`
  }
};

document.querySelectorAll('.read-more').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const id = e.target.getAttribute('data-article');
    document.getElementById('modalTitle').innerHTML = articles[id].title;
    document.getElementById('modalContent').innerHTML = articles[id].content;
    const modal = document.getElementById('newsModal');
    modal.classList.add('show');
  });
});

document.getElementById('closeModal').addEventListener('click', () => {
  const modal = document.getElementById('newsModal');
  modal.classList.remove('show');
  setTimeout(() => modal.style.display = 'none', 400);
});

const modal = document.getElementById('newsModal');
modal.addEventListener('animationend', () => {
  if (!modal.classList.contains('show')) {
    modal.style.display = 'none';
  } else {
    modal.style.display = 'flex';
  }
});
</script>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
