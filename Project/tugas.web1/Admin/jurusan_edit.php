<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id_jurusan='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_jurusan'];
    $singkatan = $_POST['singkatan'];

    mysqli_query($koneksi, "UPDATE jurusan 
                            SET nama_jurusan='$nama',
                                singkatan='$singkatan'
                            WHERE id_jurusan='$id'");

  // Aktivitas
  mysqli_query($koneksi,
      "INSERT INTO aktivitas (aktivitas, waktu)
       VALUES ('Admin memperbarui data jurusan: $nama', NOW())"
  );

    header("Location: index.php?page=jurusan&pesan=edit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jurusan | Admin Panel</title>
  <link rel="stylesheet" href="style.css?v2">
</head>
<body>
  <!-- ================= MAIN CONTENT ================= -->
  <main class="main-content">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
      <div class="card-header">
        <h2 class="card-title">Form Edit Jurusan</h2>
      </div>

      <div class="card-body">
        <form method="post">
          
          <!-- Nama Jurusan -->
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" style="color: #FFD700; font-weight:600;">Nama Jurusan</label>
            <input type="text" name="nama_jurusan" class="form-control" 
                   value="<?= htmlspecialchars($row['nama_jurusan']) ?>" required
                   style="width:100%; padding:10px; border-radius:6px; border:1px solid #333; background:#111; color:#f5f5f5;">
          </div>

          <!-- Singkatan -->
          <div class="form-group" style="margin-bottom: 25px;">
            <label class="form-label" style="color: #FFD700; font-weight:600;">Singkatan</label>
            <input type="text" name="singkatan" class="form-control"
                   value="<?= htmlspecialchars($row['singkatan']) ?>" required
                   style="width:100%; padding:10px; border-radius:6px; border:1px solid #333; background:#111; color:#f5f5f5;">
          </div>

          <!-- Tombol Aksi -->
          <div style="display:flex; gap:10px;">
            <button type="submit" name="update" class="btn" 
                    style="background:linear-gradient(90deg,#FFD700,#ffb700); color:#000; font-weight:700;">
              💾 Update
            </button>
            <a href="index.php?page=jurusan" class="btn" 
               style="background:#222; color:#FFD700; border:1px solid #FFD700;">
              ⬅️ Kembali
            </a>
          </div>

        </form>
      </div>
    </div>
  </main>

</body>
</html>
