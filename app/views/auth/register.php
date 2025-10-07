<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a Monora Account</title>
  <link rel="stylesheet" href="style.css">

  <!-- Google Fonts: Poppins -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>
</head>
<body>
  <!-- Logo -->
  <header class="topbar">
    <div class="brand">
      <img src="asep/Vector.png" alt="Monora Logo" class="logo-img">
      <span class="logo-text">monora</span>
    </div>
  </header>

  <!-- Content -->
  <main class="content">
    <h1>Simplifying Business,<br>Empowering Growth.</h1>

    <h2>Create a Monora Account</h2>
    <form>
      <label for="name">Name*</label>
      <input type="text" id="name" placeholder="Enter your name" required>

      <label for="email">Email*</label>
      <input type="email" id="email" placeholder="Enter your email" required>

      <label for="phone">Phone</label>
      <div class="phone-group">
        <input type="text" class="phone-code" placeholder="+62">
        <input type="text" class="phone-number" placeholder="8123456789">
      </div>

      <label for="password">Password*</label>
      <input type="password" id="password" placeholder="Enter your password" required>
      <small>At least 6 characters with special character</small>

      <div class="links">
        <a href="#">You need help?</a>
        <a href="#">Do you already have an account?</a>
      </div>

      <button type="submit" class="btn">Sign up</button>
    </form>
  </main>

  <!-- Call Center Logo (pojok kanan bawah) -->
  <img src="asep/Component 10.png" alt="Call Center" class="call-center">

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 monora</p>
  </footer>
</body>
</html>
