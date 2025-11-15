<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {

    $nama       = $_POST['nama_pegawai'];
    $tlp        = $_POST['tlp'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // INSERT PEGAWAI
    $query = "INSERT INTO pegawai (nama_pegawai, tlp, tgl_lahir, alamat, username, password) 
              VALUES ('$nama', '$tlp', '$tgl_lahir', '$alamat', '$username', '$password_hashed')";

    if (mysqli_query($koneksi, $query)) {

        // CATAT AKTIVITAS — ditempatkan sebelum header agar tidak ter-skip
        mysqli_query($koneksi,
            "INSERT INTO aktivitas (aktivitas, waktu)
             VALUES ('Admin menambahkan pegawai baru: $nama', NOW())");

        header("Location: index.php?page=pegawai&pesan=tambah");
        exit;

    } else {
        echo "<div style='color:red; text-align:center;'>Error: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Pegawai</h2>
        </div>

        <div class="card-body">
            <form method="post" class="form">

                <div class="form-group">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="tlp" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <!-- INPUT PASSWORD YANG SEBELUMNYA KURANG -->
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=pegawai" class="btn btn-secondary">⬅ Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
