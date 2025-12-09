<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILANDRA - Sekretariat DPRD Kab. Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animasi profesional */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade {
            animation: fadeInUp 1s ease-out;
        }
    </style>
</head>

<body class="min-h-screen flex bg-gray-100">

    <!-- BAGIAN KIRI -->
    <div class="w-1/2 bg-white flex flex-col justify-center items-center p-12 animate-fade shadow-xl relative">

        <img src="{{ asset('images/logo_sukabumi3.png') }}" 
             alt="Logo Sukabumi" 
             class="w-40 opacity-90 mb-6">

        <h1 class="text-4xl font-extrabold text-gray-900 tracking-wide mb-2">
            SILANDRA
        </h1>

        <p class="text-gray-700 text-lg font-medium mb-10 text-center">
            Sistem Laporan dan Administrasi  
            <br>Sekretariat DPRD Kabupaten Sukabumi
        </p>

        <a href="{{ route('login') }}" 
           class="bg-blue-900 text-white px-12 py-3 rounded-lg 
                  hover:bg-blue-800 transition font-semibold shadow-lg tracking-wider">
            MASUK KE SISTEM
        </a>

        <!-- Garis emas dekoratif -->
        <div class="absolute bottom-10 w-2/3 h-1 bg-yellow-500 rounded-full"></div>

    </div>

    <!-- BAGIAN KANAN -->
<div class="w-1/2 relative overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('{{ asset('images/dprd.png') }}');">
    </div>

    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/55"></div>

    <!-- Konten Tengah -->
<div class="relative z-10 flex flex-col justify-center items-center text-center h-full px-10">

    <h2 class="text-4xl font-extrabold text-white tracking-wider drop-shadow-lg">
        SEKRETARIAT DPRD KABUPATEN SUKABUMI
    </h2>

</div>

    <!-- Informasi Bawah -->
    <div class="absolute bottom-8 w-full px-10 grid grid-cols-2 gap-6 text-white z-10">

        <!-- Card 1 -->
        <div class="bg-white/15 p-4 rounded-lg border border-white/20">
            <p class="text-sm font-semibold text-yellow-300 mb-1">Alamat Kantor</p>
            <p class="text-xs leading-relaxed text-gray-200">
                Jl. Jend. Sudirman Komplek Perkantoran Jajaway<br>
                Palabuhanratu 43364 Jawa Barat
            </p>
        </div>

        <!-- Card 2 -->
<div class="bg-white/15 p-4 rounded-lg border border-white/20 text-right">
    <p class="text-sm font-semibold text-yellow-300 mb-1">Media Sosial</p>

    <!-- Instagram -->
    <p class="text-xs text-gray-200 flex justify-end items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm8 5a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm3.5-.25h.01"/>
        </svg>
        @dprdkabupatensukabumi
    </p>

    <!-- Email -->
    <p class="text-xs text-gray-200 flex justify-end items-center gap-1 mt-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5A2.25 2.25 0 0 0 2.25 6.75m19.5 0L12 13.5 2.25 6.75"/>
        </svg>
        dprd@kabupatensukabumi.go.id
    </p>

</div>


