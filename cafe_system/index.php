<?php require 'db.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CafeXpress — Home</title>
  <link rel="stylesheet" href="style.css">

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR (on top of images) -->
<div class="navbar">
    <div class="logo">CafeXpress</div>
    <div class="nav-right">
        <a href="login.php" class="btn nav-btn">Login</a>
        <a href="register.php" class="btn nav-btn">Register</a>
        <a href="admin_login.php" class="btn nav-btn admin-btn">Admin Login</a>
    </div>
</div>

<!-- FULLSCREEN COLLAGE SPLIT INTO 2 HALF IMAGES -->
<div class="collage-wrapper">

    <img src="images/p1.png" class="collage-img collage-left">
    <img src="images/p2.png" class="collage-img collage-right">

    <!-- CENTERED CONTENT -->
    <div class="home-overlay">
        <h1 class="big-cafe-title">CafeXpress</h1>

        <p class="sub-text">
            Where every sip tells a story.<br>
            Fresh brews • Soft vibes • Cozy moments
        </p>

        <a href="login.php" class="btn explore-btn glow-btn">Explore Menu →</a>
    </div>

</div>

</body>
</html>
