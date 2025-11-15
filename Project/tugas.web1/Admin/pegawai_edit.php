<?php
include "koneksi.php";

$id = $_GET['id'];

// Ambil data pegawai
$data = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
  $nama       = $_POST['nama_pegawai'];
  $tlp        = $_POST['tlp'];
  $tgl_lahir  = $_POST['tgl_lahir'];
  $alamat     = $_POST['alamat'];
  $username   = $_POST['username'];

  // UPDATE pegawai
  mysqli_query($koneksi,
      "UPDATE pegawai 
       SET nama_pegawai='$nama',
           tlp='$tlp',
           tgl_lahir='$tgl_lahir',
           alamat='$alamat',
           username='$username'
       WHERE id_pegawai='$id'"
  );

  // Aktivitas
  mysqli_query($koneksi,
      "INSERT INTO aktivitas (aktivitas, waktu)
       VALUES ('Admin memperbarui data pegawai: $nama', NOW())"
  );

  header("Location: index.php?page=pegawai&pesan=edit");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pegawai</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Pegawai</h2>
      </div>

      <div class="card-body">
        <form method="post">

          <div class="form-group">
            <label class="form-label">Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" 
                   value="<?= $row['nama_pegawai'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="tlp" class="form-control" 
                   value="<?= $row['tlp'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" 
                   value="<?= $row['tgl_lahir'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" 
                   value="<?= $row['alamat'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" 
                   value="<?= $row['username'] ?>" required>
          </div>

          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn"
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>

            <!-- PERBAIKAN: kembali ke halaman PEGAWAI -->
            <a href="index.php?page=pegawai" class="btn"
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
