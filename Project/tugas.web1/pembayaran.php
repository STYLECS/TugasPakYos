<?php
// ==========================
// SISTEM PEMBAYARAN SPP - SMK NEGERI 1 SUKAWATI
// ==========================
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("Admin/koneksi.php");

$siswa_list = mysqli_query($koneksi, "SELECT id_siswa, nama_siswa, nis FROM siswa ORDER BY nama_siswa ASC");

function getBulanTerbayar($koneksi, $id_siswa) {
    $bulan_terbayar = [];
    $query = mysqli_query($koneksi, "SELECT DISTINCT bulan FROM pembayaran WHERE id_siswa = '$id_siswa' ORDER BY bulan ASC");
    while ($row = mysqli_fetch_assoc($query)) {
        $bulan_terbayar[] = $row['bulan'];
    }
    return $bulan_terbayar;
}

$siswa_terpilih = isset($_GET['siswa']) ? $_GET['siswa'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $bulan_array = isset($_POST['bulan']) ? $_POST['bulan'] : [];
    $metode = mysqli_real_escape_string($koneksi, $_POST['metode']);
    $id_pegawai = 6;

    if (empty($bulan_array)) {
        echo "<script>alert('⚠️ Silakan pilih minimal 1 bulan pembayaran!');</script>";
    } else {
        $success_count = 0;
        foreach ($bulan_array as $bulan) {
            $bulan = mysqli_real_escape_string($koneksi, $bulan);
            $cek = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_siswa='$id_siswa' AND bulan='$bulan'");
            if (mysqli_num_rows($cek) == 0) {
                mysqli_query($koneksi, "INSERT INTO pembayaran (id_siswa, tgl_pembayaran, bulan, nominal, metode, id_pegawai) 
                VALUES ('$id_siswa', '$tanggal', '$bulan', 150000, '$metode', '$id_pegawai')");
                $success_count++;
            }
        }
        if ($success_count > 0) {
            echo "<script>alert('✅ Pembayaran berhasil untuk $success_count bulan!'); window.location='pembayaran.php?siswa=$id_siswa';</script>";
        } else {
            echo "<script>alert('❌ Semua bulan sudah dibayar!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran SPP - SMK Negeri 1 Sukawati</title>
<link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ==========================
   RESET & DASAR
========================== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
}

body {
  min-height: 100vh;
  background: linear-gradient(135deg, #1e1e2f, #2b2b3c);
  color: #f0f0f0;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}

/* ==========================
   FORM CONTAINER
========================== */
.container {
  display: flex;
  flex-direction: row;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(12px);
  border-radius: 15px;
  box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.6);
  overflow: hidden;
  max-width: 1100px;
  width: 100%;
}

/* LEFT SECTION (INFO) */
.left-section {
  flex: 1;
  padding: 2.5rem;
  background: rgba(255, 255, 255, 0.05);
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
  border-right: 1px solid rgba(255,255,255,0.1);
}

.left-section h1 {
  color: #f5c542;
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
}

.left-section p {
  color: #ccc;
  font-size: 1rem;
  margin-bottom: 1.5rem;
}

.info-card {
  text-align: left;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  padding: 1rem;
  border-radius: 10px;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #eee;
  margin-bottom: 8px;
}

/* RIGHT SECTION (FORM) */
.right-section {
  flex: 1.2;
  padding: 2.5rem;
}

select option {
  color: #000; /* hitam */
}

.form-header {
  text-align: center;
  margin-bottom: 1.8rem;
}

.form-header h2 {
  color: #f5c542;
  font-size: 1.6rem;
  margin-bottom: 0.5rem;
}

.form-header p {
  color: #ccc;
  font-size: 0.95rem;
}

/* FORM ELEMENTS */
.form-group {
  margin-bottom: 1rem;
  text-align: left;
}

.form-group label {
  display: block;
  color: #fff;
  font-weight: 600;
  margin-bottom: 0.4rem;
}

.form-control {
  width: 100%;
  padding: 0.7rem 1rem;
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 8px;
  background: rgba(255,255,255,0.08);
  color: #fff;
  font-size: 0.95rem;
}

.form-control:focus {
  border-color: #f5c542;
  outline: none;
  box-shadow: 0 0 8px rgba(245, 197, 66, 0.4);
}

select[multiple].form-control {
  height: 200px;
}

/* NOMINAL DISPLAY */
.nominal-display {
  background: rgba(255,255,255,0.08);
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
  margin: 1.5rem 0;
}

.nominal-display h3 {
  color: #f5c542;
  font-size: 1.6rem;
  margin-top: 0.5rem;
}

/* BUTTON */
.btn-submit {
  width: 100%;
  padding: 0.8rem;
  border: none;
  border-radius: 10px;
  background: #f5c542;
  color: #1e1e2f;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 4px 10px rgba(245, 197, 66, 0.3);
}

.btn-submit:hover {
  background: #d9aa2e;
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(245, 197, 66, 0.4);
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .container {
    flex-direction: column;
  }
  .left-section {
    border-right: none;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
}
</style>
</head>

<body>
<div class="container">
  <div class="left-section">
    <h1>SMK NEGERI 1 SUKAWATI</h1>
    <p>Sistem Pembayaran SPP Online</p>

    <div class="info-card">
      <div class="info-item"><i class="fas fa-money-bill-wave"></i> Biaya SPP: <strong>Rp150.000/bulan</strong></div>
      <div class="info-item"><i class="fas fa-calendar-check"></i> Periode Januari–Desember</div>
      <div class="info-item"><i class="fas fa-check-double"></i> Bisa bayar beberapa bulan</div>
      <div class="info-item"><i class="fas fa-shield-alt"></i> Data aman & terenkripsi</div>
    </div>
  </div>

  <div class="right-section">
    <div class="form-header">
      <h2>Form Pembayaran SPP</h2>
      <p>Isi data pembayaran dengan benar</p>
    </div>

    <form method="POST" id="formPembayaran">
      <div class="form-group">
        <label>Nama Siswa</label>
        <select name="id_siswa" id="id_siswa" class="form-control" onchange="loadBulanTerbayar()" required>
          <option value="">-- Pilih Nama Siswa --</option>
          <?php while ($s = mysqli_fetch_assoc($siswa_list)): ?>
            <option value="<?= $s['id_siswa']; ?>" <?= ($siswa_terpilih == $s['id_siswa']) ? 'selected' : ''; ?>>
              <?= htmlspecialchars($s['nama_siswa']); ?> (NIS: <?= $s['nis']; ?>)
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Tanggal Pembayaran</label>
        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
      </div>

      <div class="form-group">
        <label>Pilih Bulan</label>
        <select name="bulan[]" id="bulanSelect" class="form-control" multiple required onchange="updateNominal()">
          <?php
          $bulan_nama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
          foreach ($bulan_nama as $num=>$nama) echo "<option value='$num' id='option_bulan_$num'>$nama</option>";
          ?>
        </select>
      </div>

      <div class="nominal-display">
        <p>Total Pembayaran</p>
        <h3 id="nominalDisplay">Rp 0</h3>
        <p><span id="jumlahBulan">0</span> bulan × Rp150.000</p>
      </div>

      <div class="form-group">
        <label>Metode Pembayaran</label>
        <select name="metode" class="form-control" required>
          <option value="">-- Pilih Metode --</option>
          <option value="Tunai">Tunai</option>
          <option value="Transfer">Transfer</option>
          <option value="E-Wallet">E-Wallet</option>
          <option value="Kartu">Kartu Debit/Kredit</option>
        </select>
      </div>

      <button type="submit" class="btn-submit" id="btnSubmit">Proses Pembayaran</button>
    </form>
  </div>
</div>

<script>
function updateNominal() {
  const select = document.getElementById('bulanSelect');
  const count = select.selectedOptions.length;
  const total = count * 150000;
  document.getElementById('nominalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
  document.getElementById('jumlahBulan').textContent = count;
  document.getElementById('btnSubmit').disabled = count === 0;
}

function loadBulanTerbayar() {
  const siswaId = document.getElementById('id_siswa').value;
  const select = document.getElementById('bulanSelect');
  const all = select.querySelectorAll('option');
  if (!siswaId) {
    all.forEach(o => o.disabled = false);
    return;
  }
  fetch('?ajax=get_bulan_terbayar&id_siswa=' + siswaId)
  .then(r => r.json())
  .then(data => {
    all.forEach(o => o.disabled = false);
    data.bulan_terbayar.forEach(b => {
      const el = document.getElementById('option_bulan_' + b);
      if (el) el.disabled = true;
    });
  });
}
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('btnSubmit').disabled = true;
  if (document.getElementById('id_siswa').value) loadBulanTerbayar();
});
</script>
</body>
</html>

<?php
if (isset($_GET['ajax']) && $_GET['ajax'] == 'get_bulan_terbayar') {
  $id = mysqli_real_escape_string($koneksi, $_GET['id_siswa']);
  $data = getBulanTerbayar($koneksi, $id);
  header('Content-Type: application/json');
  echo json_encode(['bulan_terbayar' => $data]);
  exit;
}
?>
