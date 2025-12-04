<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard persidangan - Sekretariat DPRD</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- HEADER -->
  <header class="flex items-center bg-gray-300 p-4 rounded-b-lg shadow">
    <img src="/images/logo_sukabumi3.png" alt="Logo" class="h-24 mr-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">BAGIAN PERSIDANGAN</h1>
      <p class="text-xl font-semibold text-gray-800">SEKRETARIAT DPRD KABUPATEN SUKABUMI</p>
    </div>
  </header>

  <div class="flex min-h-screen">

    <!-- SIDEBAR -->
<aside class="w-64 bg-gray-400 flex flex-col justify-between p-4 rounded-r-3xl shadow-lg">
  
  <div>
    <button onclick="showUpload()" class="w-full bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg mb-4 hover:bg-gray-800 transition">
      UPLOAD LAPORAN
    </button>

    <button onclick="showRiwayat()" class="w-full bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-800 transition">
      RIWAYAT LAPORAN
    </button>
  </div>

  <!-- TOMBOL LOGOUT -->
  <div class="text-center w-full">
    <form action="{{ route('logout') }}" method="POST" class="w-full">
      @csrf
      <button type="submit"
        class="flex items-center justify-center w-full text-white bg-gray-700 hover:bg-gray-800 py-3 rounded-lg font-bold">
        LOGOUT
      </button>
    </form>
  </div>
</aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
   <!-- UPLOAD FORM -->
<section id="upload-section" class="bg-white shadow-2xl rounded-3xl p-10 max-w-3xl mx-auto mt-6 border border-gray-100">
  <div class="text-center mb-10">
    <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight mb-2">UPLOAD LAPORAN</h2>
    <p class="text-gray-500">Silakan isi data laporan dan unggah file dalam format PDF.</p>
  </div>

  <form id="uploadForm" class="space-y-7">
    <!-- Tanggal -->
    <div>
      <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Kegiatan</label>
      <input id="tanggal" type="date"
        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-sm hover:shadow-md" required>
    </div>

      <!-- Sub Kegiatan -->
<div>
  <label for="kegiatan" class="block text-gray-700 font-semibold mb-2">Pilih Sub Kegiatan</label>
  <select id="kegiatan"
    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-sm hover:shadow-md" required>
    <option value="">-- Pilih Sub Kegiatan --</option>
    <option value="penyusunan_pembahasan_progbangperda">Penyusunan dan Pembahasan Program Pembentukan Peraturan Daerah</option>
    <option value="pembahasan_ranperda">Pembahasan Rancangan Peraturan Daerah</option>
    <option value="kajian_perundang_undangan">Penyelenggaraan Kajian Perundang-Undangan</option>
    <option value="fasilitasi_penyusunan_naskah_akademik">Fasilitasi Penyusunan Penjelasan/Keterangan Naskah Akademik</option>
    <option value="penyusunan_tata_tertib_dprd">Penyusunan Tata Tertib DPRD</option>
    <option value="hubungan_masyarakat">Penyelenggaraan Hubungan Masyarakat</option>
    <option value="publikasi_dokumentasi_dprd">Publikasi dan Dokumentasi DPRD</option>
    <option value="koordinasi_konsultasi_tugas_dprd">Koordinasi dan Konsultasi Pelaksanaan Tugas DPRD</option>
    <option value="fasilitasi_tugas_bamus">Fasilitasi Pelaksanaan Tugas Badan Musyawarah</option>
  </select>
</div>

    <!-- Uraian Rekening -->
    <div>
      <label for="subKegiatan" class="block text-gray-700 font-semibold mb-2">Pilih Uraian Rekening</label>
      <select id="subKegiatan"
        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-sm hover:shadow-md" required>
        <option value="">-- Pilih Uraian Rekening --</option>
      </select>
    </div>

  <style>
  /* Animasi Border Laporan kegiatan */
  .animated-border {
    background: linear-gradient(120deg, #3b82f6, #8b5cf6, #10b981);
    background-size: 200% 200%;
    animation: gradientMove 3s ease infinite;
  }

  @keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  /* Loading Spinner */
  .spin {
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    100% { transform: rotate(360deg); }
  }
</style>

<!-- UPLOAD BOX ULTRA MODERN -->
<div class="w-full">
  <label class="block text-gray-700 font-semibold mb-2">Upload Laporan Kegiatan (PDF)</label>

  <div id="uploadWrapper" class="p-[2px] rounded-2xl transition-all duration-500">
    <div id="uploadBox"
      class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-blue-400 rounded-2xl cursor-pointer bg-white/70 backdrop-blur-md hover:bg-white transition-all duration-500 shadow-xl">
      
      <input id="fileUpload" type="file" accept=".pdf" class="hidden">

      <!-- ICON -->
      <div id="iconArea" class="transition-all duration-500">
        <svg id="uploadIcon" class="w-12 h-12 text-blue-500 mb-3"
          fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M7 16a4 4 0 008 0m-4-4v-4m0 0L8 9m4-1l4 4m5 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" />
        </svg>
      </div>

      <!-- TEXT -->
      <p id="uploadText" class="text-sm text-blue-600 font-semibold transition-all duration-500">
        Klik untuk unggah file PDF
      </p>
      <p class="text-xs text-gray-500">Ukuran maksimal 10 MB</p>
    </div>
  </div>
</div>

<script>
  const fileUpload = document.getElementById("fileUpload");
  const uploadBox = document.getElementById("uploadBox");
  const uploadWrapper = document.getElementById("uploadWrapper");
  const uploadText = document.getElementById("uploadText");
  const iconArea = document.getElementById("iconArea");

  uploadBox.addEventListener("click", () => fileUpload.click());

  fileUpload.addEventListener("change", () => {
    if (fileUpload.files.length > 0) {
      const fileName = fileUpload.files[0].name;

      // Efek glow border gradient
      uploadWrapper.classList.add("animated-border", "shadow-[0_0_15px_rgba(0,0,0,0.1)]");

      // Loading spinner
      iconArea.innerHTML = `
        <svg class="w-10 h-10 text-blue-500 spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke-opacity="0.3"></circle>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4"></path>
        </svg>
      `;

      uploadText.textContent = "Sedang memproses...";
      uploadText.classList.remove("text-blue-600");
      uploadText.classList.add("text-purple-600");

      // Setelah 0.8 detik → animasi sukses
      setTimeout(() => {
        iconArea.innerHTML = `
          <svg class="w-12 h-12 text-green-600 transition-all duration-500"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        `;

        uploadBox.classList.add("bg-green-50", "shadow-lg", "scale-[1.02]");
        uploadBox.classList.remove("border-blue-400");
        uploadBox.classList.add("border-green-500");

        uploadText.textContent = "Berhasil diunggah: " + fileName;
        uploadText.classList.remove("text-purple-600");
        uploadText.classList.add("text-green-700");
      }, 800);
    }
  });
</script>

    <style>
  /* Border gradient pajak */
  .animated-border-green {
    background: linear-gradient(120deg, #10b981, #34d399, #6ee7b7);
    background-size: 200% 200%;
    animation: gradientGreen 3s ease infinite;
  }

  @keyframes gradientGreen {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  /* Loading Spinner */
  .spin {
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    100% { transform: rotate(360deg); }
  }
</style>

<!-- Upload Laporan Pajak (Super Keren) -->
<div class="mt-4">
  <label for="filePajak" class="block text-gray-700 font-semibold mb-2">Upload Laporan Pajak (PDF)</label>

  <div id="uploadWrapperPajak" class="p-[2px] rounded-2xl transition-all duration-500">
    <div id="uploadBoxPajak"
      class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-green-400 rounded-2xl cursor-pointer bg-green-50 hover:bg-green-100 transition-all duration-500 shadow-md">

      <input id="filePajak" type="file" accept=".pdf" class="hidden" />

      <!-- ICON -->
      <div id="iconAreaPajak" class="transition-all duration-500">
        <svg id="uploadIconPajak" class="w-12 h-12 text-green-500 mb-3"
          fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M7 16a4 4 0 008 0m-4-4v-4m0 0L8 9m4-1l4 4m5 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" />
        </svg>
      </div>

      <!-- TEXT -->
      <p id="uploadTextPajak" class="text-sm text-green-700 font-semibold transition-all duration-500">
        Klik untuk unggah file PDF
      </p>
      <p class="text-xs text-gray-500">Ukuran maksimal 10 MB</p>

    </div>
  </div>
</div>

<script>
  const pajakFile = document.getElementById("filePajak");
  const uploadBoxPajak = document.getElementById("uploadBoxPajak");
  const uploadWrapperPajak = document.getElementById("uploadWrapperPajak");
  const uploadTextPajak = document.getElementById("uploadTextPajak");
  const iconAreaPajak = document.getElementById("iconAreaPajak");

  uploadBoxPajak.addEventListener("click", () => pajakFile.click());

  pajakFile.addEventListener("change", () => {
    if (pajakFile.files.length > 0) {
      const fileName = pajakFile.files[0].name;

      // Glow border hijau bergerak
      uploadWrapperPajak.classList.add("animated-border-green", "shadow-[0_0_20px_rgba(16,185,129,0.4)]");

      // Loading spinner
      iconAreaPajak.innerHTML = `
        <svg class="w-10 h-10 text-green-500 spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke-opacity="0.3"></circle>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4"></path>
        </svg>
      `;

      uploadTextPajak.textContent = "Sedang memproses...";
      uploadTextPajak.classList.remove("text-green-700");
      uploadTextPajak.classList.add("text-green-500");

      // Setelah loading → sukses
      setTimeout(() => {
        iconAreaPajak.innerHTML = `
          <svg class="w-14 h-14 text-green-600 transition-all duration-500"
            fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        `;

        uploadBoxPajak.classList.add("bg-green-100", "shadow-lg", "scale-[1.02]");
        uploadBoxPajak.classList.remove("border-green-400");
        uploadBoxPajak.classList.add("border-green-600");

        uploadTextPajak.textContent = "Berhasil diunggah: " + fileName;
        uploadTextPajak.classList.remove("text-green-500");
        uploadTextPajak.classList.add("text-green-700");
      }, 900);
    }
  });
</script>


    <!-- Tombol Upload -->
    <div class="text-center pt-4">
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-10 rounded-xl shadow-md transition-all duration-300 hover:scale-[1.03]">
        Upload
      </button>
    </div>
  </form>
</section>


     <!-- RIWAYAT LAPORAN DENGAN FITUR PENCARIAN -->
<section id="riwayat-section" class="hidden bg-white shadow-2xl rounded-3xl p-8 max-w-5xl mx-auto border border-gray-100">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">RIWAYAT LAPORAN</h2>

    <!-- Kolom Pencarian -->
    <div class="relative w-full sm:w-80">
      <input
        type="text"
        id="searchInput"
        placeholder="Cari laporan..."
        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm hover:shadow-md"
      />
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    </div>
  </div>

  <!-- Tabel Riwayat -->
  <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
    <table class="w-full border-collapse text-center text-gray-700">
      <thead class="bg-gray-50 text-gray-700 font-semibold">
        <tr>
          <th class="p-3 border border-gray-200">Tanggal</th>
          <th class="p-3 border border-gray-200">Sub Kegiatan</th>
          <th class="p-3 border border-gray-200">Uraian Rekening</th>
          <th class="p-3 border border-gray-200">File Laporan</th>
          <th class="p-3 border border-gray-200">File Pajak</th>
        </tr>
      </thead>
      <tbody id="riwayatTable">
        <tr>
          <td colspan="4" class="p-5 text-gray-500">Belum ada laporan diunggah.</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- SCRIPT PENCARIAN -->
<script>
  const searchInput = document.getElementById("searchInput");
  const tableBody = document.getElementById("riwayatTable");

  searchInput.addEventListener("keyup", () => {
    const searchText = searchInput.value.toLowerCase();
    const rows = tableBody.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");
      let match = false;

      // Periksa setiap kolom di baris
      for (let j = 0; j < cells.length; j++) {
        const cellText = cells[j]?.textContent.toLowerCase() || "";
        if (cellText.includes(searchText)) {
          match = true;
          break;
        }
      }

      rows[i].style.display = match ? "" : "none";
    }
  });
</script>

  <script>
    const kegiatanSelect = document.getElementById('kegiatan');
    const subKegiatanSelect = document.getElementById('subKegiatan');

    const uraianOptions = {
      penyusunan_pembahasan_progbangperda: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Makanan dan Minuman Rapat",
       "Belanja Jasa Kontribusi Asosiasi",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"     
      ],
      pembahasan_ranperda: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Makanan dan Minuman Rapat",
       "Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota",
       "Belanja Perjalanan Dinas Paket Meeting Dalam Kota",
       "Belanja Jasa yang Diberikan kepada Pihak Ketiga/Pihak Lain"
      ],
      kajian_perundang_undangan: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Makanan dan Minuman Rapat",
       "Belanja Jasa Tenaga Ahli",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      fasilitasi_penyusunan_naskah_akademik: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Makanan dan Minuman Rapat",
       "Belanja Jasa Konsultansi Berorientasi Layanan-Jasa Studi Penelitian dan Bantuan Teknik",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      penyusunan_tata_tertib_dprd: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Makanan dan Minuman Rapat",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      hubungan_masyarakat: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Jasa Tenaga Supir",
       "Belanja Jasa Iklan/Reklame, Film, dan Pemotretan",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      publikasi_dokumentasi_dprd: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia",
       "Belanja Jasa Iklan/Reklame, Film, dan Pemotretan",
       "Belanja Langganan Jurnal/Surat Kabar/Majalah",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      koordinasi_konsultasi_tugas_dprd: [
       "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
       "Belanja Sewa Kendaraan Bermotor Penumpang",
       "Belanja Perjalanan Dinas Biasa",
       "Belanja Perjalanan Dinas Dalam Kota"
      ],
      fasilitasi_tugas_bamus: [
      "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
      "Belanja Makanan dan Minuman Rapat",
      "Belanja Perjalanan Dinas Biasa",
      "Belanja Perjalanan Dinas Dalam Kota"
      ]

    };

    kegiatanSelect.addEventListener('change', () => {
      const selected = kegiatanSelect.value;
      subKegiatanSelect.innerHTML = '<option value="">-- Pilih Uraian Rekening --</option>';
      
      if (uraianOptions[selected]) {
        uraianOptions[selected].forEach(item => {
          const option = document.createElement('option');
          option.textContent = item;
          subKegiatanSelect.appendChild(option);
        });
      }
    });

    // SISTEM UPLOAD DAN RIWAYAT
    const uploadSection = document.getElementById('upload-section');
    const riwayatSection = document.getElementById('riwayat-section');
    const uploadForm = document.getElementById('uploadForm');
    const riwayatTable = document.getElementById('riwayatTable');
    let laporanData = [];

    function showUpload() {
      uploadSection.classList.remove('hidden');
      riwayatSection.classList.add('hidden');
    }

    function showRiwayat() {
      riwayatSection.classList.remove('hidden');
      uploadSection.classList.add('hidden');
      renderRiwayat();
    }

    function renderRiwayat() {
  if (laporanData.length === 0) {
    riwayatTable.innerHTML = `
      <tr><td colspan="5" class="p-4 text-gray-500">Belum ada laporan diunggah.</td></tr>
    `;
    return;
  }

  riwayatTable.innerHTML = laporanData.map(laporan => `
    <tr class="hover:bg-gray-50">
      <td class="border border-gray-300 p-2">${laporan.tanggal}</td>
      <td class="border border-gray-300 p-2">${laporan.kegiatan}</td>
      <td class="border border-gray-300 p-2">${laporan.subKegiatan}</td>
      <td class="border border-gray-300 p-2">
        <a href="#" class="text-blue-600 underline">${laporan.fileName}</a>
      </td>
      <td class="border border-gray-300 p-2">
        <a href="#" class="text-green-600 underline">${laporan.filePajakName}</a>
      </td>
    </tr>
  `).join('');
}

    uploadForm.addEventListener('submit', function(e) {
  e.preventDefault();

  const tanggal = document.getElementById('tanggal').value;
  const kegiatan = kegiatanSelect.options[kegiatanSelect.selectedIndex].text;
  const subKegiatan = subKegiatanSelect.options[subKegiatanSelect.selectedIndex].text;

  const fileInput = document.getElementById('fileUpload');
  const fileName = fileInput.files[0] ? fileInput.files[0].name : '';

  const filePajakInput = document.getElementById('filePajak');
  const filePajakName = filePajakInput.files[0] ? filePajakInput.files[0].name : '';

  laporanData.push({
    tanggal,
    kegiatan,
    subKegiatan,
    fileName,
    filePajakName
  });

  uploadForm.reset();
  alert('Laporan dan pajak berhasil diunggah!');
});

  </script>
</body>
</html>