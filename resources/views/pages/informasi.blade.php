<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi SILANDRA | Sekretariat DPRD Kab. Sukabumi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-gray-800">

<!-- NAVBAR -->
<header class="bg-white shadow-sm fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-10">
      <span class="font-bold text-lg">SILANDRA</span>
    </div>
    <nav class="hidden md:flex gap-8 text-sm font-medium">
      <a href="{{ route('welcome') }}" class="hover:text-blue-700">Beranda</a>
      <a href="{{ route('tentang') }}" class="hover:text-blue-700">Tentang</a>
      <a href="{{ route('informasi') }}" class="text-blue-700">Informasi</a>
    </nav>
  </div>
</header>

<!-- HERO -->
<section class="pt-32 pb-24 relative bg-cover bg-center"
    style="background-image: url('{{ asset('images/gedungdprd.png') }}');">

  <!-- Overlay gelap -->
  <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center text-white">
    <span class="inline-block bg-gray-100 text-yellow-700 text-xs font-semibold px-4 py-1 rounded-full mb-4">
      Informasi Sistem
    </span>
    <h1 class="text-4xl md:text-5xl font-extrabold mb-6">
      Informasi SILANDRA
    </h1>
    <p class="max-w-3xl mx-auto text-white-600">
      Halaman ini memuat informasi penggunaan, akses sistem, dan ketentuan
      pengelolaan laporan dan arsip digital di Sekretariat DPRD Kabupaten Sukabumi.
    </p>
  </div>
</section>

<!-- KONTEN INFORMASI -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-10">

    <div class="bg-white p-6 rounded-2xl shadow">
      <h3 class="font-bold text-blue-800 mb-2">📌 Tujuan Sistem</h3>
      <p class="text-sm text-gray-600">
        Mendukung tertib administrasi dan digitalisasi arsip secara terpusat.
      </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
      <h3 class="font-bold text-blue-800 mb-2">🔐 Hak Akses</h3>
      <p class="text-sm text-gray-600">
        Akses sistem dibagi berdasarkan bagian: Umum, Keuangan, Persidangan, dan Fasilitasi.
      </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
      <h3 class="font-bold text-blue-800 mb-2">📂 Jenis Arsip</h3>
      <p class="text-sm text-gray-600">
        Surat, laporan kegiatan, dokumen keuangan, dan arsip persidangan DPRD.
      </p>
    </div>

  </div>
</section>

<!-- FOOTER -->
<footer class="bg-slate-900 text-gray-300">
  <div class="max-w-7xl mx-auto px-6 py-10 text-center">
    <p class="text-xs">© {{ date('Y') }} Sekretariat DPRD Kab. Sukabumi — SILANDRA</p>
    <p class="text-xs text-gray-400 mt-1">Developed by <b>Muhamad Shalman</b></p>
  </div>
</footer>

</body>
</html>
