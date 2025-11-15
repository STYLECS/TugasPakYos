<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_siswa'];
    $absen = $_POST['no_absen'];
    $id_kelas = $_POST['id_kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $nis = $_POST['nis'];

    mysqli_query($koneksi, "UPDATE siswa 
        SET nama_siswa='$nama',
            no_absen='$absen',
            id_kelas='$id_kelas',
            tgl_lahir='$tgl_lahir',
            alamat='$alamat',
            telepon='$telepon',
            nis='$nis'
        WHERE id_siswa='$id'");
        
    mysqli_query($koneksi,
    "INSERT INTO aktivitas (aktivitas, waktu)
     VALUES ('Admin memperbarui data siswa: $nama', NOW())");

    header("Location: index.php?page=siswa&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Siswa</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Siswa</h2>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="<?= $row['nama_siswa'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">No. Absen</label>
            <input type="number" name="no_absen" class="form-control" value="<?= $row['no_absen'] ?>" required>
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
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?= $row['tgl_lahir'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $row['alamat'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= $row['telepon'] ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" value="<?= $row['nis'] ?>" required>
          </div>
          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>
            <a href="index.php?page=siswa" class="btn" 
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
