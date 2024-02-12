<?php
include '../php/koneksi.php';

 
if (isset($_SESSION['username'])) {
    session_start();
    header("Location: ./jurnal.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
 
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);
 
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        header("Location: ./jurnal.php");
        exit();
    } else {
        echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <title>Login | MoneyKeeper</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.jpg">
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./jurnal.php">Jurnal</a></li>
        <li><a href="./akun.php">Akun</a></li>
        <a class="right-link" href=""></a>
      </ul>
    </div>
    <div class="main">
      <div class="back">
        <a href="../index.php">< Go Back</a>
      </div>
      <h1 class="top-h1">Login</h1>
      <form action="" method="post">
        <input
          type="text"
          name="username"
          id="username"
          placeholder="Username"
          required
        />
        <br />
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Password"
          required
        />
        <br />
        <button class="btn-login-own" name="submit" type="submit">Login</button>
      </form>
    </div>
  </body>
</html>
