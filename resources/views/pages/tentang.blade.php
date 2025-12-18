<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang SILANDRA | Sekretariat DPRD Kab. Sukabumi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-gray-800">

<!-- NAVBAR -->
<header class="bg-white shadow-sm fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-10" alt="Logo">
      <span class="font-bold text-lg">SILANDRA</span>
    </div>
    <nav class="hidden md:flex gap-8 text-sm font-medium">
  <a href="{{ route('welcome') }}" class="hover:text-blue-700">Beranda</a>
  <a href="{{ route('tentang') }}" class="hover:text-blue-700">Tentang</a>
  <a href="{{ route('informasi') }}" class="hover:text-blue-700">Informasi</a>
</nav>

  </div>
</header>

<!-- HERO -->
<section class="pt-32 pb-24 relative bg-cover bg-center"
    style="background-image: url('{{ asset('images/gedungdprd.png') }}');">

  <!-- Overlay gelap -->
  <div class="absolute inset-0 bg-black/60"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-6 text-center text-white">
    <span class="inline-block bg-white/20 text-white text-xs font-semibold px-4 py-1 rounded-full mb-4 backdrop-blur">
      Profil Sistem
    </span>

    <h1 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow-lg">
      Tentang SILANDRA
    </h1>

    <p class="max-w-3xl mx-auto text-gray-200">
      SILANDRA (Sistem Laporan Administrasi dan Arsip Digital) merupakan sistem informasi
      yang dikembangkan untuk mendukung pengelolaan administrasi dan kearsipan
      di lingkungan Sekretariat DPRD Kabupaten Sukabumi.
    </p>
  </div>
</section>


<!-- VISI MISI -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-14">

    <div class="bg-white p-8 rounded-2xl shadow">
      <h2 class="text-2xl font-bold mb-4 text-blue-800">Visi</h2>
      <p class="text-gray-600 leading-relaxed">
        Terwujudnya sistem administrasi dan kearsipan Sekretariat DPRD Kabupaten Sukabumi
        yang modern, tertib, transparan, dan berbasis teknologi informasi.
      </p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow">
      <h2 class="text-2xl font-bold mb-4 text-blue-800">Misi</h2>
      <ul class="space-y-3 text-gray-600">
        <li>• Meningkatkan efisiensi pengelolaan laporan dan arsip secara digital</li>
        <li>• Mendukung tertib administrasi di seluruh bagian Sekretariat DPRD</li>
        <li>• Menjamin keamanan dan keakuratan data dokumen</li>
        <li>• Mendorong transparansi dan akuntabilitas administrasi</li>
      </ul>
    </div>

  </div>
</section>

<!-- STRUKTUR BAGIAN -->
<section class="bg-white py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <h2 class="text-3xl font-extrabold mb-3">STRUKTUR BAGIAN PENGGUNA</h2>
      <p class="text-gray-600">Pembagian akses sistem SILANDRA sesuai fungsi Sekretariat DPRD</p>
    </div>

    <div class="grid md:grid-cols-4 gap-8">

      <div class="p-6 rounded-2xl shadow bg-slate-50 text-center">
        <div class="text-3xl mb-3">🏢</div>
        <h3 class="font-bold mb-2">Bagian Umum</h3>
        <p class="text-sm text-gray-600">Mengelola surat, arsip umum, dan administrasi perkantoran.</p>
      </div>

      <div class="p-6 rounded-2xl shadow bg-slate-50 text-center">
        <div class="text-3xl mb-3">💰</div>
        <h3 class="font-bold mb-2">Bagian Keuangan</h3>
        <p class="text-sm text-gray-600">Mengelola laporan anggaran, keuangan, dan administrasi belanja.</p>
      </div>

      <div class="p-6 rounded-2xl shadow bg-slate-50 text-center">
        <div class="text-3xl mb-3">📜</div>
        <h3 class="font-bold mb-2">Bagian Persidangan</h3>
        <p class="text-sm text-gray-600">Mengelola arsip rapat, risalah, dan dokumen persidangan.</p>
      </div>

      <div class="p-6 rounded-2xl shadow bg-slate-50 text-center">
        <div class="text-3xl mb-3">🤝</div>
        <h3 class="font-bold mb-2">Bagian Fasilitasi</h3>
        <p class="text-sm text-gray-600">Mendukung kegiatan DPRD dan fasilitasi anggota dewan.</p>
      </div>

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
