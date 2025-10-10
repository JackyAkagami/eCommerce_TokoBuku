<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman -->
    <title>Login</title>
    <!-- Load file CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-box">
            <!-- Judul form login -->
            <h2>Sign in</h2>

            <!-- Tampilkan pesan error jika ada (misalnya email/password salah) -->
            <?php if (!empty($data['error'])): ?>
                <p style="color:red; font-size:14px;"><?= $data['error']; ?></p>
            <?php endif; ?>

            <!-- Form login -->
            <!-- Method POST, action kosong artinya submit ke halaman ini sendiri -->
            <form method="POST" action="">
                <!-- Input email -->
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>

                <!-- Input password -->
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" required>

                <!-- Tombol submit login -->
                <button type="submit">Sign in</button>
            </form>

            <!-- Link tambahan -->
            <div class="links">
                <!-- Menuju halaman lupa password -->
                <a href="<?= BASEURL; ?>/auth/forgot">Forget Password</a>
                <!-- Menuju halaman registrasi -->
                <a href="<?= BASEURL; ?>/auth/register">Create account</a>
            </div>

            <!-- Link untuk kembali ke halaman utama -->
            <div class="back-home-text">
                <a href="<?= BASEURL; ?>/home">Back to Home</a>
            </div>
            
            <!-- Footer copyright -->
            <div class="footer">
                <p>Copyright © <?= date("Y"); ?> Nadi</p>
            </div>
        </div>
    </div>
</body>
</html>
