<?php
include '../php/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'administrator') {
    session_start();
    header("Location: ./jurnal.php");
    exit();
}
 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = hash('sha256', $_POST['password']);
    $cpassword = hash('sha256', $_POST['cpassword']);
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (name, username, password, role)
                    VALUES ('$name', '$username', '$password', '$role')";
            $result = mysqli_query($koneksi, $sql);
            if ($result) {
                echo "<script>alert('Registrasi berhasil!')</script>";
                $nama = "";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                echo "<script>location='./register.php'; </script>";
            } else {
                echo "<script>alert('Terjadi kesalahan!')</script>";
            }
        } else {
            echo "<script>alert('Username Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai!')</script>";
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
    <title>Tambah User | MoneyKeeper</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.jpg">
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./jurnal.php">Jurnal</a></li>
        <li><a href="./akun.php">Akun</a></li>
        <li class="nav-active"><a href="./register.php">Tambah User</a></li>
        <button class="btn-akun right-link outBtn" data-modal-id="outModal"><i class="fa-regular fa-user"></i></button>
        <!-- LogOut Modal -->
        <div id="outModal" class="modal">
          <!-- LogOut Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeOut">&times;</span>
              <br>
              <h2>Detail User</h2>
            </div>
            <div class="modal-body">
              <div class="HiP center-txt">
                <h4>Nama:</h4>
                <p><?= $_SESSION['name']; ?></p>
              </div>
              <br>
              <div class="HiP center-txt">
                <h4>Username:</h4>
                <p><?= $_SESSION['username']; ?></p>
              </div>
              <br>
              <div class="HiP center-txt">
                  <h4>Role:</h4>
                  <?php 
                    if ($_SESSION['role'] == 'administrator') {
                      echo '<p>Administrator</p>';
                    } elseif ($_SESSION['role'] == 'user') {
                      echo '<p>User</p>';
                    }
                  
                  ?>
              </div>
              <form action="../php/logout.php" method="post" style="margin-top: 20px">
                <br>
                <button class="btn-delete" name="submit" type="submit">Logout</button>
              </form>
          </div>
          </div>
        </div>
      </ul>
    </div>
    <div class="main-register center-txt">
      <h1>Tambah User</h1>
      <form action="" method="post">
         <input
          type="text"
          name="name"
          id="name"
          placeholder="Name"
          required
        />
        <br />
        <input
          type="text"
          name="username"
          id="username"
          placeholder="Username"
          required
        />
        <br />
        <select
          name="role"
          id="role"
          required
        >
          <option value="" disabled selected hidden>Role</option>
          <option value="user">User</option>
          <option value="administrator">Administrator</option>
        </select>
        <br />
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Password"
          required
        />
        <br />
        <input
          type="password"
          name="cpassword"
          id="cpassword"
          placeholder="Confirm Password"
          required
        />
        <br />
        <button class="btn-login-own" name="submit" type="submit">Tambah</button>
      </form>
    </div>
    <script src="../js/script.js"></script>
    <script src="https://kit.fontawesome.com/d7d80f67ad.js" crossorigin="anonymous"></script>
  </body>
</html>