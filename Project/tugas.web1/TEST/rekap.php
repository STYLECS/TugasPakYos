<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rekap SPP</title>

  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <h1>SSRI-METAKSU</h1>

    <div class="header-center">
      <span id="greeting">HALLO, USER</span>
    </div>

    <div class="header-right">
      <span id="current-date"></span>
      <!-- kembali ke admin dashboard -->
      <a href="Admin/index.php">
        <img src="Logo SMKN 1.png" alt="Logo Sekolah" />
      </a>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="navbar" style="text-align:center; margin-top:10px;">
    <a href="hlmutama.php" style="margin-right:20px; color:#f0f0f0; text-decoration:none; font-weight:600;">Input Data</a>
    <a href="rekap.php" class="active" style="color:#f5c542; text-decoration:none; font-weight:600;">Rekap Pembayaran</a>
  </nav>

  <!-- Konten Rekap -->
  <main class="center-wrapper">
    <section class="SPP-con">
      <h2 style="color:#f5c542;">Rekap Pembayaran SPP</h2>

      <div class="table-container" style="margin-top:20px; overflow-x:auto;">
        <table id="rekap-table" style="width:100%; border-collapse:collapse; color:#fff;">
          <thead>
            <tr style="border-bottom:1px solid rgba(255,255,255,0.1); text-align:left;">
              <th style="padding:10px;">Jurusan</th>
              <th style="padding:10px;">Nama Siswa</th>
              <th style="padding:10px;">Bulan Bayar</th>
              <th style="padding:10px;">Nominal</th>
              <th style="padding:10px;">Waktu Pembayaran</th>
              <th style="padding:10px;">Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <button id="clear-data" class="btn-login" style="margin-top:25px;">Hapus Semua Data</button>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>© 2025 SSRI-METAKSU — Sistem Pembayaran SPP</p>
  </footer>

  <script src="rekap.js"></script>
</body>
</html>
