<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurusan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama      = $_POST['nama_jurusan'];
    $singkatan = $_POST['singkatan'];

    // INSERT jurusan
    mysqli_query($koneksi, 
        "INSERT INTO jurusan (nama_jurusan, singkatan) 
         VALUES ('$nama','$singkatan')");

    // INSERT aktivitas
    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menambahkan jurusan baru: $nama', NOW())");

    header("Location: index.php?page=jurusan&pesan=tambah");
    exit;
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Jurusan</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form">

                <div class="form-group">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" 
                           class="form-control" 
                           placeholder="Masukkan nama jurusan..." 
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Singkatan</label>
                    <input type="text" name="singkatan" 
                           class="form-control" 
                           placeholder="Masukkan singkatan..." 
                           required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=jurusan" class="btn btn-secondary">⬅ Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
