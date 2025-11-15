<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM aktivitas WHERE id='$id'");

header("Location: index.php?page=home&pesan=hapus");
exit;
?>
