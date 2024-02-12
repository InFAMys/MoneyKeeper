<?php include '../php/koneksi.php'; ?>
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
    <title>Input Jurnal</title>
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li class="nav-active"><a href="#">Input Jurnal</a></li>
        <li><a href="./jurnal.php">Jurnal</a></li>
        <a class="btn-nav right-link" href="./login.php">Login</a>
      </ul>
    </div>
    <div class="main">
      <h1>Input Jurnal</h1>
      <form method="post" class="form-input">
        <label for="nama-akun">Nama Akun</label>
        <select
          id="nama-akun"
          name="nama-akun"
          style="margin-bottom: 30px"
          required
        >
          <option value=""></option>
          <option value="1">Cash In Bank</option>
          <option value="2">Petty Cash</option>
          <option value="3">Account Receivable</option>
          <option value="4">Supplies</option>
        </select>
        <br />
        <label for="debit">Debit</label>
        <input
          type="text"
          name="debit"
          id="debit"
          style="margin-bottom: 30px"
        />
        <br />
        <label for="kredit">Kredit</label>
        <input
          type="text"
          name="kredit"
          id="kredit"
          style="margin-bottom: 30px"
        />
        <br />
        <label for="date">Tanggal</label>
        <input
          type="date"
          name="date"
          id="date"
          required
          style="margin-bottom: 30px"
        />
        <br />
        <button class="btn-submit" type="submit" name="submit">Submit</button>
      </form>
      <?php
    // check apakah data disubmit
    if (isset($_POST['submit'])) {
        $nama_akun = $_POST['nama-akun'];
        $debit = $_POST['debit'];
        $kredit = $_POST['kredit'];
        $tanggal = $_POST['date'];
        //querry insert database
        $koneksi->query("INSERT INTO jurnal (tanggal,id_account,debit,kredit) 
    VALUES ('$tanggal','$nama_akun','$debit','$kredit') ");
        echo "<script>location='input.php'; </script>";
    }
    ?>
    </div>
    <script src="../js/moneyFormat.js"></script>
  </body>
</html>
