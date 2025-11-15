<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM pegawai WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['nama_pegawai'] = $data['nama_pegawai'];
    $_SESSION['login']  = true;

    echo "<script>
        alert('Login berhasil! Selamat datang, {$data['nama_pegawai']}');
        window.location.href='hlmutama.php';   
    </script>";
} else {
    echo "<script>
        alert('Username atau password salah');
        window.location.href='login.php';
    </script>";
}
?>
