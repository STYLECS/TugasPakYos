<?php
include "koneksi.php";

$id = $_GET['id'];

// 1. Ambil nama siswa dulu sebelum dihapus
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT nama_siswa FROM siswa WHERE id_siswa='$id'"));

// 2. Hapus siswa
mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id'");

// 3. Tambahkan aktivitas (gunakan nama yang sudah disimpan)
if ($siswa) {
    $nama = $siswa['nama_siswa'];

    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menghapus siswa: $nama', NOW())");
}

header("Location: index.php?page=siswa&pesan=hapus");
exit;
?>
