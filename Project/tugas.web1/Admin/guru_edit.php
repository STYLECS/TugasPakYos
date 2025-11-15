<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_guru'];
    $telp = $_POST['telp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];

    mysqli_query($koneksi, "UPDATE guru 
        SET nama_guru='$nama',
            telp='$telp',
            tgl_lahir='$tgl_lahir',
            alamat='$alamat',
            username='$username'
        WHERE id_guru='$id'");
        
    mysqli_query($koneksi,
    "INSERT INTO aktivitas (aktivitas, waktu)
     VALUES ('Admin memperbarui data guru: $nama_guru', NOW())");

    header("Location: index.php?page=guru&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Guru</title>
  <link rel="stylesheet" href="style.css?v4">
</head>
<body>
  <div class="main-content">
    <div class="card form-card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Guru</h2>
      </div>
      <div class="card-body">
        <form method="post" class="form-style">
          <div class="form-group">
            <label class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" value="<?= $row['nama_guru'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" value="<?= $row['telp'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="<?= $row['tgl_lahir'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" value="<?= $row['alamat'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="<?= $row['username'] ?>" required>
          </div>
          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>
            <a href="index.php?page=guru" class="btn" 
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
