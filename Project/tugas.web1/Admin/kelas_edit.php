<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
  $nama = $_POST['nama_kelas'];
  $id_jurusan = $_POST['id_jurusan'];
  $id_guru = $_POST['id_guru'];

  mysqli_query($koneksi, "UPDATE kelas 
      SET nama_kelas='$nama',
          id_jurusan='$id_jurusan',
          id_guru='$id_guru'
      WHERE id_kelas='$id'");
  header("Location: index.php?page=kelas&pesan=edit");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kelas</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Kelas</h2>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="<?= $row['nama_kelas'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Guru</label>
            <select name="id_guru" class="form-control" required>
              <option value="">-- Pilih Guru --</option>
              <?php
              $guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
              while ($g = mysqli_fetch_assoc($guru)) {
                  $selected = ($g['id_guru'] == $row['id_guru']) ? "selected" : "";
                  echo "<option value='{$g['id_guru']}' $selected>{$g['nama_guru']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Jurusan</label>
            <select name="id_jurusan" class="form-control" required>
              <option value="">-- Pilih Jurusan --</option>
              <?php
              $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
              while ($j = mysqli_fetch_assoc($jurusan)) {
                  $selected = ($j['id_jurusan'] == $row['id_jurusan']) ? "selected" : "";
                  echo "<option value='{$j['id_jurusan']}' $selected>{$j['nama_jurusan']}</option>";
              }
              ?>
            </select>
          </div>
          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>
            <a href="index.php?page=kelas" class="btn" 
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
