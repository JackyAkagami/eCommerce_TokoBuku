<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Judul halaman, diambil dari variabel $data['title'], default "Ecommerce" -->
  <title><?= $data['title'] ?? 'Ecommerce'; ?></title>

  <!-- Load stylesheet utama -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
  <!-- Load ikon Font Awesome (untuk ikon user, cart, globe, dll) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header class="navbar">
  <div class="container">
    <!-- Logo website -->
    <h1 class="logo">Nadi</h1>

    <!-- Menu navigasi kiri -->
    <nav>
      <ul class="nav-links">
        <li><a href="<?= BASEURL; ?>/home">Home</a></li>
        <li><a href="<?= BASEURL; ?>/produk">Shop</a></li>
        <li><a href="<?= BASEURL; ?>/news">News</a></li>
        <li><a href="<?= BASEURL; ?>/about">About</a></li>
        <li><a href="<?= BASEURL; ?>/contact">Contact</a></li>
      </ul>
    </nav>

    <!-- Ikon navigasi kanan -->
    <div class="nav-icons">
      <!-- Ikon keranjang belanja -->
      <a href="<?= BASEURL; ?>/cart" class="icon"><i class="fas fa-shopping-bag"></i></a>

      <!-- Dropdown profile user -->
      <div class="dropdown">
        <!-- Tombol ikon user -->
        <button class="icon"><i class="fas fa-user"></i></button>
        <div class="dropdown-content">
          <?php if (isset($_SESSION['user'])): ?>
              <!-- Jika user sudah login -->
              <a href="<?= BASEURL; ?>/profile">Profile</a>

              <!-- Jika user role-nya admin, tampilkan link ke dashboard admin -->
              <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                  <a href="<?= BASEURL; ?>/admin/dashboard">Administrator</a>
              <?php endif; ?>

              <!-- Logout -->
              <a href="<?= BASEURL; ?>/auth/logout">Logout</a>
          <?php else: ?>
              <!-- Jika belum login, tampilkan link login -->
              <a href="<?= BASEURL; ?>/auth/login">Login</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Dropdown pilihan bahasa -->
      <div class="dropdown">
        <!-- Tombol ikon globe -->
        <button class="icon"><i class="fas fa-globe"></i></button>
        <div class="dropdown-content">
          <!-- Pilihan bahasa -->
          <a href="?lang=id">Indonesia</a>
          <a href="?lang=en">English</a>
        </div>
      </div>
    </div>
  </div>
</header>
