<?php
include "koneksi.php";

$id = $_GET['id'];

// ambil data absensi + relasi lengkap
$data = mysqli_query($koneksi, 
    "SELECT a.*, s.nama_siswa, s.id_kelas, 
            k.nama_kelas, g.nama_guru
     FROM absensi a
     JOIN siswa s ON a.id_siswa = s.id_siswa
     JOIN kelas k ON s.id_kelas = k.id_kelas
     JOIN guru g ON k.id_guru = g.id_guru
     WHERE a.id_absensi='$id'"
);

$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $id_siswa  = $_POST['id_siswa'];
    $tgl       = $_POST['tgl_absen'];   // dari input
    $status    = $_POST['status'];

    // UPDATE absensi (✔ kolom benar: tanggal_absensi)
    mysqli_query($koneksi,
        "UPDATE absensi SET 
            id_siswa='$id_siswa',
            tanggal_absensi='$tgl',
            status='$status'
        WHERE id_absensi='$id'"
    );

    // aktivitas
    $s = mysqli_fetch_assoc(mysqli_query($koneksi, 
        "SELECT nama_siswa FROM siswa WHERE id_siswa='$id_siswa'"));

    $nama = $s['nama_siswa'];

    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin mengedit absensi siswa: $nama', NOW())");

    header("Location: index.php?page=absensi&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Absensi</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>

  <div class="main-content">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">✏️ Edit Absensi</h2>
      </div>

      <div class="card-body">
        <form method="post">

          <!-- PILIH SISWA -->
          <div class="form-group">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-control" required>
              <option value="">-- Pilih Siswa --</option>

              <?php
              $siswa = mysqli_query($koneksi,
                  "SELECT s.*, k.nama_kelas 
                   FROM siswa s 
                   JOIN kelas k ON s.id_kelas = k.id_kelas
                   ORDER BY s.nama_siswa ASC");
              
              while ($s = mysqli_fetch_assoc($siswa)) {
                  $selected = ($s['id_siswa'] == $row['id_siswa']) ? "selected" : "";
                  echo "<option value='{$s['id_siswa']}' $selected>
                          {$s['nama_siswa']} - {$s['nama_kelas']}
                        </option>";
              }
              ?>
            </select>
          </div>

          <!-- TANGGAL -->
          <div class="form-group">
            <label class="form-label">Tanggal Absen</label>
            <input type="date" name="tgl_absen" class="form-control" value="<?= $row['tanggal_absensi'] ?>" required>
          </div>

          <!-- STATUS -->
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Hadir" <?= ($row['status'] == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
              <option value="Izin" <?= ($row['status'] == 'Izin') ? 'selected' : '' ?>>Izin</option>
              <option value="Sakit" <?= ($row['status'] == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
              <option value="Alpha" <?= ($row['status'] == 'Alpha') ? 'selected' : '' ?>>Alpha</option>
            </select>
          </div>

          <!-- INFO KELAS -->
          <div class="form-group">
            <label class="form-label">Kelas</label>
            <input type="text" class="form-control" value="<?= $row['nama_kelas'] ?>" readonly>
          </div>

          <!-- INFO GURU -->
          <div class="form-group">
            <label class="form-label">Guru Pengajar</label>
            <input type="text" class="form-control" value="<?= $row['nama_guru'] ?>" readonly>
          </div>

          <!-- Tombol -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>

            <a href="index.php?page=absensi" class="btn" 
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
