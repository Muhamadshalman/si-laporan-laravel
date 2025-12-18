<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 p-4 md:p-8">
  <div class="max-w-7xl mx-auto">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div class="flex items-center gap-4">
            <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <div>
              <h1 class="text-2xl md:text-3xl font-bold text-white">RIWAYAT LAPORAN</h1>
              <p class="text-blue-100 text-sm md:text-base mt-1">Kelola dan pantau semua laporan yang telah diunggah</p>
            </div>
          </div>
          
          <!-- Search Box -->
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <input type="text" id="searchInput" 
              placeholder="Cari laporan..." 
              class="w-full md:w-80 pl-11 pr-4 py-3 bg-white/95 backdrop-blur-sm border-2 border-white/20 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-white/50 transition-all">
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards (Optional - menampilkan ringkasan) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Laporan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ count($riwayat) }}</p>
          </div>
          <div class="bg-blue-100 p-3 rounded-lg">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Anggaran</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($riwayat->sum('jumlah_anggaran'), 0, ',', '.') }}</p>
          </div>
          <div class="bg-green-100 p-3 rounded-lg">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Bulan Ini</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $riwayat->where('tanggal', '>=', now()->startOfMonth())->count() }}</p>
          </div>
          <div class="bg-indigo-100 p-3 rounded-lg">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Card Layout -->
    <div class="md:hidden space-y-4">
      @forelse ($riwayat as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow">
          <!-- Card Header -->
          <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-200">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <div class="bg-blue-600 p-1.5 rounded-lg">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
                <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
              </div>
              <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}
              </span>
            </div>
          </div>

          <!-- Card Body -->
          <div class="p-4 space-y-3">
            <div>
              <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Sub Kegiatan
              </div>
              <div class="font-semibold text-gray-800">{{ $item->kegiatan }}</div>
            </div>

            <div>
              <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Uraian Rekening
              </div>
              <div class="text-gray-700 text-sm">{{ $item->sub_kegiatan }}</div>
            </div>

            <div>
              <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Uraian Kegiatan
              </div>
              <div class="text-gray-700 text-sm">{{ $item->uraian_kegiatan }}</div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
              <div class="flex items-center gap-2 text-xs text-green-600 mb-1 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Jumlah Anggaran
              </div>
              <div class="font-bold text-green-700 text-lg">Rp {{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</div>
            </div>
          </div>

          <!-- Card Footer -->
          <div class="bg-gray-50 px-4 py-3 flex flex-wrap gap-2 border-t border-gray-200">
            @if($item->file_laporan)
              <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank"
                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium hover:from-blue-700 hover:to-blue-800 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Laporan
              </a>
            @endif

            @if($item->file_pajak)
              <a href="{{ route('laporan.download', ['type' => 'pajak', 'filename' => basename($item->file_pajak)]) }}" target="_blank"
                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg text-sm font-medium hover:from-green-700 hover:to-green-800 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Pajak
              </a>
            @endif

            <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="flex-none">
              @csrf
              @method('DELETE')
              <button type="submit" 
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
          <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Laporan</h3>
          <p class="text-gray-500">Mulai unggah laporan pertama Anda</p>
        </div>
      @endforelse
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block bg-white rounded-2xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  Tanggal
                </div>
              </th>
              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                  </svg>
                  Sub Kegiatan
                </div>
              </th>
              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Uraian Rekening</th>
              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Uraian Kegiatan</th>
              <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  Anggaran
                </div>
              </th>
              <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">File Laporan</th>
              <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">File Pajak</th>
              <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody id="riwayatTable" class="divide-y divide-gray-200">
            @forelse ($riwayat as $item)
              <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-2">
                    <div class="bg-blue-100 p-2 rounded-lg">
                      <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                      </svg>
                    </div>
                    <div>
                      <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                      <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm font-medium text-gray-900">{{ $item->kegiatan }}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-700">{{ $item->sub_kegiatan }}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-700 max-h-32 overflow-y-auto whitespace-normal break-words">
                  {{ $item->uraian_kegiatan }}
                 </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="inline-flex items-center gap-1 bg-green-50 px-3 py-1.5 rounded-lg border border-green-200">
                    <span class="text-xs font-medium text-green-600">Rp</span>
                    <span class="text-sm font-bold text-green-700">{{ number_format($item->jumlah_anggaran, 0, ',', '.') }}</span>
                  </div>
                </td>
                <td class="px-6 py-4 text-center">
                  @if($item->file_laporan)
                    <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($item->file_laporan)]) }}" target="_blank"
                      class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-xs font-medium hover:from-blue-700 hover:to-blue-800 transition-all shadow-sm">
                      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      Lihat
                    </a>
                  @else 
                    <span class="inline-flex items-center gap-1 text-gray-400 text-xs">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                      </svg>
                      Tidak ada
                    </span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  @if($item->file_pajak)
                    <a href="{{ route('laporan.download', ['type' => 'pajak', 'filename' => basename($item->file_pajak)]) }}" target="_blank"
                      class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg text-xs font-medium hover:from-green-700 hover:to-green-800 transition-all shadow-sm">
                      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      Lihat
                    </a>
                  @else 
                    <span class="inline-flex items-center gap-1 text-gray-400 text-xs">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                      </svg>
                      Tidak ada
                    </span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                      class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-xs font-medium transition-all shadow-sm hover:shadow-md">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-6 py-12 text-center">
                  <div class="flex flex-col items-center justify-center">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                      <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                      </div>
                      <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Laporan</h3>
                      <p class="text-gray-500">Data laporan belum tersedia</p>
                    </div>
                  </td>
                </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Search Script -->
<script>
  document.getElementById('searchInput')?.addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('#riwayatTable tr');

    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(keyword) ? '' : 'none';
    });
  });
</script>
