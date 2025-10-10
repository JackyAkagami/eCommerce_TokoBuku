<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman -->
    <title>Register</title>
    <!-- Load file CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <!-- Supaya responsive di perangkat mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="register-page">

    <div class="register-box">
        <!-- Judul form registrasi -->
        <h2>Create a New Account</h2>

        <!-- Form registrasi user baru -->
        <!-- Method POST, action kosong artinya submit ke halaman ini sendiri -->
        <form method="POST" action="">
            <!-- Input nama -->
            <label for="nama">Name*</label>
            <input type="text" id="nama" name="nama" required>

            <!-- Input gender -->
            <label for="gender">Gender*</label>
            <select id="gender" name="gender" required>
                <option value="">Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <!-- Input email -->
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>

            <!-- Input nomor telepon -->
            <label for="no_hp">Phone*</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <!-- Input alamat -->
            <label for="alamat">Address*</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>

            <!-- Input password -->
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required>
            <!-- Catatan tambahan untuk password -->
            <p class="note">At least 6 characters with special character</p>

            <!-- Tombol submit registrasi -->
            <button type="submit">Sign up</button>
        </form>

        <!-- Link tambahan -->
        <div class="links">
            <!-- Link bantuan (belum diarahkan ke halaman tertentu) -->
            <a href="#">You need help?</a>
            <!-- Link menuju halaman login -->
            <a href="<?= BASEURL; ?>/auth/login">Do you already have an account?</a>
        </div>

        <!-- Link kembali ke halaman utama -->
        <div class="back-home-text">
            <a href="<?= BASEURL; ?>/home">Back to Home</a>
        </div>
    </div>
</body>
</html>
