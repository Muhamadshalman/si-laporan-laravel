<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 p-4 md:p-8">
  <div class="max-w-4xl mx-auto">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 md:p-8">
        <div class="flex items-center gap-4">
          <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">UPLOAD LAPORAN</h1>
            <p class="text-blue-100 text-sm md:text-base mt-1">Unggah laporan kegiatan dan pajak dalam format PDF</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      <form action="{{ route('laporan.store', ['bagian' => $bagian]) }}" 
            method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf

        <!-- Section: Informasi Dasar -->
        <div class="mb-8">
          <div class="flex items-center gap-3 mb-6">
            <div class="bg-blue-100 p-2 rounded-lg">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Informasi Dasar</h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tanggal Kegiatan -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Tanggal Kegiatan
                <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
                <input type="date" name="tanggal" required 
                  class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
              </div>
            </div>

            <!-- Jumlah Anggaran -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Jumlah Anggaran
                <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <span class="text-gray-500 font-medium">Rp</span>
                </div>
                <input type="text" id="format-rupiah" 
                  class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  placeholder="15.000.000">
                <input type="hidden" name="jumlah_anggaran" id="jumlah-anggaran">
              </div>
            </div>
          </div>
        </div>

        <!-- Section: Detail Kegiatan -->
        <div class="mb-8">
          <div class="flex items-center gap-3 mb-6">
            <div class="bg-indigo-100 p-2 rounded-lg">
              <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Detail Kegiatan</h2>
          </div>

          <div class="space-y-6">
            <!-- Sub Kegiatan -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Sub Kegiatan
                <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <select name="kegiatan" id="kegiatan" required 
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                  <option value="">-- Pilih Sub Kegiatan --</option>
                  <option value="pembahasan_kua_ppas">Pembahasan KUA dan PPAS</option>
                  <option value="pembahasan_perubahan_kua_ppas">Pembahasan Perubahan KUA dan Perubahan PPAS</option>
                  <option value="pembahasan_apbd">Pembahasan APBD</option>
                  <option value="pembahasan_apbd_perubahan">Pembahasan APBD Perubahan</option>
                  <option value="pembahasan_laporan_semester">Pembahasan Laporan Semester</option>
                  <option value="pembahasan_pertanggungjawaban_apbd">Pembahasan Pertanggungjawaban APBD</option>
                  <option value="pengawasan_bidang_pemerintahan_hukum">Pengawasan Urusan Pemerintahan Bidang Pemerintahan dan Hukum</option>
                  <option value="pengawasan_bidang_infrastruktur">Pengawasan Urusan Pemerintahan Bidang Infrastruktur</option>
                  <option value="pengawasan_bidang_kesejahteraan_rakyat">Pengawasan Urusan Pemerintahan Bidang Kesejahteraan Rakyat</option>
                  <option value="pengawasan_bidang_perekonomian">Pengawasan Urusan Pemerintahan Bidang Perekonomian</option>
                  <option value="pembahasan_lkpj_kepala_daerah">Pembahasan Laporan Keterangan Pertanggungjawaban Kepala Daerah</option>
                  <option value="kunjungan_kerja_dalam_daerah">Kunjungan Kerja dalam Daerah</option>
                  <option value="penyusunan_pokok_pokok_pikiran_dprd">Penyusunan Pokok-Pokok Pikiran DPRD</option>
                  <option value="pelaksanaan_reses">Pelaksanaan Reses</option>
                  <option value="fasilitasi_tugas_pimpinan_dprd">Fasilitasi Tugas Pimpinan DPRD</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Uraian Rekening -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Uraian Rekening
                <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <select name="sub_kegiatan" id="sub_kegiatan" required 
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                  <option value="">Pilih Uraian Rekening</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Uraian Kegiatan -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Uraian Kegiatan
                <span class="text-red-500">*</span>
              </label>
              <textarea name="uraian_kegiatan" rows="4" required
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                placeholder="Tuliskan uraian kegiatan secara detail dan lengkap..."></textarea>
            </div>
          </div>
        </div>

        <!-- Section: Upload Dokumen -->
        <div class="mb-8">
          <div class="flex items-center gap-3 mb-6">
            <div class="bg-green-100 p-2 rounded-lg">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
              </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Upload Dokumen</h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Laporan Kegiatan -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Laporan Kegiatan (PDF)
                <span class="text-red-500">*</span>
              </label>
              <div id="file_laporan_preview" 
                   class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer transition-all hover:border-blue-500 hover:bg-blue-50/50"
                   onclick="document.getElementById('file_laporan_input').click()">
                <div class="bg-blue-100 p-3 rounded-full mb-3 group-hover:bg-blue-200 transition-colors">
                  <svg id="icon_laporan" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                </div>
                <p id="text_laporan" class="text-gray-700 text-sm font-medium mb-1">Klik untuk upload file</p>
                <p class="text-xs text-gray-500">PDF, maksimal 10 MB</p>
                <input type="file" id="file_laporan_input" name="file_laporan" accept=".pdf" required class="hidden">
              </div>
            </div>

            <!-- Laporan Pajak -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                Laporan Pajak (PDF)
              </label>
              <div id="file_pajak_preview" 
                   class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer transition-all hover:border-green-500 hover:bg-green-50/50"
                   onclick="document.getElementById('file_pajak_input').click()">
                <div class="bg-green-100 p-3 rounded-full mb-3 group-hover:bg-green-200 transition-colors">
                  <svg id="icon_pajak" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                </div>
                <p id="text_pajak" class="text-gray-700 text-sm font-medium mb-1">Klik untuk upload file</p>
                <p class="text-xs text-gray-500">PDF, maksimal 10 MB</p>
                <input type="file" id="file_pajak_input" name="file_pajak" accept=".pdf" class="hidden">
              </div>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t-2 border-gray-100">
          <button type="button" 
                  class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-semibold text-sm transition-all">
            Batal
          </button>
          <button type="submit" 
                  class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 font-semibold text-sm shadow-lg shadow-blue-500/30 transition-all transform hover:scale-105">
            <span class="flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
              </svg>
              Upload Laporan
            </span>
          </button>
        </div>
      </form>
    </div>

    <!-- Info Footer -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
      <div class="flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="text-sm text-blue-800">
          <p class="font-semibold mb-1">Informasi Penting:</p>
          <ul class="list-disc list-inside space-y-1 text-blue-700">
            <li>Pastikan semua file dalam format PDF</li>
            <li>Ukuran maksimal setiap file adalah 10 MB</li>
            <li>Isi semua field yang bertanda bintang (*)</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Format Rupiah
const formatRupiah = document.getElementById('format-rupiah');
const jumlahAnggaran = document.getElementById('jumlah-anggaran');

formatRupiah.addEventListener('keyup', function(e) {
  let value = this.value.replace(/[^,\d]/g, '');
  let split = value.split(',');
  let sisa = split[0].length % 3;
  let rupiah = split[0].substr(0, sisa);
  let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    let separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
  this.value = rupiah;
  jumlahAnggaran.value = value;
});

// File Upload Preview
function setupFilePreview(inputId, previewId, textId, iconId) {
  const input = document.getElementById(inputId);
  const preview = document.getElementById(previewId);
  const text = document.getElementById(textId);
  const icon = document.getElementById(iconId);

  input.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      text.textContent = file.name;
      preview.classList.add('border-green-500', 'bg-green-50');
      icon.classList.remove('text-gray-400');
      icon.classList.add('text-green-600');
    }
  });
}

setupFilePreview('file_laporan_input', 'file_laporan_preview', 'text_laporan', 'icon_laporan');
setupFilePreview('file_pajak_input', 'file_pajak_preview', 'text_pajak', 'icon_pajak');
</script>