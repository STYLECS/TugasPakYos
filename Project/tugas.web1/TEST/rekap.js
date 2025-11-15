document.addEventListener("DOMContentLoaded", () => {

  // JAM & TANGGAL REALTIME
  const dateElement = document.getElementById("current-date");
  if (dateElement) {
    function updateDateTime() {
      const now = new Date();
      const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
      };
      dateElement.textContent = now.toLocaleDateString("id-ID", options);
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
  }

  // SALAM LOGIN
  const username = localStorage.getItem("username");
  const greetingElement = document.getElementById("greeting");
  if (greetingElement && username) {
    greetingElement.textContent = "HALLO, " + username;
  }


  const tableBody = document.querySelector("#rekap-table tbody");
  const clearBtn = document.getElementById("clear-data");

  // Ambil data dari localStorage
  let data = JSON.parse(localStorage.getItem("rekapSPP")) || [];

  // Render data ke tabel
  function renderTable() {
    tableBody.innerHTML = "";

    if (data.length === 0) {
      const tr = document.createElement("tr");
      tr.innerHTML = `<td colspan="6" style="text-align:center">Belum ada data</td>`;
      tableBody.appendChild(tr);
      return;
    }

    data.forEach((row, index) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${row.jurusan}</td>
        <td>${row.siswa}</td>
        <td>${row.bulan}</td>
        <td>${row.nominal}</td>
        <td>${row.waktu || "-"}</td>
        <td>
          <button class="edit-btn" data-index="${index}">Edit</button>
        </td>
      `;
      tableBody.appendChild(tr);
    });
  }

  renderTable();

  // Event: klik tombol Edit
  tableBody.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-btn")) {
      const index = e.target.dataset.index;

      // Simpan index yang akan diedit
      localStorage.setItem("editIndex", index);

      // Pindah ke hlmutama.php
      window.location.href = "hlmutama.php";
    }
  });

  // Event: hapus semua data
  clearBtn.addEventListener("click", () => {
    if (confirm("Yakin ingin hapus semua data?")) {
      localStorage.removeItem("rekapSPP");
      data = [];
      renderTable();
    }
  });
});
