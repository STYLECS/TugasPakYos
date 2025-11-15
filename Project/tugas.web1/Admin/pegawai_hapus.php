<?php
include "koneksi.php";

$id = $_GET['id'];

// 1. Ambil nama pegawai dulu
$pegawai = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT nama_pegawai FROM pegawai WHERE id_pegawai='$id'"));

// 2. Hapus pegawai
mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai='$id'");

// 3. Catat aktivitas jika datanya ada
if ($pegawai) {
    $nama = $pegawai['nama_pegawai'];

    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menghapus pegawai: $nama', NOW())");
}

header("Location: index.php?page=pegawai&pesan=hapus");
exit;
?>
