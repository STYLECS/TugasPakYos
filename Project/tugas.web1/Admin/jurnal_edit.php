<?php
include "koneksi.php";

$id = $_GET['id'];

// Ambil jurnal berdasarkan ID
$data = mysqli_query($koneksi, 
    "SELECT * FROM jurnal WHERE id_jurnal='$id'"
);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $id_guru      = $_POST['id_guru'];
    $id_kelas     = $_POST['id_kelas'];
    $tgl_mengajar = $_POST['tgl_mengajar'];
    $materi       = $_POST['materi'];
    $keterangan   = $_POST['keterangan'];

    // UPDATE data jurnal
    mysqli_query($koneksi, 
        "UPDATE jurnal 
         SET id_guru='$id_guru',
             id_kelas='$id_kelas',
             tgl_mengajar='$tgl_mengajar',
             materi='$materi',
             keterangan='$keterangan'
         WHERE id_jurnal='$id'"
    );

    // Catat aktivitas
    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin memperbarui jurnal ID: $id', NOW())"
    );

    header("Location: index.php?page=jurnal&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jurnal</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>

  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Jurnal</h2>
      </div>

      <div class="card-body">
        <form method="post">

          <!-- Guru -->
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

          <!-- Kelas -->
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

          <!-- Tanggal Mengajar -->
          <div class="form-group">
            <label class="form-label">Tanggal Mengajar</label>
            <input type="date" name="tgl_mengajar" class="form-control"
                   value="<?= $row['tgl_mengajar'] ?>" required>
          </div>

          <!-- Materi -->
          <div class="form-group">
            <label class="form-label">Materi</label>
            <input type="text" name="materi" class="form-control"
                   value="<?= $row['materi'] ?>" required>
          </div>

          <!-- Keterangan -->
          <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" required><?= $row['keterangan'] ?></textarea>
          </div>

          <!-- Tombol -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>

            <a href="index.php?page=jurnal" class="btn"
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
