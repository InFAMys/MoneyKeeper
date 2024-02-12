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
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <title>Jurnal</title>
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./input.php">Input Jurnal</a></li>
        <li class="nav-active"><a href="./jurnal.php">Jurnal</a></li>
        <a class="btn-nav right-link" href="./login.php">Login</a>
      </ul>
    </div>
    <div class="j-table">
      <h1 class="center-txt">Jurnal</h1>
      <button class="btn-tambah tambahBtn" data-modal-id="tambahModal" action="post" style="margin-bottom: 20px">
        Tambah Data
      </button>
      <div id="tambahModal" class="modal" >
        <!-- Tambah Modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <span class="closeT">&times;</span>
            <h2>Edit Data</h2>
          </div>
          <div class="modal-body">
          <form method="post" class="form-input">
              <label for="nama-akun">Nama Akun</label>
              <select
            id="nama-akun"
            name="nama-akun"
            style="margin-bottom: 30px"
            required
          >
          <?php 
            $result = $koneksi->query("SELECT * FROM account");
            while ($row = $result->fetch_assoc()) {
                echo '<option value='.$row['id_account'].'>'.$row['account_name'].'</option>';
              }
          ?>
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
                  echo "<script>location='jurnal.php'; </script>";
              }
            ?>
          </div>
        </div>
      </div>

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
        // Retrieve data from the database
        $result = $koneksi->query("SELECT * FROM jurnal j, account a WHERE j.id_account=a.id_account ORDER BY tanggal");
        
        // Display data in a table
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
            echo "<td>" . $de . "</td>";
            echo "<td>" . $kr . "</td>";
            echo '<td>
            <button class="btn-edit editBtn" data-modal-id="editModal-'. $row['id_jurnal'] .'" action="edit">
              Edit
            </button>
            <!-- Edit Modal -->
              <div id="editModal-'. $row['id_jurnal'] .'" class="modal" >
                <!-- Edit Modal content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <span class="closeEd">&times;</span>
                    <h2>Edit Data</h2>
                    <h2>'. $row['id_jurnal'] .'</h2>
                  </div>
                  <div class="modal-body">
                    <form method="post" class="form-input">
                    <input type="hidden" name="id-jurnal" id="id-jurnal" value='. $row['id_jurnal'] .'>
                      <label for="nama-akun">Nama Akun</label>
                      <select
                    id="nama-akun"
                    name="nama-akun"
                    style="margin-bottom: 30px"
                    required
                  >
                  <option value='.$row['id_account'].'>'.$row['account_name'].'</option>';

                    $accres = $koneksi->query("SELECT * FROM account");
                    while ($acc = $accres->fetch_assoc()) {
                      if ($row['id_account'] != $acc['id_account']) {
                        echo '<option value='.$acc['id_account'].'>'.$acc['account_name'].'</option>';
                      }
                    }
                  echo '
                  </select>
                      <br />
                      <label for="debit">Debit</label>
                      <input
                        type="text"
                        name="debit"
                        id="debit"
                        style="margin-bottom: 30px"
                        value=' . $dee . '
                      />
                      <br />
                      <label for="kredit">Kredit</label>
                      <input
                        type="text"
                        name="kredit"
                        id="kredit"
                        style="margin-bottom: 30px"
                        value=' . $kre . '
                      />
                      <br />
                      <label for="date">Tanggal</label>
                      <input
                        type="date"
                        name="date"
                        id="date"
                        required
                        style="margin-bottom: 30px"
                        value=' . $row['tanggal'] . '
                      />
                      <br />
                      <button class="btn-submit" type="update" name="update">Edit</button>
                    </form>
                  </div>
                </div>
              </div>
            <button class="btn-delete deleteBtn" data-modal-id="deleteModal-'. $row['id_jurnal'] .'">
              Delete
            </button>
            <!-- Delete Modal -->
            <div id="deleteModal-'. $row['id_jurnal'] .'" class="modal">
              <!-- Delete Modal content -->
              <div class="modal-content">
                <div class="modal-header">
                  <span class="closeDel">&times;</span>
                  <h2>Delete Data</h2>
                  <h2>'. $row['id_jurnal'] .'</h2>
                  <input type="hidden" name="id-jurnal" id="id-jurnal" value='. $row['id_jurnal'] .'>
                </div>
                <div class="modal-body">
                  <p>Are You Sure ?</p>
                </div>
                <div class="modal-footer">
                  <button class="btn-delete" type="update" name="update">Yes</button>
                  <button class="btn-edit">No</button>
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
          $tanggal = $_POST['date'];
  
          // Update data in the database
          $koneksi->query("UPDATE jurnal SET 
              id_account='$nama_akun', tanggal='$tanggal', debit='$debit', kredit='$kredit'
              WHERE id_jurnal='$id_jurnal' ;
          ");
          // echo "UPDATE jurnal SET  id_account='$nama_akun', tanggal='$tanggal', debit='$debit', kredit='$kredit' WHERE id_jurnal=$id_jurnal";
          // echo "<script>alert('Data berhasil diupdate'); </script>";
          echo "<script>location='./jurnal.php'; </script>";
      }
      if (isset($_GET['action'])) {
          $action = $_GET['action'];
          // Delete Action
          if ($method == 'delete') {
          // $id_jurnal=$_GET
            // Delete data from the database
            $koneksi->query("DELETE FROM jurnal id_jurnal=$id_jurnal");
            echo "<script>alert('Data berhasil dihapus'); </script>";
            echo "<script>location='./jurnal.php'; </script>";
        }
      } 
        ?>
      </table>
    </div>
    


    <script src="../js/modal.js"></script>
    <script src="../js/moneyFormat.js"></script>
  </body>
</html>
