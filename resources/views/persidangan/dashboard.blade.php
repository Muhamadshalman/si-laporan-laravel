<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Persidangan - Sekretariat DPRD</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <x-persidangan></x-persidangan>

  <div class="flex min-h-screen flex-col md:flex-row">
    <!-- SIDEBAR (Hanya di desktop) -->
    <aside class="md:w-64 w-full bg-gray-800 text-white p-4 shadow-lg md:block hidden">
      <div class="space-y-3 mb-8">
        <button onclick="showUpload()" id="btn-upload" class="w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-700 transition font-medium flex items-center gap-2">
          UPLOAD LAPORAN
        </button>
        <button onclick="showRiwayat()" id="btn-riwayat" class="w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-700 transition font-medium flex items-center gap-2">
          RIWAYAT LAPORAN
        </button>
      </div>

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

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-4 md:p-6">

      <!-- NOTIFIKASI -->
      @if(session('success'))
        <div class="fixed top-4 right-4 md:right-6 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm">
          {{ session('success') }}
        </div>
        <script>setTimeout(() => document.querySelector('.fixed.top-4')?.remove(), 4000);</script>
      @endif

      <!-- UPLOAD SECTION -->
      <section id="upload-section" class="hidden">
        <div class="bg-white rounded-xl shadow p-4 md:p-6">
          <div class="mb-5 border-b pb-3">
            <h2 class="text-lg md:text-xl font-bold text-gray-800">UPLOAD LAPORAN</h2>
            <p class="text-xs md:text-sm text-gray-500 mt-1">Unggah laporan dalam format PDF.</p>
          </div>

           <form action="{{ route('laporan.store', ['bagian' => $bagian]) }}" 
             method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-4 mb-5">
              <div>
                <label class="block text-gray-700 font-medium mb-1 text-xs md:text-sm">Tanggal Kegiatan</label>
                <input type="date" name="tanggal" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:outline-none">
              </div>

              <div>
                <label class="block text-gray-700 font-medium mb-1 text-xs md:text-sm">Pilih Sub Kegiatan</label>
                <select name="kegiatan" id="kegiatan" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm appearance-none bg-white focus:ring-blue-500 focus:outline-none">
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

              <div>
                <label class="block text-gray-700 font-medium mb-1 text-xs md:text-sm">Pilih Uraian Rekening</label>
                <select name="sub_kegiatan" id="sub_kegiatan" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm appearance-none bg-white focus:ring-blue-500 focus:outline-none">
                  <option value="">-- Pilih Uraian Rekening --</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6">
              <div class="grid grid-cols-1 gap-5 mb-5">
              <!-- Uraian Kegiatan -->
                <div>
                  <label class="block text-gray-700 font-medium mb-1 text-xs md:text-sm">
                    Uraian Kegiatan
                 </label>
               <textarea name="uraian_kegiatan" rows="3" required
             class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
           placeholder="Tuliskan uraian kegiatan secara singkat..."></textarea>
        </div>

          <!-- Jumlah Anggaran -->
            <div>
              <label class="block text-gray-700 font-medium mb-1 text-xs md:text-sm">
             Jumlah Anggaran (Rp)
          </label>

          <!-- Input(format rupiah) -->
            <input type="text" id="format-rupiah" 
              class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Contoh: 15.000.000">

          <!-- Input hidden yang dikirim ke database -->
            <input type="hidden" name="jumlah_anggaran" id="jumlah-anggaran">
              </div>
            </div>
              <!-- Laporan Kegiatan -->
              <div>
                <label class="block text-gray-700 font-medium mb-2 text-xs md:text-sm">Upload Laporan Kegiatan (PDF)</label>
                <div id="file_laporan_preview" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-32 hover:border-blue-500 bg-gray-50"
                     onclick="document.getElementById('file_laporan_input').click()">
                  <svg id="icon_laporan" class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
                  </svg>
                  <p id="text_laporan" class="text-gray-600 text-xs font-medium">Klik untuk unggah file PDF</p>
                  <p class="text-xs text-gray-400">Maks. 10 MB</p>
                  <input type="file" id="file_laporan_input" name="file_laporan" accept=".pdf" required class="hidden">
                </div>
              </div>

              <!-- Laporan Pajak -->
              <div>
                <label class="block text-gray-700 font-medium mb-2 text-xs md:text-sm">Upload Laporan Pajak (PDF)</label>
                <div id="file_pajak_preview" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-32 hover:border-blue-500 bg-gray-50"
                     onclick="document.getElementById('file_pajak_input').click()">
                  <svg id="icon_pajak" class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
                  </svg>
                  <p id="text_pajak" class="text-gray-600 text-xs font-medium">Klik untuk unggah file PDF</p>
                  <p class="text-xs text-gray-400">Maks. 10 MB</p>
                  <input type="file" id="file_pajak_input" name="file_pajak" accept=".pdf" class="hidden">
                </div>
              </div>
            </div>

            <div class="text-right">
              <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium text-sm shadow">
                Upload
              </button>
            </div>
          </form>
        </div>
      </section>

      <!-- RIWAYAT SECTION -->
      <section id="riwayat-section" class="hidden">
        <div class="bg-white rounded-xl shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
            <h2 class="text-lg md:text-2xl font-bold text-gray-800 mb-3 md:mb-0">Riwayat Laporan</h2>
            <input type="text" id="searchInput" placeholder="Cari laporan..." class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm w-full md:w-64">
          </div>

          <!-- Mobile Card Layout -->
          <div class="md:hidden space-y-4">
            @forelse ($riwayat as $item)
              <div class="border rounded-lg p-4 bg-gray-50">
                <div class="text-xs text-gray-600">Tanggal</div>
                <div class="font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</div>

                <div class="text-xs text-gray-600 mt-2">Sub Kegiatan</div>
                <div>{{ $item->kegiatan }}</div>

                <div class="text-xs text-gray-600 mt-2">Uraian Rekening</div>
                <div>{{ $item->sub_kegiatan }}</div>

                <div class="text-sm text-gray-600 mt-2">Uraian Kegiatan</div>
                <div>{{ $item->uraian_kegiatan }}</div>

                <div class="text-sm text-gray-600 mt-2">Jumlah Anggaran</div>
                <div>Rp {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</div>

                <div class="flex flex-wrap gap-2 mt-3">
                  @if($item->file_laporan)
                    <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank"
                      class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-600 text-white rounded text-xs">
                      <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      Lihat Laporan
                    </a>
                  @endif

                  @if($item->file_pajak)
                    <a href="{{ route('laporan.download', ['type' => 'pajak', 'filename' => basename($item->file_pajak)]) }}" target="_blank"
                      class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-600 text-white rounded text-xs">
                      <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      Lihat Pajak
                    </a>
                  @endif
                </div>
              </div>
            @empty
              <div class="text-center py-6 text-gray-500">Belum ada laporan diunggah.</div>
            @endforelse
          </div>

          <!-- Desktop Table -->
          <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
              <thead class="bg-gray-50">
                <tr>
                  <th class="p-3 border-b">Tanggal</th>
                  <th class="p-3 border-b">Sub Kegiatan</th>
                  <th class="p-3 border-b">Uraian Rekening</th>
                  <th class="p-3 border-b">Uraian Kegiatan</th>
                  <th class="p-3 border-b">Jumlah Anggaran</th>
                  <th class="p-3 border-b">File Laporan</th>
                  <th class="p-3 border-b">File Pajak</th>
                  <th class="p-3 border-b">Aksi</th>
                </tr>
              </thead>
              <tbody id="riwayatTable">
                @forelse ($riwayat as $item)
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="p-3">{{ $item->kegiatan }}</td>
                    <td class="p-3">{{ $item->sub_kegiatan }}</td>
                    <td class="p-3">{{ $item->uraian_kegiatan }}</td>
                    <td class="p-3">Rp {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</td>
                    <td class="p-3">
                      @if($item->file_laporan)
                        <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank"
                          class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-600 text-white rounded text-xs">
                          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Lihat
                        </a>
                      @else - @endif
                    </td>
                    <td class="p-3">
                      @if($item->file_pajak)
                        <a href="{{ route('laporan.download', ['type' => 'pajak', 'filename' => basename($item->file_pajak)]) }}" target="_blank"
                          class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-600 text-white rounded text-xs">
                          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Lihat
                        </a>
                      @else - @endif
                      <td class="p-3">
                        <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                          @csrf
                           @method('DELETE')
                           <button type="submit" 
                          class="inline-flex items-center gap-1 px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m5-3v3" />
               </svg>
            Hapus
        </button>
    </form>
    <script>
          document.getElementById('format-rupiah').addEventListener('input', function() {
          let angka = this.value.replace(/[^0-9]/g, '');

          // update hidden input
          document.getElementById('jumlah-anggaran').value = angka;

          // format tampilan
          this.value = new Intl.NumberFormat('id-ID').format(angka);
});
</script>
</td>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="p-6 text-center text-gray-500">Belum ada laporan diunggah.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <script>
            function syncAnggaran() {
            let nilai = document.getElementById('format-rupiah').value.replace(/[^0-9]/g, "");
            document.getElementById('jumlah-anggaran').value = nilai;
          }

            // Jalan saat user mengetik
            document.getElementById('format-rupiah').addEventListener('input', syncAnggaran);

            // Jalan OTOMATIS saat halaman dibuka
            window.addEventListener('DOMContentLoaded', syncAnggaran);
          </script>
      </section>

      <footer class="mt-8 text-center text-gray-500 text-xs">
        <div class="text-center text-gray-600 text-sm">
          © {{ date('Y') }} Sekretariat DPRD Kab Sukabumi — SILANDRA
        <br>
    <span class="text-gray-500">Developed by <b>Muhamad Shalman</b></span>
</div>
      </footer>
    </main>
  </div>

  <!-- MOBILE NAV -->
  <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-2 flex justify-around md:hidden z-10">
    <button onclick="showUpload()" id="btn-upload-mobile" class="flex-1 py-2 text-center text-sm font-medium text-gray-700">
      Upload
    </button>
    <button onclick="showRiwayat()" id="btn-riwayat-mobile" class="flex-1 py-2 text-center text-sm font-medium text-gray-700">
      Riwayat
    </button>
  </div>

  <script>
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

    function updateSubKegiatan() {
      const kegiatan = document.getElementById('kegiatan');
      const sub = document.getElementById('sub_kegiatan');
      const val = kegiatan.value;
      sub.innerHTML = '<option value="">-- Pilih Uraian Rekening --</option>';
      if (uraianOptions[val]) {
        uraianOptions[val].forEach(item => {
          const opt = document.createElement('option');
          opt.value = item;        
          opt.textContent = item;
          sub.appendChild(opt);
        });
      }
    }

    function setActiveButton(isUpload) {
      ['btn-upload', 'btn-riwayat', 'btn-upload-mobile', 'btn-riwayat-mobile'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('text-blue-600', 'font-bold');
      });
      const ids = isUpload ? ['btn-upload', 'btn-upload-mobile'] : ['btn-riwayat', 'btn-riwayat-mobile'];
      ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.add('text-blue-600', 'font-bold');
      });
    }

    function showUpload() {
      document.getElementById('upload-section').classList.remove('hidden');
      document.getElementById('riwayat-section').classList.add('hidden');
      setActiveButton(true);
    }

    function showRiwayat() {
      document.getElementById('riwayat-section').classList.remove('hidden');
      document.getElementById('upload-section').classList.add('hidden');
      setActiveButton(false);
    }

    document.getElementById('kegiatan').addEventListener('change', updateSubKegiatan);

    document.getElementById('searchInput').addEventListener('input', function() {
      const term = this.value.toLowerCase();
      document.querySelectorAll('#riwayatTable tr:not(:first-child)').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
      });
    });

    function updateFilePreview(inputId, previewId, iconId, textId) {
      const input = document.getElementById(inputId);
      const preview = document.getElementById(previewId);
      const icon = document.getElementById(iconId);
      const text = document.getElementById(textId);
      if (!input || !preview || !icon || !text) return;

      input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
          icon.innerHTML = `<svg class="h-8 w-8 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;
          text.textContent = file.name.length > 20 ? file.name.substring(0, 17) + '...' : file.name;
          text.classList.add('text-green-600', 'font-semibold');
          preview.classList.replace('border-gray-300', 'border-green-300');
          preview.classList.replace('bg-gray-50', 'bg-green-50');
          preview.classList.add('border-solid');
        } else {
          icon.innerHTML = `<svg class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" /></svg>`;
          text.textContent = 'Klik untuk unggah file PDF';
          text.classList.remove('text-green-600', 'font-semibold');
          preview.classList.replace('border-green-300', 'border-gray-300');
          preview.classList.replace('bg-green-50', 'bg-gray-50');
          preview.classList.remove('border-solid');
        }
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      updateFilePreview('file_laporan_input', 'file_laporan_preview', 'icon_laporan', 'text_laporan');
      updateFilePreview('file_pajak_input', 'file_pajak_preview', 'icon_pajak', 'text_pajak');
      showRiwayat();
    });
  </script>
</body>
</html>