<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $id_siswa       = $_POST['id_siswa'] ?? '';
    $tgl_pembayaran = $_POST['tgl_pembayaran'] ?? '';
    $bulan          = $_POST['bulan'] ?? '';
    $nominal        = $_POST['nominal'] ?? '';
    $metode         = $_POST['metode'] ?? '';
    $id_pegawai     = $_POST['id_pegawai'] ?? '';

    if ($id_siswa == '' || $tgl_pembayaran == '' || $bulan == '' || $nominal == '' || $metode == '' || $id_pegawai == '') {
        echo "<div class='alert alert-danger'>⚠ Semua field harus diisi!</div>";
    } else {
        $query = "INSERT INTO pembayaran (id_siswa, tgl_pembayaran, bulan, nominal, metode, id_pegawai) 
                  VALUES ('$id_siswa', '$tgl_pembayaran', '$bulan', '$nominal', '$metode', '$id_pegawai')";
        mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

        header("Location: index.php?page=spp&pesan=tambah");
        exit;
    }
}
?>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="page-title">➕ Tambah Pembayaran</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form">
                
                <div class="form-group">
                    <label class="form-label">Nama Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php
                        $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                        while ($s = mysqli_fetch_assoc($siswa)) {
                            echo "<option value='{$s['id_siswa']}'>{$s['nama_siswa']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Pembayaran</label>
                    <input type="date" name="tgl_pembayaran" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-control" required>
                        <option value="">-- Pilih Bulan --</option>
                        <?php
                        $bulanList = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                        foreach ($bulanList as $num => $nama) {
                            echo "<option value='$num'>$nama</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nominal</label>
                    <input type="number" name="nominal" class="form-control" required placeholder="Contoh: 150000">
                </div>

                <div class="form-group">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kartu">Kartu</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Pegawai</label>
                    <select name="id_pegawai" class="form-control" required>
                        <option value="">-- Pilih Pegawai --</option>
                        <?php
                        $pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC");
                        while ($p = mysqli_fetch_assoc($pegawai)) {
                            echo "<option value='{$p['id_pegawai']}'>{$p['nama_pegawai']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                    <a href="index.php?page=spp" class="btn btn-secondary">⬅ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
