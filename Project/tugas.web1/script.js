document.addEventListener("DOMContentLoaded", () => {
  /* ============================================================
     0. LOGIN LOGIC
  ============================================================ */
  const loginForm = document.getElementById("loginForm");

  if (loginForm) {
    loginForm.addEventListener("submit", e => {
      e.preventDefault();

      const username = document.getElementById("username").value.trim().toLowerCase();
      const password = document.getElementById("password").value.trim();

      const accounts = {
        admin: "admin123",
        user: "user123"
      };

      if (accounts[username] && accounts[username] === password) {
        localStorage.setItem("username", username);
        if (username === "admin") {
          window.location.href = "Admin/index.php";
        } else if (username === "user") {
          window.location.href = "pembayaran.php";
        }
      } else {
        alert("❌ Username atau password salah!");
      }
    });
  }

  /* ============================================================
     1. SALAM LOGIN
  ============================================================ */
  const username = localStorage.getItem("username");
  const greetingElement = document.getElementById("greeting");
  if (greetingElement && username) {
    greetingElement.textContent = "HALLO, " + username;
  }

  /* ============================================================
     2. JAM & TANGGAL REALTIME
  ============================================================ */
  const dateElement = document.getElementById("current-date");
  if (dateElement) {
    const updateDateTime = () => {
      const now = new Date();
      dateElement.textContent = now.toLocaleString("id-ID", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
      });
    };
    updateDateTime();
    setInterval(updateDateTime, 1000);
  }

  /* ============================================================
     3. DATA DROPDOWN
  ============================================================ */
  const jurusanData = {
    "10": ["PPLG(10)", "TJKT(10)", "KK(10)", "SR(10)", "SP(10)", "Anim(10)", "DITF(10)", "DKV(10)"],
    "11": ["RPL(11)", "TKJ(11)", "KK(11)", "SR(11)", "SP(11)", "Anim(11)", "DITF(11)", "DKV(11)"],
    "12": ["RPL(12)", "TKJ(12)", "KK(12)", "SR(12)", "SP(12)", "Anim(12)", "DITF(12)", "DKV(12)"]
  };

  const siswaData = {};
  ["10", "11", "12"].forEach(kelas => {
    const jurusanList = jurusanData[kelas];
    jurusanList.forEach(jurusan => {
      siswaData[jurusan] = ["A", "B", "C"].map(h => `${h} (${jurusan})`);
    });
  });

  /* ============================================================
     4. FUNGSI POPULATE DROPDOWN
  ============================================================ */
  function populateJurusan(kelasText) {
    const match = kelasText.match(/\((\d+)\)/);
    if (!match) return;
    const kelas = match[1];

    const jurusanBtn = document.getElementById("jurusan-btn");
    const jurusanContent = document.getElementById("jurusan-content");

    jurusanBtn.textContent = "Pilih Jurusan";
    jurusanContent.innerHTML = "";

    (jurusanData[kelas] || []).forEach(jurusan => {
      const a = document.createElement("a");
      a.href = "#";
      a.textContent = jurusan;
      jurusanContent.appendChild(a);
    });

    jurusanContent.innerHTML += `
      <hr>
      <div class="dropdown-actions">
        <a href="#" class="reset">Batal</a>
      </div>
    `;

    // Reset siswa
    const siswaBtn = document.getElementById("siswa-btn");
    const siswaContent = siswaBtn.nextElementSibling;
    siswaBtn.textContent = "Pilih Siswa";
    siswaContent.innerHTML = "";
  }

  function populateSiswa(jurusanText) {
    const siswaBtn = document.getElementById("siswa-btn");
    const siswaContent = siswaBtn.nextElementSibling;

    siswaBtn.textContent = "Pilih Siswa";
    siswaContent.innerHTML = "";

    (siswaData[jurusanText] || []).forEach(nama => {
      const a = document.createElement("a");
      a.href = "#";
      a.textContent = nama;
      siswaContent.appendChild(a);
    });

    siswaContent.innerHTML += `
      <hr>
      <div class="dropdown-actions">
        <a href="#" class="reset">Batal</a>
      </div>
    `;
  }

  /* ============================================================
     5. INTERAKSI DROPDOWN
  ============================================================ */
  const dropdownButtons = document.querySelectorAll(".dropdown .dropbtn");

  dropdownButtons.forEach(btn => {
    btn.addEventListener("click", e => {
      e.stopPropagation();

      const dropdownContent = btn.nextElementSibling;

      // Tutup dropdown lain
      document.querySelectorAll(".dropdown-content").forEach(dc => {
        if (dc !== dropdownContent) dc.classList.remove("show");
      });

      dropdownContent.classList.toggle("show");
    });
  });

  // Tutup semua dropdown saat klik di luar
  window.addEventListener("click", () => {
    document.querySelectorAll(".dropdown-content").forEach(dc => dc.classList.remove("show"));
  });

  // Klik item dropdown
  document.addEventListener("click", e => {
    const link = e.target.closest(".dropdown-content a");
    if (!link || link.classList.contains("reset")) return;

    e.preventDefault();

    const btn = link.closest(".dropdown").querySelector(".dropbtn");
    btn.textContent = link.textContent;
    link.closest(".dropdown-content").classList.remove("show");

    // Populate turunan dropdown
    if (btn.id === "kelas-dropdown") populateJurusan(link.textContent);
    if (btn.id === "jurusan-btn") populateSiswa(link.textContent);
  });

  // Tombol reset
  document.addEventListener("click", e => {
    if (!e.target.classList.contains("reset")) return;
    e.preventDefault();
    const dropdown = e.target.closest(".dropdown");
    const btn = dropdown.querySelector(".dropbtn");
    btn.textContent = "Pilih Opsi";
    dropdown.querySelector(".dropdown-content").classList.remove("show");
  });

  /* ============================================================
     6. BULAN BAYAR + NOMINAL
  ============================================================ */
  const hargaPerBulan = 150000;
  const bulanContainer = document.getElementById("bulan-bayar");
  const bulanBtn = document.getElementById("bulan-btn");
  const nominalBtn = document.getElementById("nominal-btn");

  if (bulanContainer && bulanBtn && nominalBtn) {
    // Cegah close dropdown saat klik checkbox
    bulanContainer.addEventListener("click", e => e.stopPropagation());

    // Tombol OK & Batal
    bulanContainer.querySelector(".ok").addEventListener("click", e => {
      e.preventDefault();
      const checked = bulanContainer.querySelectorAll("input[type='checkbox']:checked");
      const bulanDipilih = Array.from(checked).map(cb => cb.value);
      bulanBtn.textContent = bulanDipilih.length ? bulanDipilih.join(", ") : "Pilih Bulan";
      bulanContainer.classList.remove("show");

      const total = checked.length * hargaPerBulan;
      nominalBtn.textContent = total > 0 ? `Rp ${total.toLocaleString("id-ID")}` : "Rp 0";
    });

    bulanContainer.querySelector(".reset").addEventListener("click", e => {
      e.preventDefault();
      bulanContainer.querySelectorAll("input[type='checkbox']").forEach(cb => (cb.checked = false));
      bulanBtn.textContent = "Pilih Bulan";
      nominalBtn.textContent = "Rp 0";
      bulanContainer.classList.remove("show");
    });
  }

  /* ============================================================
     7. SUBMIT DATA
  ============================================================ */
  const submitBtn = document.getElementById("submit-btn");

  if (submitBtn) {
    submitBtn.addEventListener("click", e => {
      e.preventDefault();

      const jurusan = document.getElementById("jurusan-btn")?.textContent || "";
      const siswa = document.getElementById("siswa-btn")?.textContent || "";
      const bulan = document.getElementById("bulan-btn")?.textContent || "";
      const nominal = document.getElementById("nominal-btn")?.textContent || "";

      if (
        jurusan.includes("Pilih") ||
        siswa.includes("Pilih") ||
        bulan.includes("Pilih") ||
        nominal.includes("Rp 0")
      ) {
        alert("⚠️ Harap lengkapi semua data sebelum submit!");
        return;
      }

      const waktu = new Date().toLocaleString("id-ID", {
        dateStyle: "short",
        timeStyle: "short"
      });

      let data = JSON.parse(localStorage.getItem("rekapSPP")) || [];
      const editIndex = localStorage.getItem("editIndex");

      if (editIndex !== null) {
        data[editIndex] = { jurusan, siswa, bulan, nominal, waktu };
        localStorage.removeItem("editIndex");
      } else {
        data.push({ jurusan, siswa, bulan, nominal, waktu });
      }

      localStorage.setItem("rekapSPP", JSON.stringify(data));
      window.location.href = "rekap.php";
    });
  }

  /* ============================================================
     8. PREFILL SAAT EDIT DATA
  ============================================================ */
  const editIndex = localStorage.getItem("editIndex");
  if (editIndex !== null) {
    const data = JSON.parse(localStorage.getItem("rekapSPP")) || [];
    const row = data[editIndex];

    if (row) {
      document.getElementById("jurusan-btn").textContent = row.jurusan;
      document.getElementById("siswa-btn").textContent = row.siswa;
      document.getElementById("bulan-btn").textContent = row.bulan;
      document.getElementById("nominal-btn").textContent = row.nominal;
    }
  }
});
