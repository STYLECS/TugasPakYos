<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $id_siswa  = $_POST['id_siswa'] ?? '';
    $tgl       = $_POST['tgl_absen'] ?? ''; // ✔ sesuai name di input
    $status    = $_POST['status'] ?? '';

    if ($id_siswa == '' || $tgl == '' || $status == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {

        // ✔ simpan absensi (kolom benar: tanggal_absensi)
        mysqli_query($koneksi,
            "INSERT INTO absensi (id_siswa, tanggal_absensi, status)
             VALUES ('$id_siswa', '$tgl', '$status')");

        // ambil nama siswa untuk aktivitas
        $s = mysqli_fetch_assoc(mysqli_query($koneksi, 
            "SELECT nama_siswa FROM siswa WHERE id_siswa='$id_siswa'"));

        $nama_siswa = $s['nama_siswa'];

        // simpan aktivitas
        mysqli_query($koneksi,
            "INSERT INTO aktivitas (aktivitas, waktu)
             VALUES ('Admin menambahkan absensi siswa: $nama_siswa', NOW())");

        header("Location: index.php?page=absensi&pesan=tambah");
        exit;
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Absensi</h2>
        </div>

        <div class="card-body">
            <form method="post" class="form">

                <!-- Pilih Siswa -->
                <div class="form-group">
                    <label class="form-label">Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php
                        $siswa = mysqli_query($koneksi,
                        "SELECT s.*, k.nama_kelas 
                         FROM siswa s 
                         JOIN kelas k ON s.id_kelas = k.id_kelas
                         ORDER BY s.nama_siswa ASC");

                        while ($s = mysqli_fetch_assoc($siswa)) {
                            echo "<option value='{$s['id_siswa']}'>
                                    {$s['nama_siswa']} - {$s['nama_kelas']}
                                  </option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="form-group">
                    <label class="form-label">Tanggal Absen</label>
                    <input type="date" name="tgl_absen" class="form-control" required>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=absensi" class="btn btn-secondary">⬅ Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
