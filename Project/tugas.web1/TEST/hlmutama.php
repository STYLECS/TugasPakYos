<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran SPP</title>
  <link rel="stylesheet" href="styles.css">
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

  <!-- 🔹 NAVBAR -->
  <nav class="navbar" style="text-align:center; margin-top:10px;">
    <a href="hlmutama.php" class="active" style="margin-right:20px; color:#f5c542; text-decoration:none; font-weight:600;">Input Data</a>
    <a href="rekap.php" style="color:#f0f0f0; text-decoration:none; font-weight:600;">Rekap Pembayaran</a>
  </nav>

  <!-- Main Form -->
  <main class="main-content">
    <section class="form-section">

      <!-- Kelas -->
      <div class="card form-box">
        <h3>Kelas</h3>
        <div class="dropdown">
          <button class="dropbtn" id="kelas-dropdown">Pilih Kelas</button>
          <div class="dropdown-content" id="kelas-content">
            <a href="#">X (10)</a>
            <a href="#">XI (11)</a>
            <a href="#">XII (12)</a>
            <hr>
            <div class="dropdown-actions"><a href="#" class="reset">Batal</a></div>
          </div>
        </div>
      </div>

      <!-- Jurusan -->
      <div class="card form-box">
        <h3>Jurusan</h3>
        <div class="dropdown">
          <button class="dropbtn" id="jurusan-btn">Pilih Jurusan</button>
          <div class="dropdown-content" id="jurusan-content"></div>
        </div>
      </div>

      <!-- Nama Siswa -->
      <div class="card form-box">
        <h3>Nama Siswa</h3>
        <div class="dropdown">
          <button class="dropbtn" id="siswa-btn">Pilih Siswa</button>
          <div class="dropdown-content"></div>
        </div>
      </div>

      <!-- Bulan Bayar -->
      <div class="card form-box">
        <h3>Bulan Bayar</h3>
        <div class="dropdown">
          <button class="dropbtn" id="bulan-btn">Pilih Bulan</button>
          <div class="dropdown-content" id="bulan-bayar">
            <label><input type="checkbox" value="Januari"> Januari</label>
            <label><input type="checkbox" value="Februari"> Februari</label>
            <label><input type="checkbox" value="Maret"> Maret</label>
            <label><input type="checkbox" value="April"> April</label>
            <label><input type="checkbox" value="Mei"> Mei</label>
            <label><input type="checkbox" value="Juni"> Juni</label>
            <label><input type="checkbox" value="Juli"> Juli</label>
            <label><input type="checkbox" value="Agustus"> Agustus</label>
            <label><input type="checkbox" value="September"> September</label>
            <label><input type="checkbox" value="Oktober"> Oktober</label>
            <label><input type="checkbox" value="November"> November</label>
            <label><input type="checkbox" value="Desember"> Desember</label>
            <hr>
            <div class="dropdown-actions">
              <a href="#" class="reset">Batal</a>
              <a href="#" class="ok">OK</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Nominal -->
      <div class="card form-box">
        <h3>Nominal</h3>
        <div class="dropdown">
          <button class="dropbtn" id="nominal-btn">Rp 0</button>
          <div class="dropdown-content"></div>
        </div>
      </div>

      <!-- Submit -->
      <div class="card tombol-submit">
        <button id="submit-btn" type="submit" class="btn-login">Submit</button>
      </div>

    </section>
  </main> 

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 SSRI-METAKSU — Sistem Pembayaran SPP</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
