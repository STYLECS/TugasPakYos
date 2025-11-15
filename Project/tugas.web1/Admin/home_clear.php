<?php
include "koneksi.php";

mysqli_query($koneksi, "TRUNCATE aktivitas");

header("Location: index.php?page=home&pesan=clear");
exit;
?>
