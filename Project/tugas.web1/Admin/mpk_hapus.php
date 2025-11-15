<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM mpk WHERE id_mpk='$id'");

header("Location: index.php?page=mpk&pesan=hapus");
exit;
?>
