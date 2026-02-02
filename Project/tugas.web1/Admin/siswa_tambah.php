<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama_siswa'] ?? '';
    $absen      = $_POST['no_absen'] ?? '';
    $id_kelas   = $_POST['id_kelas'] ?? '';
    $tgl_lahir  = $_POST['tgl_lahir'] ?? '';
    $alamat     = $_POST['alamat'] ?? '';
    $telepon    = $_POST['telepon'] ?? '';
    $nis        = $_POST['nis'] ?? '';

    if ($nama == '' || $absen == '' || $id_kelas == '' || $tgl_lahir == '' || $alamat == '' || $telepon == '' || $nis == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {
        $query = "INSERT INTO siswa (nama_siswa, no_absen, id_kelas, tgl_lahir, alamat, telepon, nis) 
                  VALUES ('$nama', '$absen', '$id_kelas', '$tgl_lahir', '$alamat', '$telepon', '$nis')";
        mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

        mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
        VALUES ('Admin menambahkan siswa baru: $nama', NOW())");

        header("Location: index.php?page=siswa&pesan=tambah");
        exit;
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Siswa</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form">
                <div class="form-group">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Absen</label>
                    <input type="text" name="no_absen" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <select name="id_kelas" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php
                        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                        while ($k = mysqli_fetch_assoc($kelas)) {
                            echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=siswa" class="btn btn-secondary">⬅ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
