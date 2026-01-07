<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Laporan - {{ strtoupper($bagian) }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen">

  <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
    <a href="{{ route('welcome') }}" class="flex items-center gap-3">
      <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-10 h-10" alt="Logo">
      <div>
        <div class="font-bold text-lg">SILANDRA</div>
        <div class="text-xs text-gray-500">Sekretariat DPRD</div>
      </div>
    </a>

    <div class="mt-2 md:mt-0">
      @if(session('role') === 'superadmin')
        <a href="{{ route('superadmin.dashboard') }}" title="Kembali ke Dashboard" class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-md text-sm text-blue-600 hover:bg-gray-50 shadow-sm whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          <span>Kembali ke Dashboard</span>
        </a>
      @elseif(session('bagian'))
        <a href="{{ route('dashboard', session('bagian')) }}" title="Kembali ke Dashboard" class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-md text-sm text-blue-600 hover:bg-gray-50 shadow-sm whitespace-nowrap">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          <span>Kembali ke Dashboard</span>
        </a>
      @endif
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-6 py-12">
    <style>
      @media print { .no-print { display: none !important; } }
    </style>

    <div class="bg-gradient-to-r from-white to-slate-50 rounded-lg p-6 shadow-sm border mb-4 no-print">
      <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
          <h1 class="text-2xl font-extrabold mb-1">Cetak Rincian Laporan <span class="text-blue-700">— {{ ucfirst($bagian) }}</span></h1>
          <p class="text-sm text-gray-500">Ekspor dan cetak laporan untuk bagian ini. Gunakan kotak pencarian untuk mempersempit hasil.</p>
        </div>

        <div class="flex items-center gap-3">
          <form method="GET" action="{{ route('dashboard.cetak', $bagian) }}" class="flex items-center gap-2 flex-wrap">
            <div class="relative">
              <svg class="absolute left-3 top-2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path></svg>
              <input type="text" name="q" value="{{ request('q') ?? $q ?? '' }}" placeholder="Cari laporan..." class="pl-10 pr-3 py-2 border rounded-md text-sm w-64" />
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">Cari</button>
            <a href="{{ route('dashboard.cetak', $bagian) }}" class="px-3 py-2 bg-white border rounded-md text-sm">Reset</a>
            @if(session('role') === 'superadmin')
              <button type="button" onclick="showDateFilterModal('xlsx')" class="px-3 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">Download .xlsx</button>
              <button type="button" onclick="showDateFilterModal('csv')" class="px-3 py-2 bg-gray-100 border rounded-md text-sm hover:bg-gray-200">Download .csv</button>
            @endif
          </form>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
      @if($laporans->isEmpty())
        <p class="text-sm text-gray-600">Tidak ada laporan untuk dicetak.</p>
      @else
        <div class="mb-4 text-sm text-gray-600">Menampilkan <strong>{{ $laporans->count() }}</strong> laporan</div>
        <div class="grid gap-3">
          @foreach($laporans as $lap)
            <div class="flex flex-col md:flex-row md:items-center md:justify-between border rounded p-4 shadow-sm">
              <div class="flex-1">
                <div class="font-medium text-gray-800">{{ $lap->kegiatan }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $lap->tanggal }} — <span class="font-semibold">{{ $lap->sub_kegiatan }}</span> — Rp {{ number_format($lap->jumlah_anggaran ?? 0, 0, ',', '.') }}</div>
                @if($lap->uraian_kegiatan)
                  <div class="text-xs text-gray-500 mt-2">{{ Str::limit($lap->uraian_kegiatan, 150) }}</div>
                @endif
              </div>

              <div class="flex items-center gap-2 mt-3 md:mt-0 no-print">
                @if($lap->file_laporan)
                  <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($lap->file_laporan)]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm shadow-sm">Unduh</a>
                @else
                  <span class="text-xs text-gray-400">Tidak ada file</span>
                @endif
                <button onclick="window.open('{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($lap->file_laporan)]) }}','_blank')" class="px-4 py-2 bg-gray-100 border rounded-md text-sm">Buka</button>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>

  </div>

  <!-- Modal Filter Tanggal -->
  <div id="dateFilterModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-lg rounded-lg bg-white">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Filter Tanggal Laporan</h3>
        <button onclick="closeDateFilterModal()" class="text-gray-400 hover:text-gray-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <form id="downloadForm" method="GET">
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              Tanggal Mulai
            </label>
            <input type="date" name="start_date" id="start_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              Tanggal Akhir
            </label>
            <input type="date" name="end_date" id="end_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
          </div>

          <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
            <p class="text-xs text-blue-800">
              <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Pilih rentang tanggal untuk mengekspor laporan dalam periode tertentu.
            </p>
          </div>
        </div>

        <div class="flex gap-3 mt-6">
          <button type="button" onclick="closeDateFilterModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition">
            Batal
          </button>
          <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition">
            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Download
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    let currentExportType = 'xlsx';

    function showDateFilterModal(type) {
      const modal = document.getElementById('dateFilterModal');
      const form = document.getElementById('downloadForm');
      
      // Simpan tipe export
      currentExportType = type === 'csv' ? 'excel' : 'xlsx';
      
      // Set form action dan method
      form.action = "{{ route('dashboard.cetak', $bagian) }}";
      form.method = "GET";
      
      // Tambahkan hidden input untuk export type jika belum ada
      let exportInput = form.querySelector('input[name="export"]');
      if (!exportInput) {
        exportInput = document.createElement('input');
        exportInput.type = 'hidden';
        exportInput.name = 'export';
        form.appendChild(exportInput);
      }
      exportInput.value = currentExportType;
      
      // Set tanggal default (bulan ini)
      const today = new Date();
      const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
      const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
      
      document.getElementById('start_date').value = firstDay.toISOString().split('T')[0];
      document.getElementById('end_date').value = lastDay.toISOString().split('T')[0];
      
      modal.classList.remove('hidden');
    }

    function closeDateFilterModal() {
      const modal = document.getElementById('dateFilterModal');
      modal.classList.add('hidden');
    }

    // Tutup modal jika klik di luar modal
    window.onclick = function(event) {
      const modal = document.getElementById('dateFilterModal');
      if (event.target === modal) {
        closeDateFilterModal();
      }
    }

    // Validasi tanggal
    document.getElementById('downloadForm').addEventListener('submit', function(e) {
      const startDate = new Date(document.getElementById('start_date').value);
      const endDate = new Date(document.getElementById('end_date').value);
      
      if (startDate > endDate) {
        e.preventDefault();
        alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir!');
        return false;
      }
      
      // Form akan submit secara normal dengan method GET
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeDateFilterModal();
      }
    });
  </script>

</body>
</html>