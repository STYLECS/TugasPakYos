<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, 
        "SELECT p.*, s.nama_siswa, pg.nama_pegawai
        FROM pembayaran p
        LEFT JOIN siswa s ON p.id_siswa = s.id_siswa
        LEFT JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
        WHERE s.nama_siswa LIKE '%$cari%'
        ORDER BY p.id_pembayaran DESC"
    );
} else {
    $result = mysqli_query($koneksi, 
        "SELECT p.*, s.nama_siswa, pg.nama_pegawai
        FROM pembayaran p
        LEFT JOIN siswa s ON p.id_siswa = s.id_siswa
        LEFT JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
        ORDER BY p.id_pembayaran DESC"
    );
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="spp_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah Pembayaran
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="pembayaran">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari siswa..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Data pembayaran berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data pembayaran berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data pembayaran berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1; 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_siswa'] ?: '-' ?></td>
                            <td><?= $row['tgl_pembayaran'] ?: '-' ?></td>
                            <td><?= $row['bulan'] ?: '-' ?></td>
                            <td><?= number_format($row['nominal'], 0, ',', '.') ?: '-' ?></td>
                            <td><?= $row['metode'] ?: '-' ?></td>
                            <td><?= $row['nama_pegawai'] ?: '-' ?></td>
                            <td>
                                <a href="spp_edit.php?id=<?= $row['id_pembayaran'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="spp_hapus.php?id=<?= $row['id_pembayaran'] ?>" 
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data pembayaran ini?')">
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">⚠️ Data pembayaran tidak ditemukan</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
