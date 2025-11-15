<?php
include "koneksi.php";

$id = $_GET['id'];

// 1. Ambil data jurnal sebelum dihapus
$jurnal = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT materi FROM jurnal WHERE id_jurnal='$id'"));

// 2. Hapus jurnal
mysqli_query($koneksi, "DELETE FROM jurnal WHERE id_jurnal='$id'");

// 3. Catat aktivitas
if ($jurnal) {
    $materi = $jurnal['materi'];

    mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menghapus jurnal: $materi', NOW())");
}

header("Location: index.php?page=jurnal&pesan=hapus");
exit;
?>
