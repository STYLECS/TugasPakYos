<?php
include "koneksi.php";

// ===========================
//      HITUNG DATA
// ===========================
$guru     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM guru"));
$siswa    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa"));
$pegawai  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pegawai"));
$jurusan  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jurusan"));

// ===========================
//      AMBIL AKTIVITAS
// ===========================
$aktivitas = mysqli_query($koneksi, "SELECT * FROM aktivitas ORDER BY waktu DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <style>
        body {
            background: #1e293b;
            font-family: Arial, sans-serif;
        }
        .card {
            background: #151515;
            padding: 25px;
            border-radius: 12px;
            margin: 20px;
        }
        h2, p {
            color: white;
        }
        table tr td, table tr th {
            padding: 12px;
        }
        table tr:nth-child(even) {
            background: #f9fafb;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
        }
        .btn-clear {
            background: #ef4444;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .alert {
            background: #22c55e;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="card">

    <h2>Selamat Datang di Dashboard Admin</h2>
    <p>Gunakan menu di samping untuk mengelola data yang tersedia.</p>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert">
            <?php 
                if ($_GET['pesan'] == "hapus") echo "🗑️ Aktivitas berhasil dihapus!";
                if ($_GET['pesan'] == "clear") echo "🧹 Semua aktivitas berhasil dibersihkan!";
            ?>
        </div>
    <?php endif; ?>

    <!-- STATISTIK -->
    <div class="stats-grid" 
         style="margin-top:20px; display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:20px;">

        <div style="background:#f1f1f1; padding:20px; border-radius:12px;">
            <h3 style="font-size:16px; color:#000;">Data Guru</h3>
            <p style="font-size:24px; font-weight:600; color:#000;"><?= $guru['total'] ?></p>
        </div>

        <div style="background:#f1f1f1; padding:20px; border-radius:12px;">
            <h3 style="font-size:16px; color:#000;">Data Siswa</h3>
            <p style="font-size:24px; font-weight:600; color:#000;"><?= $siswa['total'] ?></p>
        </div>

        <div style="background:#f1f1f1; padding:20px; border-radius:12px;">
            <h3 style="font-size:16px; color:#000;">Data Pegawai</h3>
            <p style="font-size:24px; font-weight:600; color:#000;"><?= $pegawai['total'] ?></p>
        </div>

        <div style="background:#f1f1f1; padding:20px; border-radius:12px;">
            <h3 style="font-size:16px; color:#000;">Jurusan</h3>
            <p style="font-size:24px; font-weight:600; color:#000;"><?= $jurusan['total'] ?></p>
        </div>

    </div>

    <!-- AKTIVITAS TERBARU -->
    <div class="recent-activity" 
         style="margin-top:30px; background:#fff; padding:20px; border-radius:12px;">

        <h3 style="margin-bottom:15px; font-size:18px; color:#000;">Aktivitas Terbaru</h3>

        <table width="100%" cellpadding="10" style="border-collapse: collapse; color:#000;">
            <tr style="background:#f1f5f9;">
                <th>No</th>
                <th>Aktivitas</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>

            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($aktivitas)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['aktivitas'] ?></td>
                    <td><?= $row['waktu'] ?></td>
                    <td>
                        <a href="home_hapus.php?id=<?= $row['id'] ?>" 
                           class="btn-delete"
                           onclick="return confirm('Hapus aktivitas ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <!-- TOMBOL CLEAR SEMUA -->
        <a href="home_clear.php" 
           class="btn-clear"
           onclick="return confirm('Yakin ingin menghapus semua aktivitas?')">
           🧹 Clear Semua Aktivitas
        </a>

    </div>
</div>

</body>
</html>
