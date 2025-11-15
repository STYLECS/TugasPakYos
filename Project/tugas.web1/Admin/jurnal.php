<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];

    $result = mysqli_query($koneksi, 
        "SELECT j.*, g.nama_guru, k.nama_kelas
         FROM jurnal j
         LEFT JOIN guru g ON j.id_guru = g.id_guru
         LEFT JOIN kelas k ON j.id_kelas = k.id_kelas
         WHERE g.nama_guru LIKE '%$cari%' 
            OR k.nama_kelas LIKE '%$cari%' 
            OR j.materi LIKE '%$cari%'
         ORDER BY j.id_jurnal DESC"
    );

} else {
    $result = mysqli_query($koneksi, 
        "SELECT j.*, g.nama_guru, k.nama_kelas
         FROM jurnal j
         LEFT JOIN guru g ON j.id_guru = g.id_guru
         LEFT JOIN kelas k ON j.id_kelas = k.id_kelas
         ORDER BY j.id_jurnal DESC"
    );
}
?>

<div class="card">
    <div class="card-header">
        <div class="page-actions">
            <a href="jurnal_tambah.php" class="btn">
                <i class="fas fa-plus"></i> Tambah Jurnal
            </a>

            <form method="get" action="">
                <input type="hidden" name="page" value="jurnal">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="search" name="cari" placeholder="Cari jurnal ..." 
                           value="<?= htmlspecialchars($cari) ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success">
                <?php 
                if ($_GET['pesan'] == 'tambah') echo "✅ Jurnal berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Jurnal berhasil diperbarui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Jurnal berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <!-- TABEL -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guru</th>
                        <th>Kelas</th>
                        <th>Tanggal Mengajar</th>
                        <th>Materi</th>
                        <th>Keterangan</th>
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
                            <td><?= $row['nama_guru'] ?></td>
                            <td><?= $row['nama_kelas'] ?></td>
                            <td><?= $row['tgl_mengajar'] ?></td>
                            <td><?= $row['materi'] ?></td>
                            <td><?= $row['keterangan'] ?></td>

                            <td>
                                <a href="jurnal_edit.php?id=<?= $row['id_jurnal'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="jurnal_hapus.php?id=<?= $row['id_jurnal'] ?>" 
                                   onclick="return confirm('Hapus jurnal ini?')" 
                                   class="btn btn-sm btn-danger">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">⚠️ Data jurnal tidak ditemukan</td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
