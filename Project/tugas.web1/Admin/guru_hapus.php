<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");

$guru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_guru FROM guru WHERE id_guru='$id'"));

mysqli_query($koneksi,
    "INSERT INTO aktivitas (aktivitas, waktu)
     VALUES ('Admin menghapus guru: {$guru['nama_guru']}', NOW())");


header("Location: index.php?page=guru&pesan=hapus");
exit;
?>
