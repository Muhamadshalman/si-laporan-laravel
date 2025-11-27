<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILANDRA - Sekretariat DPRD Kab. Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animasi fade-in */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeInUp 1s ease-out;
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-200">

    <!-- Bagian Kiri -->
    <div class="w-1/2 bg-white flex flex-col justify-center items-center p-10 fade-in">
        <img src="{{ asset('images/logo_sukabumi3.png') }}" alt="Logo Sukabumi" class="w-40 mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-1 tracking-wide">SILANDRA</h1>
        <p class="text-gray-600 mb-8 text-center">Sekretariat DPRD Kab. Sukabumi</p>

        <a href="{{ route('login') }}" 
           class="bg-gray-800 text-white px-10 py-2 rounded-lg hover:bg-gray-700 transition duration-200 font-semibold shadow-md">
           MASUK KE SISTEM
        </a>
    </div>

   <!-- Bagian Kanan -->
<div class="w-1/2 relative overflow-hidden p-10 flex flex-col justify-center items-center fade-in">

    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('{{ asset('images/dprd.png') }}');">
    </div>

    <!-- Overlay supaya gambar tidak terlalu menonjol -->
    <div class="absolute inset-0 bg-black bg-opacity-45"></div>

    <!-- Konten utama -->
<div class="relative z-10 text-center -translate-y-24">
        <h2 class="text-2xl font-bold text-white">
            Sistem Laporan Administrasi Sekretariat DPRD
        </h2>
        <p class="text-lg font-semibold text-white mt-2">
            KABUPATEN SUKABUMI
        </p>
    </div>

    <!-- Informasi bawah -->
    <div class="absolute bottom-4 w-full flex justify-between px-10 text-sm text-white z-10">
        <div>
            <p class="font-semibold">📍 Alamat Kantor</p>
            <p>Jl. Jend. Sudirman Komplek Perkantoran Jajaway<br>
                Palabuhanratu 43364 Jawa Barat</p>
        </div>

        <div class="text-right">
            <p class="font-semibold">Media Sosial</p>
            <p>📸 @dprdkabupatensukabumi</p>
            <p>✉️ dprd@kabupatensukabumi.go.id</p>
        </div>
    </div>

</div>


</body>
</html>
