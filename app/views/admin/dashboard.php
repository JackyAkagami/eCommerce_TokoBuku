<div class="container">
    <!-- Judul halaman dashboard admin -->
    <h2>Admin Dashboard</h2>

    <!-- Menampilkan ucapan selamat datang dengan nama user yang sedang login -->
    <!-- Nama diambil dari session user yang sudah diset setelah login -->
    <p>Selamat datang, <?= $_SESSION['user']['nama']; ?>!</p>
</div>
