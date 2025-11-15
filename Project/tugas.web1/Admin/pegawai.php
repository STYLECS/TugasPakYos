<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai 
                                      WHERE nama_pegawai LIKE '%$cari%'
                                      ORDER BY id_pegawai DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY id_pegawai DESC");
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="pegawai_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah pegawai
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="pegawai">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari pegawai..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Data pegawai berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data pegawai berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data pegawai berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama pegawai</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Username</th>
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
                            <td><?= $row['nama_pegawai'] ?></td>
                            <td><?= $row['tgl_lahir'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['tlp'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <a href="pegawai_edit.php?id=<?= $row['id_pegawai'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="pegawai_hapus.php?id=<?= $row['id_pegawai'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
