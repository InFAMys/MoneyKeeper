<?php
include './php/koneksi.php'; 

if (isset($_SESSION['username'])) {
    session_start();
    header("Location: ./html/jurnal.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <title>Home | MoneyKeeper</title>
    <link rel="icon" type="image/x-icon" href="./img/logo.jpg">
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li class="nav-active"><a href="./index.php">Home</a></li>
        <li><a href="./html/jurnal.php">Jurnal</a></li>
        <li><a href="./html/akun.php">Akun</a></li>
        <a class="btn-nav right-link" href="./html/login.php">Login</a>
      </ul>
    </div>
    <div class="main">
      <h1 class="center-txt">Welcome To MoneyKeeper !</h1>
      <img src="./img/logo.jpg" alt="" width="200px" height="200px" />
      <h4>Please click the button below to continue:</h4>
      <a href="./html/login.php" class="btn-login">Login</a>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://kit.fontawesome.com/d7d80f67ad.js" crossorigin="anonymous"></script>
  </body>
</html>
