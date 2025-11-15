<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurnal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {

    $id_guru      = $_POST['id_guru'] ?? '';
    $id_kelas     = $_POST['id_kelas'] ?? '';
    $tgl_mengajar = $_POST['tgl_mengajar'] ?? '';
    $materi       = $_POST['materi'] ?? '';
    $keterangan   = $_POST['keterangan'] ?? '';

    // Validasi isi form
    if ($id_guru == '' || $id_kelas == '' || $tgl_mengajar == '' || $materi == '' || $keterangan == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {

        // Insert jurnal
        $query = "INSERT INTO jurnal (id_guru, id_kelas, tgl_mengajar, materi, keterangan)
                  VALUES ('$id_guru', '$id_kelas', '$tgl_mengajar', '$materi', '$keterangan')";
        mysqli_query($koneksi, $query);

        // Catat aktivitas
        mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
         VALUES ('Admin menambahkan jurnal baru', NOW())");

        // Redirect
        header("Location: index.php?page=jurnal&pesan=tambah");
        exit;
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Jurnal</h2>
        </div>

        <div class="card-body">
            <form method="post" class="form">

                <!-- Pilih Guru -->
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

                <!-- Pilih Kelas -->
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

                <!-- Tanggal Mengajar -->
                <div class="form-group">
                    <label class="form-label">Tanggal Mengajar</label>
                    <input type="date" name="tgl_mengajar" class="form-control" required>
                </div>

                <!-- Materi -->
                <div class="form-group">
                    <label class="form-label">Materi</label>
                    <input type="text" name="materi" class="form-control" placeholder="Masukkan materi..." required>
                </div>

                <!-- Keterangan -->
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan..." required></textarea>
                </div>

                <!-- Tombol -->
                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=jurnal" class="btn btn-secondary">⬅ Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
