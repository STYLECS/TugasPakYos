<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id'");

header("Location: index.php?page=kelas&pesan=hapus");
exit;
?>
