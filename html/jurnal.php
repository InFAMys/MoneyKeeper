<?php
include '../php/koneksi.php'; 

if (!isset($_SESSION['username'])) {
    session_start();
    header("Location: ./login.php");
    exit();
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
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <title>Jurnal | MoneyKeeper</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.jpg">
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li class="nav-active"><a href="./jurnal.php">Jurnal</a></li>
        <li><a href="./akun.php">Akun</a></li>
        <?php
           if ($_SESSION['role'] == 'administrator') {
                echo'<li><a href="./register.php">Tambah User</a></li>';
            }
        ?>
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
    <div class="j-table">
      <h1 class="center-txt" style="margin-top: 100px">Jurnal</h1>
      <button class="btn-add addBtn" data-modal-id="addModal"><i class="fa-solid fa-plus"> </i> Tambah</button>
      <!-- Add Modal -->
      <div id="addModal" class="modal" >
        <!-- Add Modal content -->
        <div class="modal-content">
            <div class="modal-header">
              <span class="closeAdd">&times;</span>
              <h1>Tambah Data</h1>
            </div>
            <div class="modal-body">
              <form method="post" class="form-input">
                  <label for="tanggal">Tanggal</label>
                  <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    style="margin-bottom: 30px"
                    required
                    />
                  <br />
                  <?php
                    $result = $koneksi->query("SELECT * FROM account");
                    echo '
                    <label for="nama_akun">Nama Akun</label>
                    <select
                      id="nama-akun"
                      name="nama-akun"
                      style="margin-bottom: 30px; height: 46px; width: 362px"
                      required
                    >
                      <option value="" disabled selected hidden>Pilih Akun</option>';
                      while ($row = $result->fetch_assoc()) {
                        echo '
                      <option value='.$row['id_account'].'>'.$row['account_name'].'</option> ';
                    }
                    echo '
                    </select>';
                    ?>
                  <br />
                  <label for="debit">Debit</label>
                  <br>
                  <input
                    type="number"
                    name="debit"
                    id="debit"
                    style="margin-bottom: 30px"
                    placeholder="Masukkan Jumlah Debit"
                    />
                  <br />
                  <label for="kredit">Kredit</label>
                  <br>
                  <input
                    type="number"
                    name="kredit"
                    id="kredit"
                    style="margin-bottom: 30px"
                    placeholder="Masukkan Jumlah Kredit"
                    />
                  <br />
                  <button class="btn-submit" type="submit" name="submit">Tambah</button>
              </form>
            </div>
        </div>
      </div>
      <?php

        if (isset($_POST['submit'])) {
            $tanggal = $_POST['tanggal'];
            $nama_akun = $_POST['nama-akun'];
            $debit = $_POST['debit'];
            $kredit = $_POST['kredit'];

            $koneksi->query("INSERT INTO jurnal (tanggal,id_account,debit,kredit) VALUES ('$tanggal','$nama_akun','$debit','$kredit') ");
            echo "<script>alert('Data Berhasil Ditambahkan!'); </script>";
            echo "<script>location='jurnal.php'; </script>";
        }
      ?>
      <table>
        <tr class="montfont-b">
          <th>Tanggal</th>
          <th>Nama Akun</th>
          <th>Referensi</th>
          <th>Debit</th>
          <th>Kredit</th>
          <th>Action</th>
        </tr>
        <?php

        $result = $koneksi->query("SELECT * FROM jurnal j, account a WHERE j.id_account=a.id_account ORDER BY tanggal");
        
        while ($row = $result->fetch_assoc()) {
          $id_jurnal=$row['id_jurnal'];
          $debit =$row['debit'];
          if ($debit == NULL || $debit == 0) {
            $de="-";
            $dee="0";
          } else {
            $de=$debit;
            $dee=$debit;
          }

          $kredit =$row['kredit'];
          if ($kredit == NULL || $kredit == 0) {
            $kr="-";
            $kre="0";
          } else {
            $kr=$kredit;
            $kre=$kredit;
          }
            echo "<tr>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['account_name'] . "</td>";
            echo "<td>" . $row['no_account'] . "</td>";
            if ($de == "-") {
              echo "<td>" . $de . "</td>";
            } else {
              echo "<td class='fDebit'>" . $de . "</td>";
            }
            if ($kr == "-") {
              echo "<td>" . $kr . "</td>";
            } else {
              echo "<td class='fDebit'>" . $kr . "</td>";
            }
            echo '<td>
            <button class="btn-edit editBtn" data-modal-id="editModal-'. $row['id_jurnal'] .'" action="edit">
            <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <!-- Edit Modal -->
              <div id="editModal-'. $row['id_jurnal'] .'" class="modal" >
                <!-- Edit Modal content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <span class="closeEd">&times;</span>
                    <h2>Edit Data</h2>
                  </div>
                  <div class="modal-body">
                <form method="post" class="form-input">
                  <input type="hidden" name="id-jurnal" id="id-jurnal" value='. $row['id_jurnal'] .'>
                  <label for="tanggal">Tanggal</label>
                  <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    style="margin-bottom: 30px"
                    value='.$row['tanggal'].'
                    required
                  />
                  <br />
                  <label for="nama-akun">Nama Akun</label>
                  <select
                    id="nama-akun"
                    name="nama-akun"
                    style="margin-bottom: 30px; height: 46px; width: 362px"
                    required
                  >
                    <option value='.$row['id_account'].'>'.$row['account_name'].'</option>';
                    $accres = $koneksi->query("SELECT * FROM account");
                    while ($acc = $accres->fetch_assoc()) {
                      if ($row['id_account'] != $acc['id_account']) {
                        echo '
                        <option value='.$acc['id_account'].'>'.$acc['account_name'].'</option> ';
                      }

                  }
                  echo '
                  </select>
                  <br />
                  <label for="debit">Debit</label>
                  <br>
                  <input
                    type="number"
                    name="debit"
                    id="debit"
                    style="margin-bottom: 30px"
                    value='.$row['debit'].'
                  />
                  <br />
                  <label for="kredit">Kredit</label>
                  <br>
                  <input
                    type="text"
                    name="kredit"
                    id="kredit"
                    style="margin-bottom: 30px"
                    value='.$row['kredit'].'
                  />
                  <br />
                  <button class="btn-submit" type="update" name="update">Edit</button>
                </form>
                  </div>
                </div>
              </div>
            
            <button class="btn-delete deleteBtn" data-modal-id="deleteModal-'. $row['id_jurnal'] .'">
            <i class="fa-regular fa-trash-can"></i>
            </button>
            <!-- Delete Modal -->
            <div id="deleteModal-'. $row['id_jurnal'] .'" class="modal">
              <!-- Delete Modal content -->
              <div class="modal-content">
                <div class="modal-header">
                  <span class="closeDel">&times;</span>
                  <h2>Delete Data</h2>
                </div>
                <div class="modal-body">
                  <p>Are You Sure ?</p>
                </div>
                <div class="modal-footer">';
                  echo "
                  <a class='btn-delete' href='?action=delete&id_jurnal=" . $row['id_jurnal'] . "'>Yes</a>";
                  echo '
                  <button class="btn-edit noButtons" >No</button>
                </div>
              </div>
            </div>
          </td>';
            echo "</tr>";
        }

        if (isset($_POST['update'])) {
          $id_jurnal = $_POST['id-jurnal'];
          $nama_akun = $_POST['nama-akun'];
          $debit = $_POST['debit'];
          $kredit = $_POST['kredit'];
          $tanggal = $_POST['tanggal'];
  
          // Update data in the database
          $koneksi->query("UPDATE jurnal SET 
              id_account='$nama_akun', tanggal='$tanggal', debit='$debit', kredit='$kredit'
              WHERE id_jurnal='$id_jurnal' ;
          ");
          // echo "UPDATE jurnal SET  id_account='$nama_akun', tanggal='$tanggal', debit='$debit', kredit='$kredit' WHERE id_jurnal=$id_jurnal";
          echo "<script>alert('Data berhasil diupdate'); </script>";
          echo "<script>location='./jurnal.php'; </script>";
      }

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
          $id_jurnal = $_GET['id_jurnal'];
          if ($action == 'delete') {
            $koneksi->query("DELETE FROM jurnal WHERE id_jurnal=$id_jurnal");
            echo "<script>alert('Data Berhasil Dihapus!'); </script>";
            echo "<script>location='./jurnal.php'; </script>";
        }
      } 
        ?>
      </table>
    </div>
    
    <script src="../js/script.js"></script>
    <script src="https://kit.fontawesome.com/d7d80f67ad.js" crossorigin="anonymous"></script>
  </body>
</html>
