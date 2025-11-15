<?php
include "koneksi.php";

$id = $_GET['id'];

// 1. Ambil nama jurusan dulu
$jurusan = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT nama_jurusan FROM jurusan WHERE id_jurusan='$id'"));

// 2. Hapus jurusan
mysqli_query($koneksi, "DELETE FROM jurusan WHERE id_jurusan='$id'");

// 3. Jika data jurusan ada, catat aktivitas
if ($jurusan) {
    $nama = $jurusan['nama_jurusan'];

    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menghapus jurusan: $nama', NOW())");
}

header("Location: index.php?page=jurusan&pesan=hapus");
exit;
?>
