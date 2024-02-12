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

    <title>Akun | MoneyKeeper</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.jpg">
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./jurnal.php">Jurnal</a></li>
        <li class="nav-active"><a href="./akun.php">Akun</a></li>
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
                  <p><?php echo $_SESSION['name']; ?></p>
                </div>
                <br>
                <div class="HiP center-txt">
                  <h4>Username:</h4>
                  <p><?php echo $_SESSION['username']; ?></p>
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
      <h1 class="center-txt" style="margin-top: 100px">Akun</h1>
      <button class="btn-add addBtn" data-modal-id="addModal"><i class="fa-solid fa-plus"> </i> Tambah</button>
      <!-- Add Modal -->
      <div id="addModal" class="modal" >
        <!-- Add Modal content -->
        <div class="modal-content">
            <div class="modal-header">
              <span class="closeAdd">&times;</span>
              <h1>Tambah Akun</h1>
            </div>
            <div class="modal-body">
              <form method="post" class="form-input">
                  <label for="referensi">Referensi</label>
                  <br>
                  <input
                    type="text"
                    name="referensi"
                    id="referensi"
                    style="margin-bottom: 30px"
                    />
                  <br />
                  <label for="nama-akun">Nama Akun</label>
                  <br>
                  <input
                    type="text"
                    name="nama-akun"
                    id="nama-akun"
                    style="margin-bottom: 30px"
                    />
                  <br />
                  <button class="btn-submit" type="submit" name="submit">Tambah</button>
              </form>
            </div>
        </div>
      </div>
      <?php

        if (isset($_POST['submit'])) {
            $referensi = $_POST['referensi'];
            $nama_akun = $_POST['nama-akun'];

            $koneksi->query("INSERT INTO account (no_account,account_name) VALUES ('$referensi','$nama_akun') ");
            echo "<script>alert('Akun Berhasil Ditambahkan!'); </script>";
            echo "<script>location='akun.php'; </script>";
        }
      ?>
      <table>
        <tr class="montfont-b">
          <th>Referensi</th>
          <th>Nama Akun</th>
          <th>Action</th>
        </tr>
        <?php

        $result = $koneksi->query("SELECT * FROM account ORDER BY no_account");
        
        while ($row = $result->fetch_assoc()) {
          $id_account=$row['id_account'];
            echo "<tr>";
            echo "<td>" . $row['no_account'] . "</td>";
            echo "<td>" . $row['account_name'] . "</td>";
            echo '<td>
            <button class="btn-edit editBtn" data-modal-id="editModal-'. $row['id_account'] .'" action="edit">
            <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <!-- Edit Modal -->
              <div id="editModal-'. $row['id_account'] .'" class="modal" >
                <!-- Edit Modal content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <span class="closeEd">&times;</span>
                    <h2>Edit Data</h2>
                  </div>
                  <div class="modal-body">
                <form method="post" class="form-input">
                  <input type="hidden" name="id-akun" id="id-akun" value='. $row['id_account'] .'>
                  <label for="referensi">Referensi</label>
                  <br>
                  <input
                    type="text"
                    name="referensi"
                    id="referensi"
                    style="margin-bottom: 30px"
                    value="'.$row['no_account'].'"
                  />
                  <br />
                  <label for="nama-akun">Nama Akun</label>
                  <br>
                  <input
                    type="text"
                    name="nama-akun"
                    id="nama-akun"
                    style="margin-bottom: 30px"
                    value="'. $row['account_name'] .'"
                  />
                  <br />
                  <button class="btn-submit" type="update" name="update">Edit</button>
                </form>
                  </div>
                </div>
              </div>
            
            <button class="btn-delete deleteBtn" data-modal-id="deleteModal-'. $row['id_account'] .'">
            <i class="fa-regular fa-trash-can"></i>
            </button>
            <!-- Delete Modal -->
            <div id="deleteModal-'. $row['id_account'] .'" class="modal">
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
                  <a class='btn-delete' href='?action=delete&id_account=" . $row['id_account'] . "'>Yes</a>";
                  echo '
                  <button class="btn-edit noButtons" >No</button>
                </div>
              </div>
            </div>
          </td>';
            echo "</tr>";
        }

        if (isset($_POST['update'])) {
          $id_akun = $_POST['id-akun'];
          $referensi = $_POST['referensi'];
          $nama_akun = $_POST['nama-akun'];
  
          // Update data in the database
          $koneksi->query("UPDATE account SET 
              no_account='$referensi', account_name='$nama_akun'
              WHERE id_account='$id_akun' ;
          ");
          // echo "UPDATE jurnal SET  id_account='$nama_akun', tanggal='$tanggal', debit='$debit', kredit='$kredit' WHERE id_jurnal=$id_jurnal";
          echo "<script>alert('Akun berhasil diupdate'); </script>";
          echo "<script>location='./akun.php'; </script>";
      }

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
          $id_account = $_GET['id_account'];
          if ($action == 'delete') {
            $koneksi->query("DELETE FROM account WHERE id_account=$id_account");
            echo "<script>alert('Akun Berhasil Dihapus!'); </script>";
            echo "<script>location='./akun.php'; </script>";
        }
      } 
        ?>
      </table>
    </div>
    
    <script src="../js/script.js"></script>
    <script src="https://kit.fontawesome.com/d7d80f67ad.js" crossorigin="anonymous"></script>
  </body>
</html>
