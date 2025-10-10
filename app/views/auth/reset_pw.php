<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Judul halaman -->
  <title>Reset Password - Nadi</title>
  <!-- Load CSS utama -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body class="login-page">
  <div class="login-box">
    <!-- Judul form -->
    <h2>Reset Password</h2>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (!empty($data['error'])): ?>
      <p style="color: red;"><?= $data['error']; ?></p>
    <?php endif; ?>

    <!-- Tampilkan pesan sukses jika password berhasil direset -->
    <?php if (!empty($data['success'])): ?>
      <p style="color: green;"><?= $data['success']; ?></p>
    <?php endif; ?>

    <!-- Form reset password -->
    <form action="<?= BASEURL; ?>/auth/reset_process" method="post">
      <!-- Email disertakan secara hidden untuk keamanan -->
      <input type="hidden" name="email" value="<?= $data['email'] ?? '' ?>">

      <!-- Input password baru -->
      <label for="password">New Password*</label>
      <input type="password" id="password" name="password" required>

      <!-- Input konfirmasi password baru -->
      <label for="confirm">Confirm Password*</label>
      <input type="password" id="confirm" name="confirm" required>

      <!-- Tombol submit untuk reset -->
      <button type="submit">Reset Password</button>
    </form>

    <!-- Link kembali ke halaman login -->
    <div class="links">
      <a href="<?= BASEURL; ?>/auth/login">Back to Login</a>
    </div>
  </div>
</body>
</html>
