<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Judul halaman -->
  <title>Forgot Password - Nadi</title>
  <!-- Load file CSS utama -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body class="login-page">
  <div class="login-box">
    <!-- Judul halaman -->
    <h2>Forgot Password</h2>
    <!-- Keterangan instruksi -->
    <p>Please enter your email address. If it’s registered, you can reset your password.</p>

    <!-- Tampilkan pesan error jika ada (misalnya email tidak ditemukan) -->
    <?php if (!empty($data['error'])): ?>
      <p style="color: red;"><?= $data['error']; ?></p>
    <?php endif; ?>

    <!-- Form input email untuk reset password -->
    <form action="<?= BASEURL; ?>/auth/forgot_process" method="post">
      <label for="email">Email*</label>
      <!-- Input email wajib diisi -->
      <input type="email" id="email" name="email" required>
      <!-- Tombol submit untuk melanjutkan proses reset -->
      <button type="submit">Continue</button>
    </form>

    <!-- Link navigasi tambahan -->
    <div class="links">
      <!-- Kembali ke halaman login -->
      <a href="<?= BASEURL; ?>/auth/login">Back to Login</a>
      <!-- Menuju ke halaman register -->
      <a href="<?= BASEURL; ?>/auth/register">Create Account</a>
    </div>

    <!-- Link untuk kembali ke halaman utama -->
    <div class="back-home-text">
      <a href="<?= BASEURL; ?>/home">Back to Home</a>
    </div>
  </div>
</body>
</html>
