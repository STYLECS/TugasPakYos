<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];

    // Cari berdasarkan nama siswa ATAU nama kelas
    $query = "
        SELECT mpk.*, siswa.nama_siswa, kelas.nama_kelas 
        FROM mpk
        JOIN siswa ON mpk.id_siswa = siswa.id_siswa
        JOIN kelas ON mpk.id_kelas = kelas.id_kelas
        WHERE siswa.nama_siswa LIKE '%$cari%'
           OR kelas.nama_kelas LIKE '%$cari%'
        ORDER BY id_mpk DESC
    ";
} else {
    $query = "
        SELECT mpk.*, siswa.nama_siswa, kelas.nama_kelas 
        FROM mpk
        JOIN siswa ON mpk.id_siswa = siswa.id_siswa
        JOIN kelas ON mpk.id_kelas = kelas.id_kelas
        ORDER BY id_mpk DESC
    ";
}

$result = mysqli_query($koneksi, $query);
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="mpk_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah MPK
            </a>
            <form method="get" action="">
                <input type="hidden" name="page" value="mpk">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari siswa atau kelas..." value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Data MPK berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data MPK berhasil diperbarui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data MPK berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>  
                        <th>Kelas</th>
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
                            <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                            <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td>
                                <a href="mpk_edit.php?id=<?= $row['id_mpk'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="mpk_hapus.php?id=<?= $row['id_mpk'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus MPK ini?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
