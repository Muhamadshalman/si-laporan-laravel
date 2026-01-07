<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SILANDRA | Sekretariat DPRD Kab. Sukabumi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-gray-800">

@include('partials.navbar')

<!-- HERO SECTION -->
<section class="pt-32 pb-24">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-14 items-center">

    <!-- TEXT -->
    <div>
      <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-4 py-1 rounded-full mb-4">
        Sistem Informasi Resmi
      </span>
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
        Sistem Laporan Administrasi & Arsip Digital<br>
        <span class="text-blue-800">Sekretariat DPRD Kabupaten Sukabumi</span>
      </h1>
      <p class="text-gray-600 mb-8 max-w-xl">
        SILANDRA mendukung pengelolaan laporan administrasi dan arsip digital secara
        transparan, terstruktur, dan terintegrasi antar bagian.
      </p>
      <div class="flex gap-4">
        <a href="{{ route('login') }}" class="bg-blue-800 hover:bg-blue-900 text-white px-8 py-3 rounded-full font-semibold shadow">
          Masuk Sistem
        </a>
        <a href="#" class="border border-blue-800 text-blue-800 px-8 py-3 rounded-full font-semibold hover:bg-blue-50">
          Pelajari
        </a>
      </div>
    </div>

   <!-- VISUAL GEDUNG DPRD / ARSIP DIGITAL -->
<div class="relative flex justify-center md:justify-end">
<div class="rounded-2xl overflow-hidden shadow-lg w-full max-w-xl">
<img src="{{ asset('images/dprd.png') }}" alt="Gedung DPRD Kabupaten Sukabumi" class="w-full h-80 object-cover">
</div>
<!-- Overlay label -->
<div class="absolute -bottom-4 left-4 bg-white/95 backdrop-blur px-4 py-2 rounded-xl shadow">
<p class="text-xs font-semibold text-blue-800">Sekretariat DPRD Kab. Sukabumi</p>
<p class="text-[11px] text-gray-600">Arsip & Laporan Digital</p>
</div>
</div>


</div>
</section>


</div>
</section>

<!-- FOOTER -->
<footer class="bg-slate-900 text-gray-300">
  <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-6">
    <div>
      <h4 class="font-bold text-white mb-2">Sekretariat DPRD Kabupaten Sukabumi</h4>
      <p class="text-sm">Jl. Jend. Sudirman Komplek Perkantoran Jajaway<br>Palabuhanratu 43364</p>
    </div>
    <div class="md:text-right">
      <p class="text-sm">Instagram: @dprdkabupatensukabumi</p>
      <p class="text-sm">Email: dprd@kabupatensukabumi.go.id</p>
    </div>
  </div>
  <div class="flex flex-col items-center justify-center text-center gap-1 pb-6">
    <div class="text-xs text-gray-400">
        © {{ date('Y') }} Sekretariat DPRD Kab Sukabumi — SILANDRA
    </div>
    <span class="text-xs text-gray-500">
        Developed by <b class="text-gray-300">Muhamad Shalman</b>
    </span>
</div>
</footer>
</html>
