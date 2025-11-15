<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mpk WHERE id_mpk='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
  $id_siswa = $_POST['id_siswa'];
  $id_kelas = $_POST['id_kelas'];
  $username = $_POST['username'];

  mysqli_query($koneksi, "UPDATE mpk 
      SET id_siswa='$id_siswa',
          id_kelas='$id_kelas',
          username='$username'
      WHERE id_mpk='$id'");
  header("Location: index.php?page=mpk&pesan=edit");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit MPK</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit MPK</h2>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-control" required>
              <option value="">-- Pilih Siswa --</option>
              <?php
              $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
              while ($s = mysqli_fetch_assoc($siswa)) {
                  $selected = ($s['id_siswa'] == $row['id_siswa']) ? "selected" : "";
                  echo "<option value='{$s['id_siswa']}' $selected>{$s['nama_siswa']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" required>
              <option value="">-- Pilih Kelas --</option>
              <?php
              $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
              while ($k = mysqli_fetch_assoc($kelas)) {
                  $selected = ($k['id_kelas'] == $row['id_kelas']) ? "selected" : "";
                  echo "<option value='{$k['id_kelas']}' $selected>{$k['nama_kelas']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" required>
          </div>
          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>
            <a href="index.php?page=mpk" class="btn" 
               style="background:#222; color:#FFD700; border:1px solid #FFD700;">
              ⬅️ Kembali
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
