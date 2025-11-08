<link rel="stylesheet" href="<?= BASEURL; ?>/css/admin.css">

<div class="dashboard-wrapper">
  <aside class="sidebar">
    <h3>Menu Admin</h3>
    <ul>
      <li><a href="#" class="active">Home</a></li>
      <li><a href="#">Order History</a></li>
      <li><a href="#">Finance</a></li>
      <li><a href="#">Blog & News</a></li>
      <li><a href="#">Stock</a></li>
      <li><a href="#">Report</a></li>
      <li><a href="#">Access Management</a></li>
      <li><a href="#">Emails</a></li>
      <li><a href="#">Calls</a></li>
      <li><a href="#">Settings</a></li>
      <li><a href="#">Profile (Andika Sigit)</a></li>
    </ul>
  </aside>
  <section class="main-content">
    <h2>Admin Dashboard</h2>
    <p>Selamat datang, <?= $_SESSION['user']['nama']; ?>!</p>
    <!-- Konten dashboard lainnya akan kita isi selanjutnya -->
  </section>
</div>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
