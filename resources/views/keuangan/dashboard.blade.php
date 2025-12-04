<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Keuangan - Sekretariat DPRD</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <x-header></x-header>

  <div class="flex min-h-screen">
    <!-- SIDEBAR -->
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

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

      <!-- NOTIFIKASI -->
      @if(session('success'))
        <div class="fixed top-4 right-6 bg-green-500 text-white px-5 py-2.5 rounded-lg shadow-lg z-50">
          {{ session('success') }}
        </div>
        <script>setTimeout(() => document.querySelector('.fixed.top-4')?.remove(), 4000);</script>
      @endif

      <!-- UPLOAD SECTION -->
      <section id="upload-section" class="hidden">
        <div class="bg-white rounded-2xl shadow-lg p-6 max-w-4xl mx-auto">
          <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800 tracking-wider">UPLOAD LAPORAN</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan isi data laporan dan unggah file dalam format PDF.</p>
          </div>

          <form action="{{ route('laporan.store', ['bagian' => session('bagian')]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
              <div>
                <label class="block text-gray-700 font-medium mb-1.5 text-sm">Tanggal Kegiatan</label>
                <input type="date" name="tanggal" required class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:outline-none">
              </div>

              <div>
                <label class="block text-gray-700 font-medium mb-1.5 text-sm">Pilih Sub Kegiatan</label>
                <select name="kegiatan" id="kegiatan" required class="w-full border border-gray-300 rounded-lg p-3 text-sm appearance-none bg-white focus:ring-blue-500 focus:outline-none">
                  <option value="">-- Pilih Sub Kegiatan --</option>
                  <option value="Penyusunan_Dokumen_Perencanaan_Perangkat_Daerah">Penyusunan Dokumen Perencanaan Perangkat Daerah</option>
                  <option value="Koordinasi_dan_Penyusunan_Dokumen_RKA_SKPD">Koordinasi dan Penyusunan Dokumen RKA-SKPD</option>
                  <option value="Koordinasi_dan_Penyusunan_Dokumen_Perubahan_RKA_SKPD">Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD</option>
                  <option value="Koordinasi_dan_Penyusunan_DPA_SKPD">Koordinasi dan Penyusunan DPA-SKPD</option>
                  <option value="Koordinasi_dan_Penyusunan_Perubahan_DPA_SKPD">Koordinasi dan Penyusunan Perubahan DPA-SKPD</option>
                  <option value="Koordinasi_dan_Penyusunan_Laporan_Capaian_Kinerja_dan_Ikhtisar_Realisasi_Kinerja_SKPD">Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD</option>
                  <option value="Evaluasi_Kinerja_Perangkat_Daerah">Evaluasi Kinerja Perangkat Daerah</option>
                  <option value="Penyediaan_Gaji_dan_Tunjangan_ASN">Penyediaan Gaji dan Tunjangan ASN</option>
                  <option value="Pelaksanaan_Penatausahaan_dan_Pengujian_Verifikasi_Keuangan_SKPD">Pelaksanaan Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD</option>
                  <option value="Koordinasi_dan_Pelaksanaan_Akuntansi_SKPD">Koordinasi dan Pelaksanaan Akuntansi SKPD</option>
                  <option value="Koordinasi_dan_Penyusunan_Laporan_Keuangan_Bulanan_Triwulanan_Semesteran_SKPD">Koordinasi dan Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD</option>
                  <option value="Penyusunan_Pelaporan_dan_Analisis_Prognosis_Realisasi_Anggaran">Penyusunan Pelaporan dan Analisis Prognosis Realisasi Anggaran</option>
                  <option value="Penyelenggaraan_Administrasi_Keuangan_DPRD">Penyelenggaraan Administrasi Keuangan DPRD</option>
                </select>
              </div>
            </div>

            <div class="mb-5 mt-5">
              <label class="block text-gray-700 font-medium mb-1.5 text-sm">Pilih Uraian Rekening</label>
              <select name="sub_kegiatan" id="sub_kegiatan" required class="w-full border border-gray-300 rounded-lg p-3 text-sm appearance-none bg-white focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Sub Kegiatan dulu --</option>
              </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
              <!-- Laporan Kegiatan -->
              <div>
                <label class="block text-gray-700 font-medium mb-1.5 text-sm">Upload Laporan Kegiatan (PDF)</label>
                <div id="file_laporan_preview" class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-40 hover:border-blue-500 transition duration-150 bg-gray-50"
                     onclick="document.getElementById('file_laporan_input').click()">
                  <svg id="icon_laporan" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
                  </svg>
                  <p id="text_laporan" class="text-gray-600 text-sm font-medium">Klik untuk unggah file PDF</p>
                  <p class="text-xs text-gray-400 mt-1">Maksimal 10 MB</p>
                  <input type="file" id="file_laporan_input" name="file_laporan" accept=".pdf" required class="hidden">
                </div>
              </div>

              <!-- Laporan Pajak -->
              <div>
                <label class="block text-gray-700 font-medium mb-1.5 text-sm">Upload Laporan Pajak (PDF)</label>
                <div id="file_pajak_preview" class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer h-40 hover:border-blue-500 transition duration-150 bg-gray-50"
                     onclick="document.getElementById('file_pajak_input').click()">
                  <svg id="icon_pajak" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
                  </svg>
                  <p id="text_pajak" class="text-gray-600 text-sm font-medium">Klik untuk unggah file PDF</p>
                  <p class="text-xs text-gray-400 mt-1">Maksimal 10 MB</p>
                  <input type="file" id="file_pajak_input" name="file_pajak" accept=".pdf" class="hidden">
                </div>
              </div>
            </div>

            <div class="text-right pt-8">
              <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 font-medium">
                Upload
              </button>
            </div>
          </form>
        </div>
      </section>

      <!-- RIWAYAT SECTION -->
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
                        <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs font-medium">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Lihat
                        </a>
                        
                      @else
                        -
                      @endif
                    </td>
                    <td class="p-3">
                      @if($item->file_pajak)
                        <a href="{{ route('laporan.download', ['type' => 'pajak', 'filename' => basename($item->file_pajak)]) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs font-medium">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Lihat
                        </a>
                        
                      @else
                        -
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada laporan diunggah.</td>
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

  <!-- JAVASCRIPT -->
  <script>
    const uraianOptions = {
      Penyusunan_Dokumen_Perencanaan_Perangkat_Daerah: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Sewa Bangunan Gedung Tempat Pertemuan",
        "Belanja Jasa Konsultansi Berorientasi Layanan-Jasa Khusus",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Dokumen_RKA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Dokumen_Perubahan_RKA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_DPA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Perubahan_DPA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Laporan_Capaian_Kinerja_dan_Ikhtisar_Realisasi_Kinerja_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Evaluasi_Kinerja_Perangkat_Daerah: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat"
      ],
      Penyediaan_Gaji_dan_Tunjangan_ASN: [
        "Belanja Gaji Pokok PNS", "Belanja Gaji Pokok PPPK", 
        "Belanja Tunjangan Keluarga PNS", "Belanja Tunjangan Keluarga PPPK",
        "Belanja Tunjangan Jabatan PNS", "Belanja Tunjangan Fungsional PNS",
        "Belanja Tunjangan Fungsional PPPK", "Belanja Tunjangan Fungsional Umum PNS",
        "Belanja Tunjangan Beras PNS", "Belanja Tunjangan Beras PPPK",
        "Belanja Tunjangan PPh/Tunjangan Khusus PNS", "Belanja Tunjangan PPh/Tunjangan Khusus PPPK",
        "Belanja Pembulatan Gaji PNS", "Belanja Pembulatan Gaji PPPK",
        "Belanja Iuran Jaminan Kecelakaan Kerja PNS", "Belanja Iuran Jaminan Kecelakaan Kerja PPPK",
        "Belanja Iuran Jaminan Kematian PNS", "Belanja Iuran Jaminan Kematian PPPK",
        "Tambahan Penghasilan berdasarkan Beban Kerja PNS",
        "Tambahan Penghasilan berdasarkan Beban Kerja PPPK",
        "Tambahan Penghasilan berdasarkan Kondisi Kerja PNS",
        "Tambahan Penghasilan berdasarkan Prestasi Kerja PNS",
        "Belanja Dana Operasional Pimpinan DPRD"
      ],
      Pelaksanaan_Penatausahaan_dan_Pengujian_Verifikasi_Keuangan_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Pelaksanaan_Akuntansi_SKPD: [
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Laporan_Keuangan_Bulanan_Triwulanan_Semesteran_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Penyusunan_Pelaporan_dan_Analisis_Prognosis_Realisasi_Anggaran: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Penyelenggaraan_Administrasi_Keuangan_DPRD: [
        "Belanja Uang Representasi DPRD",
        "Belanja Tunjangan Keluarga DPRD",
        "Belanja Tunjangan Beras DPRD",
        "Belanja Uang Paket DPRD",
        "Belanja Tunjangan Jabatan DPRD",
        "Belanja Tunjangan Alat Kelengkapan DPRD",
        "Belanja Tunjangan Alat Kelengkapan Lainnya DPRD",
        "Belanja Tunjangan Komunikasi Intensif Pimpinan dan Anggota DPRD",
        "Belanja Tunjangan Reses DPRD",
        "Belanja Pembebanan PPh kepada Pimpinan dan Anggota DPRD",
        "Belanja Pembulatan Gaji DPRD",
        "Belanja Iuran Jaminan Kesehatan bagi DPRD",
        "Belanja Jaminan Kecelakaan Kerja DPRD",
        "Belanja Jaminan Kematian DPRD",
        "Belanja Tunjangan Perumahan DPRD",
        "Belanja Tunjangan Transportasi DPRD",
        "Belanja Uang Jasa Pengabdian DPRD"
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

    document.getElementById('kegiatan').addEventListener('change', updateSubKegiatan);

    // Tab switch
    function showUpload() {
      document.getElementById('upload-section').classList.remove('hidden');
      document.getElementById('riwayat-section').classList.add('hidden');
      document.getElementById('btn-upload').classList.add('bg-gray-700', 'text-white');
      document.getElementById('btn-riwayat').classList.remove('bg-gray-700', 'text-white');
    }

    function showRiwayat() {
      document.getElementById('riwayat-section').classList.remove('hidden');
      document.getElementById('upload-section').classList.add('hidden');
      document.getElementById('btn-riwayat').classList.add('bg-gray-700', 'text-white');
      document.getElementById('btn-upload').classList.remove('bg-gray-700', 'text-white');
    }

    // Pencarian
    document.getElementById('searchInput').addEventListener('input', function () {
      const term = this.value.toLowerCase();
      document.querySelectorAll('#riwayatTable tr:not(:first-child)').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    });

    // Preview file
    function updateFilePreview(inputId, previewId, iconId, textId) {
      const input = document.getElementById(inputId);
      const preview = document.getElementById(previewId);
      const icon = document.getElementById(iconId);
      const text = document.getElementById(textId);
      if (!input || !preview || !icon || !text) return;

      input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
          icon.innerHTML = `<svg class="h-10 w-10 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;
          text.textContent = file.name.length > 25 ? file.name.substring(0, 22) + '...' : file.name;
          text.classList.add('text-green-600', 'font-semibold');
          preview.classList.remove('bg-gray-50', 'border-dashed', 'border-gray-300');
          preview.classList.add('bg-green-50', 'border-solid', 'border-green-300');
        } else {
          icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" /></svg>`;
          text.textContent = 'Klik untuk unggah file PDF';
          text.classList.remove('text-green-600', 'font-semibold');
          preview.classList.add('bg-gray-50', 'border-dashed', 'border-gray-300');
          preview.classList.remove('bg-green-50', 'border-solid', 'border-green-300');
        }
      });
    }

    // Init
    document.addEventListener('DOMContentLoaded', () => {
      updateSubKegiatan();
      updateFilePreview('file_laporan_input', 'file_laporan_preview', 'icon_laporan', 'text_laporan');
      updateFilePreview('file_pajak_input', 'file_pajak_preview', 'icon_pajak', 'text_pajak');
      showRiwayat();
    });
  </script>
</body>
</html>