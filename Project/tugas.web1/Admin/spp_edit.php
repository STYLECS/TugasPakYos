<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $id_siswa       = $_POST['id_siswa'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bulan          = $_POST['bulan'];
    $nominal        = $_POST['nominal'];
    $metode         = $_POST['metode'];
    $id_pegawai     = $_POST['id_pegawai'];

    mysqli_query($koneksi, "UPDATE pembayaran 
        SET id_siswa='$id_siswa',
            tgl_pembayaran='$tgl_pembayaran',
            bulan='$bulan',
            nominal='$nominal',
            metode='$metode',
            id_pegawai='$id_pegawai'
        WHERE id_pembayaran='$id'");

    header("Location: index.php?page=spp&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pembayaran</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Pembayaran</h2>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label class="form-label">Nama Siswa</label>
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
            <label class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tgl_pembayaran" class="form-control" value="<?= $row['tgl_pembayaran'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-control" required>
              <option value="">-- Pilih Bulan --</option>
              <?php
              $bulanList = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
              ];
              foreach ($bulanList as $num => $nama) {
                  $selected = ($num == $row['bulan']) ? "selected" : "";
                  echo "<option value='$num' $selected>$nama</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Nominal</label>
            <input type="number" name="nominal" class="form-control" value="<?= $row['nominal'] ?>" required>
          </div>

          <div class="form-group">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-control" required>
              <option value="">-- Pilih Metode --</option>
              <?php
              $opsiMetode = ['Tunai', 'Kartu', 'E-Wallet', 'Transfer'];
              foreach ($opsiMetode as $metode) {
                  $selected = ($metode == $row['metode']) ? "selected" : "";
                  echo "<option value='$metode' $selected>$metode</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Pegawai</label>
            <select name="id_pegawai" class="form-control" required>
              <option value="">-- Pilih Pegawai --</option>
              <?php
              $pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC");
              while ($p = mysqli_fetch_assoc($pegawai)) {
                  $selected = ($p['id_pegawai'] == $row['id_pegawai']) ? "selected" : "";
                  echo "<option value='{$p['id_pegawai']}' $selected>{$p['nama_pegawai']}</option>";
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
            <a href="index.php?page=spp" class="btn" 
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
