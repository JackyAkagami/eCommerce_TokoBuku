<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-box">
        <h2>Sign in</h2>

        <!-- Pesan error jika login gagal -->
        <?php if (!empty($error)): ?>
            <p style="color:red; font-size:14px;"><?= $error; ?></p>
        <?php endif; ?>
        
        <form method="POST" action="">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password*</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign in</button>
        </form>

        <div class="links">
            <a href="forget_pw.php">Forget Password</a>
            <a href="register.php">Create account</a>
        </div>

        <div class="footer">
            Copyright © 2025 LATOM
        </div>
    </div>
</body>
</html>
