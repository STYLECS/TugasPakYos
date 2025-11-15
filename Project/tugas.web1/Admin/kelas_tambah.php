<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama_kelas'] ?? '';
    $id_guru    = $_POST['id_guru'] ?? '';
    $id_jurusan = $_POST['id_jurusan'] ?? '';

    if ($nama == '' || $id_guru == '' || $id_jurusan == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {
        mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, id_guru, id_jurusan) 
                                VALUES ('$nama', '$id_guru', '$id_jurusan')");
        header("Location: index.php?page=kelas&pesan=tambah");
        exit;
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Kelas</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form">
                <!-- Nama Kelas -->
                <div class="form-group">
                    <label class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" placeholder="Masukkan nama kelas..." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Guru</label>
                    <select name="id_guru" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php
                        $guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
                        while ($g = mysqli_fetch_assoc($guru)) {
                            echo "<option value='{$g['id_guru']}'>{$g['nama_guru']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jurusan</label>
                    <select name="id_jurusan" class="form-control" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <?php
                        $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
                        while ($j = mysqli_fetch_assoc($jurusan)) {
                            echo "<option value='{$j['id_jurusan']}'>{$j['nama_jurusan']} ({$j['singkatan']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=kelas" class="btn btn-secondary">⬅ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
