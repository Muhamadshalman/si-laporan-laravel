<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Laporan Sekretariat DPRD</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animasi fade-in */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeInUp .8s ease-out;
        }

        /* Background */
        body {
            background-image: url('/images/gedungdprd.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Overlay gelap blur */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(2px);
            z-index: -1;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <!-- CARD LOGIN -->
    <div class="bg-white/95 p-8 rounded-2xl shadow-2xl w-96 fade-in border-t-4 border-blue-900 backdrop-blur-md">

        <!-- Logo & Judul -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo_sukabumi3.png') }}" 
                 class="w-20 mb-3 drop-shadow-md" alt="Logo">
            
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-wide">
                SILANDRA
            </h2>
            <p class="text-sm text-gray-600 -mt-1">
                Sekretariat DPRD Kabupaten Sukabumi
            </p>
        </div>

        {{-- Pesan error --}}
        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm text-center animate-pulse">
            {{ session('error') }}
        </div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-semibold text-gray-700">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-800 focus:outline-none"
                       placeholder="Masukkan email">
                @error('email')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-800 focus:outline-none"
                       placeholder="Masukkan password">
                @error('password')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Pilih Bagian</label>
                <select name="bagian"
                        class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-800 focus:outline-none">
                    <option value="">-- Pilih Bagian --</option>
                    <option value="umum">Umum</option>
                    <option value="keuangan">Keuangan</option>
                    <option value="fasilitasi">Fasilitasi</option>
                    <option value="persidangan">Persidangan</option>
                </select>
                @error('bagian')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-blue-900 text-white rounded-lg p-2 font-semibold hover:bg-blue-800 transition shadow-md">
                Masuk
            </button>

            <div class="text-right mt-2">
                <a href="#"
                   onclick="alert('Silakan hubungi admin untuk reset password.')"
                   class="text-sm text-gray-600 hover:text-gray-800 hover:underline">
                    Lupa Password?
                </a>
            </div>
        </form>

        <!-- Footer -->
        <footer class="text-center text-xs text-gray-400 mt-6">
        <div class="text-center text-gray-600 text-sm">
           © {{ date('Y') }} Sekretariat DPRD Kab Sukabumi — SILANDRA
            <br>
        <span class="text-gray-500">Developed by <b>Muhamad Shalman</b></span>
            </div>
        </footer>
    </div>

</body>
</html>
 