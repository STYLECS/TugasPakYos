<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];

    $result = mysqli_query($koneksi, 
        "SELECT a.*, s.nama_siswa, k.nama_kelas, g.nama_guru
        FROM absensi a
        JOIN siswa s ON a.id_siswa = s.id_siswa
        JOIN kelas k ON s.id_kelas = k.id_kelas
        JOIN guru g ON k.id_guru = g.id_guru
        WHERE s.nama_siswa LIKE '%$cari%'
            OR k.nama_kelas LIKE '%$cari%'
            OR a.status LIKE '%$cari%'
        ORDER BY a.id_absensi DESC");
} else {
    $result = mysqli_query($koneksi, 
        "SELECT a.*, s.nama_siswa, k.nama_kelas, g.nama_guru
        FROM absensi a
        JOIN siswa s ON a.id_siswa = s.id_siswa
        JOIN kelas k ON s.id_kelas = k.id_kelas
        JOIN guru g ON k.id_guru = g.id_guru
        ORDER BY a.id_absensi DESC");
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="absensi_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah Absensi
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="absensi">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari absensi..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">

        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Absensi berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Absensi berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Absensi berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Status</th>
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

                            <!-- Kolom yang benar -->
                            <td><?= $row['tanggal_absensi'] ?></td>

                            <td><?= $row['nama_siswa'] ?></td>
                            <td><?= $row['nama_kelas'] ?></td>
                            <td><?= $row['nama_guru'] ?></td>

                            <td>
                                <?php
                                    if ($row['status'] == 'Hadir') echo "🟢 Hadir";
                                    else if ($row['status'] == 'Izin') echo "🟡 Izin";
                                    else if ($row['status'] == 'Sakit') echo "🔵 Sakit";
                                    else echo "🔴 Alpha";
                                ?>
                            </td>

                            <td>
                                <a href="absensi_edit.php?id=<?= $row['id_absensi'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="absensi_hapus.php?id=<?= $row['id_absensi'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus absensi?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">⚠️ Data absensi tidak ditemukan</td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
