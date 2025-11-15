<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT kelas.*, jurusan.nama_jurusan, guru.nama_guru 
                                     FROM kelas
                                     JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
                                     JOIN guru ON kelas.id_guru = guru.id_guru
                                     WHERE kelas.nama_kelas LIKE '%$cari%'
                                     ORDER BY id_kelas DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT kelas.*, jurusan.nama_jurusan, guru.nama_guru FROM kelas JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan JOIN guru ON kelas.id_guru = guru.id_guru ORDER BY id_kelas DESC");
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="kelas_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah Kelas
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="kelas">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari Kelas..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Data Kelas berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data Kelas berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data Kelas berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama kelas</th>
                        <th>Jurusan</th>
                        <th>Guru</th>
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
                            <td><?= isset($row['nama_kelas']) ? $row['nama_kelas'] : '-' ?></td>
                            <td><?= isset($row['nama_jurusan']) ? $row['nama_jurusan'] : '-' ?></td>
                            <td><?= isset($row['nama_guru']) ? $row['nama_guru'] : '-' ?></td>

                            <td>
                                <a href="kelas_edit.php?id=<?= $row['id_kelas'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="kelas_hapus.php?id=<?= $row['id_kelas'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus Kelas ini?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
