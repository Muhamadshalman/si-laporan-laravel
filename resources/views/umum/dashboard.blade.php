<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Umum - Sekretariat DPRD</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- HEADER -->
  <x-header></x-header>

  <div class="flex min-h-screen">
    <!-- SIDEBAR (KONSISTEN DI SEMUA TAB) -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col justify-between p-5 shadow-lg">
      <div class="space-y-3">
        <button onclick="showUpload()" id="btn-upload" class="w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-700 transition font-medium flex items-center gap-2">
          Upload Laporan
        </button>
        <button onclick="showRiwayat()" id="btn-riwayat" class="w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-700 transition font-medium flex items-center gap-2">
          Riwayat Laporan
        </button>
      </div>

      <!-- LOGOUT -->
      <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="w-full flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg bg-orange-600 hover:bg-red-700 transition font-medium text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Logout
        </button>
      </form>
    </aside>

    <!-- MAIN CONTENT (KONSISTEN LAYOUT) -->
    <main class="flex-1 p-6">

      <!-- NOTIFIKASI SUKSES (MUNCUL DI SEMUA TAB) -->
      @if(session('success'))
        <div class="fixed top-4 right-6 bg-green-500 text-white px-5 py-2.5 rounded-lg shadow-lg z-50">
          {{ session('success') }}
        </div>
        <script>setTimeout(() => document.querySelector('.fixed.top-4')?.remove(), 4000);</script>
      @endif

      <!-- UPLOAD SECTION -->
<section id="upload-section" class="hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl mx-auto border border-gray-100">
        
        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800 tracking-wider">UPLOAD LAPORAN</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan isi data laporan dan unggah file dalam format PDF.</p>
        </div>

        <form action="{{ route('laporan.store', ['bagian' => session('bagian')]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                
                <div>
                    <label class="block text-gray-700 font-medium mb-1.5 text-sm">Tanggal Kegiatan</label>
                    <div class="relative">
                         <input type="date" name="tanggal" required 
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm pr-10 focus:ring-blue-500 focus:border-blue-500 focus:outline-none placeholder-gray-400">
                         <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1.5 text-sm">Pilih Sub Kegiatan</label>
                    <div class="relative">
                        <select name="kegiatan" id="kegiatan" required 
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm appearance-none focus:ring-blue-500 focus:border-blue-500 focus:outline-none bg-white text-gray-700">
                            <option value="">-- Pilih Sub Kegiatan --</option>
                            <option value="rekonsiliasi_laporan_bmd_skpd">Rekonsiliasi Laporan BMD</option>
                            <option value="penyediaan_tenaga_ahli_fraksi">Penyediaan Tenaga Ahli Fraksi</option>
                        </select>
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                </div>

            </div>
            
            <div class="mb-5 mt-5">
                <label class="block text-gray-700 font-medium mb-1.5 text-sm">Pilih Uraian Rekening</label>
                <div class="relative">
                    <select name="sub_kegiatan" id="sub_kegiatan" required 
                            class="w-full border border-gray-300 rounded-lg p-3 text-sm appearance-none focus:ring-blue-500 focus:border-blue-500 focus:outline-none bg-white text-gray-700">
                        <option value="">-- Pilih Sub Kegiatan dulu --</option>
                    </select>
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                
                <!-- Upload Laporan Kegiatan -->
<div>
    <label class="block text-gray-700 font-medium mb-1.5 text-sm">Upload Laporan Kegiatan (PDF)</label>
    <div id="file_laporan_preview" 
     class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-40 hover:border-blue-500 transition duration-150 bg-gray-50"
     onclick="document.getElementById('file_laporan_input').click()">
  <svg id="icon_laporan" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
  </svg>
  <p id="text_laporan" class="text-gray-600 text-sm font-medium">Klik untuk unggah file PDF</p>
  <p class="text-xs text-gray-400 mt-1">Maksimal 10 MB</p>
  <input type="file" id="file_laporan_input" name="file_laporan" accept=".pdf" required class="hidden">
</div>
</div>

<!-- Upload Laporan Pajak -->
<div>
    <label class="block text-gray-700 font-medium mb-1.5 text-sm">Upload Laporan Pajak (PDF)</label>
    <div id="file_pajak_preview"
     class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-40 hover:border-blue-500 transition duration-150 bg-gray-50"
     onclick="document.getElementById('file_pajak_input').click()">
  <svg id="icon_pajak" ... ></svg>
  <p id="text_pajak" ... >Klik untuk unggah file PDF</p>
  <p class="text-xs text-gray-400 mt-1">Maksimal 10 MB</p>
  <input type="file" id="file_pajak_input" name="file_pajak" accept=".pdf" class="hidden">
</div>
</div>

            </div>

            <div class="text-right pt-8">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 font-medium flex items-center justify-center float-right shadow-md transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Upload
                </button>
            </div>
            
        </form>
    </div>
</section>
      <!-- RIWAYAT SECTION (DEFAULT TAMPIL) -->
<section id="riwayat-section" class="hidden">
  <div class="bg-white rounded-2xl shadow-lg p-6 max-w-5xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Riwayat Laporan</h2>
      <input type="text" id="searchInput" placeholder="Cari laporan..." class="mt-3 md:mt-0 border border-gray-300 rounded-lg px-3 py-1.5 w-full md:w-64">
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 border-b">Tanggal</th>
            <th class="p-3 border-b">Sub Kegiatan</th>
            <th class="p-3 border-b">Uraian Rekening</th>
            <th class="p-3 border-b">File Laporan</th>
            <th class="p-3 border-b">File Pajak</th>
          </tr>
        </thead>
        <tbody id="riwayatTable">
          @forelse ($riwayat as $item)
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
              <td class="p-3">{{ $item->kegiatan }}</td>
              <td class="p-3">{{ $item->sub_kegiatan }}</td>
              <td class="p-3">
                @if($item->file_laporan)
                  <!-- Tombol Lihat (Open in New Tab) -->
                  <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat
                  </a>
                  <!-- Tombol Download -->
                  <!-- <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" download class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 text-xs font-medium ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7V4a1 1 0 00-1-1H8a1 1 0 00-1 1v3m8 0h6v6m0 0l-3-3m3 3l3-3" />
                    </svg>
                    Unduh
                  </a> -->
                @else
                  -
                @endif
              </td>
              <td class="p-3">
                @if($item->file_pajak)
                  <!-- Tombol Lihat (Buka di Tab Baru - TANPA DOWNLOAD) -->
<a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs font-medium">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
  </svg>
  Lihat
</a>

<!-- Tombol Download (DENGAN DOWNLOAD) -->
<!-- <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" download class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 text-xs font-medium ml-1">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7V4a1 1 0 00-1-1H8a1 1 0 00-1 1v3m8 0h6v6m0 0l-3-3m3 3l3-3" />
  </svg>
  Unduh
</a> -->
                @else
                  -
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="p-6 text-center text-gray-500">Belum ada laporan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
<footer class="mt-12 text-center text-gray-500 text-sm">
  &copy; {{ date('Y') }} Sekretariat DPRD Kabupaten Sukabumi.  
  Dikembangkan oleh <a href="https://muhamadsatria.unlimitedpvp.biz.id/" target="_blank" class="text-blue-600 hover:underline">Muhammad Satria</a> – Founder SarDeveloper Team.
</footer>
</main>
  </div>

  <script>
  // Dropdown Sub Kegiatan
  const kegiatanSelect = document.getElementById('kegiatan');
  const subKegiatanSelect = document.getElementById('sub_kegiatan');
  const uraianOptions = {
    rekonsiliasi_laporan_bmd_skpd: ["Belanja ATK", "Makanan Rapat", "Perjalanan Dinas"],
    penyediaan_tenaga_ahli_fraksi: ["Belanja ATK", "Jasa Tenaga Admin"]
  };

  if (kegiatanSelect && subKegiatanSelect) {
    kegiatanSelect.addEventListener('change', () => {
      subKegiatanSelect.innerHTML = '<option value="">-- Pilih --</option>';
      const val = kegiatanSelect.value;
      if (uraianOptions[val]) {
        uraianOptions[val].forEach(item => {
          const opt = document.createElement('option');
          opt.value = item;
          opt.textContent = item;
          subKegiatanSelect.appendChild(opt);
        });
      }
    });
  }

  // Tab Switch
  function showUpload() {
    const uploadSec = document.getElementById('upload-section');
    const riwayatSec = document.getElementById('riwayat-section');
    const btnUpload = document.getElementById('btn-upload');
    const btnRiwayat = document.getElementById('btn-riwayat');

    if (uploadSec) uploadSec.classList.remove('hidden');
    if (riwayatSec) riwayatSec.classList.add('hidden');
    if (btnUpload) btnUpload.classList.add('bg-gray-700', 'text-white');
    if (btnRiwayat) btnRiwayat.classList.remove('bg-gray-700', 'text-white');
  }

  function showRiwayat() {
    const uploadSec = document.getElementById('upload-section');
    const riwayatSec = document.getElementById('riwayat-section');
    const btnUpload = document.getElementById('btn-upload');
    const btnRiwayat = document.getElementById('btn-riwayat');

    if (riwayatSec) riwayatSec.classList.remove('hidden');
    if (uploadSec) uploadSec.classList.add('hidden');
    if (btnRiwayat) btnRiwayat.classList.add('bg-gray-700', 'text-white');
    if (btnUpload) btnUpload.classList.remove('bg-gray-700', 'text-white');
  }

  // Pencarian
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const term = this.value.toLowerCase();
      const rows = document.querySelectorAll('#riwayatTable tr:not(:first-child)');
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    });
  }

  // Fungsi untuk update tampilan file preview
  function updateFilePreview(inputId, previewId, iconId, textId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const icon = document.getElementById(iconId);
    const text = document.getElementById(textId);

    if (!input || !preview || !icon || !text) return;

    input.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        // ✅ Tampilkan centang hijau saat file dipilih
        icon.innerHTML = `<svg class="h-10 w-10 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>`;
        text.textContent = file.name.length > 25 ? file.name.substring(0, 22) + '...' : file.name;
        text.classList.add('text-green-600', 'font-semibold');
        preview.classList.remove('bg-gray-50', 'border-dashed', 'border-gray-300');
        preview.classList.add('bg-green-50', 'border-solid', 'border-green-300');
      } else {
        // ❌ Reset ke ikon PDF asli (harus pakai tag <svg> utuh!)
        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
        </svg>`;
        text.textContent = 'Klik untuk unggah file PDF';
        text.classList.remove('text-green-600', 'font-semibold');
        preview.classList.remove('bg-green-50', 'border-solid', 'border-green-300');
        preview.classList.add('bg-gray-50', 'border-dashed', 'border-gray-300');
      }
    });
  }

  // Inisialisasi saat halaman dimuat
  document.addEventListener('DOMContentLoaded', () => {
    updateFilePreview('file_laporan_input', 'file_laporan_preview', 'icon_laporan', 'text_laporan');
    updateFilePreview('file_pajak_input', 'file_pajak_preview', 'icon_pajak', 'text_pajak');
    showRiwayat(); // Default ke Riwayat
  });
</script>
</body>
</html>