<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_pembayaran='$id'");

header("Location: index.php?page=spp&pesan=hapus");
exit;
?>
