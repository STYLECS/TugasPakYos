<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah MPK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_siswa  = $_POST['id_siswa'] ?? '';
    $id_kelas  = $_POST['id_kelas'] ?? '';
    $username  = $_POST['username'] ?? '';

    // Validasi input
    if ($id_siswa == '' || $id_kelas == '' || $username == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {
        // Buat password default otomatis (misalnya kosong)
        $hashed_password = password_hash('', PASSWORD_DEFAULT);

        // Query simpan data ke tabel mpk
        $query = "INSERT INTO mpk (id_siswa, id_kelas, username, password)
                  VALUES ('$id_siswa', '$id_kelas', '$username', '$hashed_password')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?page=mpk&pesan=tambah");
            exit;
        } else {
            echo "<div class='alert alert-danger'>❌ Gagal menyimpan: " . mysqli_error($koneksi) . "</div>";
        }
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah MPK</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form">

                <!-- Pilih siswa -->
                <div class="form-group">
                    <label class="form-label">Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih siswa --</option>
                        <?php
                        $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                        while ($g = mysqli_fetch_assoc($siswa)) {
                            echo "<option value='{$g['id_siswa']}'>{$g['nama_siswa']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Pilih kelas -->
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <select name="id_kelas" class="form-control" required>
                        <option value="">-- Pilih kelas --</option>
                        <?php
                        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                        while ($j = mysqli_fetch_assoc($kelas)) {
                            $namaKelas = htmlspecialchars($j['nama_kelas']);
                            $singkatan = isset($j['singkatan']) ? htmlspecialchars($j['singkatan']) : '';
                            echo "<option value='{$j['id_kelas']}'>{$namaKelas} ({$singkatan})</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username..." required>
                    <small class="form-text">Password akan otomatis dibuat oleh sistem.</small>
                </div>
                
                <!-- Tombol -->
                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=mpk" class="btn btn-secondary">⬅ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
