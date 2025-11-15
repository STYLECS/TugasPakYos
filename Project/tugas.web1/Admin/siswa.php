    <?php
    include "koneksi.php";

    $cari = "";
    if (isset($_GET['cari']) && $_GET['cari'] != "") {
        $cari = $_GET['cari'];
        $result = mysqli_query($koneksi, 
            "SELECT s.*, k.nama_kelas
            FROM siswa s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE s.nama_siswa LIKE '%$cari%'
            ORDER BY s.id_siswa DESC"
        );
    } else {
        $result = mysqli_query($koneksi, 
            "SELECT s.*, k.nama_kelas
            FROM siswa s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            ORDER BY s.id_siswa DESC"
        );
    }
    ?>

    <div class="card">
        <div class="card-header">
            <div class="page-actions">
                <a href="siswa_tambah.php" class="btn">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>
                <form method="get" action="">
                    <input type="hidden" name="page" value="siswa">
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
                    if ($_GET['pesan'] == 'tambah') echo "✅ Data siswa berhasil ditambahkan!";
                    if ($_GET['pesan'] == 'edit') echo "✅ Data siswa berhasil diperbaharui!";
                    if ($_GET['pesan'] == 'hapus') echo "✅ Data siswa berhasil dihapus!";
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
                            <th>Absen</th>
                            <th>Kelas</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>NIS</th>
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
                                <td><?= $row['no_absen'] ?: '-' ?></td>
                                <td><?= $row['nama_kelas'] ?: '-' ?></td>
                                <td><?= $row['tgl_lahir'] ?: '-' ?></td>
                                <td><?= $row['alamat'] ?: '-' ?></td>
                                <td><?= $row['telepon'] ?: '-' ?></td>
                                <td><?= $row['nis'] ?: '-' ?></td>
                                <td>
                                    <a href="siswa_edit.php?id=<?= $row['id_siswa'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="siswa_hapus.php?id=<?= $row['id_siswa'] ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus siswa ini?')">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
