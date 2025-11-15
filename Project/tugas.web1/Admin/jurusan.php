<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM jurusan 
                                      WHERE nama_jurusan LIKE '%$cari%'
                                      ORDER BY id_jurusan DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="jurusan_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah Jurusan
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="jurusan">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari jurusan..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Data jurusan berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data jurusan berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data jurusan berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Singkatan</th>
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
                            <td><?= isset($row['nama_jurusan']) ? $row['nama_jurusan'] : '-' ?></td>
                            <td><?= isset($row['singkatan']) ? $row['singkatan'] : '-' ?></td>
                            <td>
                                <a href="jurusan_edit.php?id=<?= $row['id_jurusan'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="jurusan_hapus.php?id=<?= $row['id_jurusan'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus jurusan ini?')">
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
