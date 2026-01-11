<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Laporan - {{ strtoupper($bagian) }}</title>
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
    <div class="bg-gradient-to-r from-white to-slate-50 rounded-lg p-6 shadow-sm border">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-extrabold mb-1">Validasi Laporan <span class="text-blue-700">— {{ ucfirst($bagian) }}</span></h1>
          <p class="text-sm text-gray-500">Kelola dan validasi laporan yang masuk untuk bagian ini.</p>
        </div>

        <div class="text-sm text-gray-600 flex gap-6">
          <div>Total: <span class="font-medium text-gray-800">{{ $laporans->count() }}</span></div>
          <div>Tervalidasi: <span class="font-medium text-green-600">{{ $laporans->where('is_valid', true)->count() }}</span></div>
          <div>Belum: <span class="font-medium text-yellow-600">{{ $laporans->where('is_valid', false)->count() }}</span></div>
        </div>
      </div>

      <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <form method="GET" action="{{ route('dashboard.validasi', $bagian) }}" class="flex items-center gap-2 w-full md:w-auto">
          <div class="relative w-full md:w-80">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            <input type="text" name="q" value="{{ request('q') ?? $q ?? '' }}" placeholder="Cari laporan (tanggal/kegiatan/nama file)..." class="pl-10 pr-3 py-2 border rounded-md text-sm w-full" />
          </div>

          <div class="flex items-center gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm shadow-sm">Cari</button>
            <a href="{{ route('dashboard.validasi', $bagian) }}" class="px-4 py-2 bg-white border rounded-md text-sm">Reset</a>
          </div>
        </form>
      </div>
    </div>
      @if(session('success'))
        <div class="mb-3 p-3 rounded bg-green-50 text-green-800">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="mb-3 p-3 rounded bg-red-50 text-red-800">{{ session('error') }}</div>
      @endif

      @if($laporans->isEmpty())
        <p class="text-sm text-gray-600">Tidak ada laporan untuk divalidasi.</p>
      @else
        <div class="overflow-x-auto">
          <table class="w-full text-sm min-w-[640px] divide-y">
            <thead class="bg-gray-50">
              <tr class="text-left text-gray-600">
                <th class="py-3 px-4">Tanggal</th>
                <th class="py-3 px-4">Kegiatan</th>
                <th class="py-3 px-4">File</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach($laporans as $lap)
                <tr class="hover:bg-gray-50">
                  <td class="py-3 px-4 align-top">{{ $lap->tanggal }}</td>
                  <td class="py-3 px-4 align-top">{{ $lap->kegiatan }}
                    @if($lap->uraian_kegiatan)
                      <div class="text-xs text-gray-400 mt-1">{{ Str::limit($lap->uraian_kegiatan, 100) }}</div>
                    @endif
                  </td>
                  <td class="py-3 px-4 align-top">
                    @if($lap->file_laporan)
                      <a href="{{ route('laporan.download', ['type' => 'laporan', 'filename' => basename($lap->file_laporan)]) }}" class="text-blue-600 hover:underline">{{ $lap->nama_file_laporan ?? basename($lap->file_laporan) }}</a>
                    @else
                      <span class="text-gray-400">Tidak ada file</span>
                    @endif
                  </td>
                  <td class="py-3 px-4 align-top">
                    @if($lap->is_valid)
                      <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-green-100 text-green-800 text-xs">Tervalidasi</span>
                    @else
                      <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs">Belum</span>
                    @endif
                  </td>
                  <td class="py-3 px-4 align-top">
                    @if(!$lap->is_valid)
                      <form action="{{ route('laporan.validate', ['bagian' => $bagian, 'id' => $lap->id]) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded bg-green-600 text-white text-xs hover:bg-green-700" onclick="return confirm('Validasi laporan ini?')">Validasi</button>
                      </form>
                    @else
                      <button class="px-3 py-1 rounded bg-gray-100 text-gray-800 text-xs" disabled>Tervalidasi</button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>


      @endif
    </div>

  </div>
</body>
</html>