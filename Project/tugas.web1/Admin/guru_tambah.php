    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah guru</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <?php
    include "koneksi.php";

   if (isset($_POST['simpan'])) {
       $nama = $_POST['nama_guru'];
       $telp = $_POST['telp'];
       $tgl_lahir = $_POST['tgl_lahir'];
       $alamat = $_POST['alamat'];
       $username = $_POST['username'];
       $password = $_POST['password'];

       $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($koneksi, "INSERT INTO guru (nama_guru, telp, tgl_lahir, alamat, username, password) 
        VALUES ('$nama', '$telp', '$tgl_lahir', '$alamat', '$username', '$password_hashed')");

        mysqli_query($koneksi,
        "INSERT INTO aktivitas (aktivitas, waktu)
        VALUES ('Admin menambahkan guru baru: $nama', NOW())");

       
       header("Location: index.php?page=guru&pesan=tambah");
       exit;
   }
   
    ?>

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h2 class="page-title">➕ Tambah Guru</h2>
            </div>
            <div class="card-body">
                <form method="post" class="form">
                    <div class="form-group">
                        <label class="form-label">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" placeholder="Masukkan nama guru..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telephone</label>
                        <input type="text" name="telp" class="form-control" placeholder="Masukkan nomor telp..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal_lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukkan tanggal_lahir..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username..." required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
                        <a href="index.php?page=guru" class="btn btn-secondary">⬅ Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>
