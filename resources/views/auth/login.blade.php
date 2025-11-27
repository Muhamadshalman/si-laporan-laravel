<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Laporan Sekretariat DPRD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up {
        animation: fadeInUp 0.7s ease-out;
    }
    </style>
<style>
    body {
        background-image: url('/images/gedungdprd.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    /* Overlay gelap */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.45);
        z-index: -1;
    }
</style>

</head>
<body class="flex items-center justify-center min-h-screen bg-gedungdprd">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-96 border-t-4 border-gray-700 fade-in-up">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo_sukabumi3.png') }}" alt="Logo Sekretariat DPRD" class="w-20 mb-3 animate-pulse">
            <h2 class="text-2xl font-bold text-gray-800 text-center">SILANDRA</h2>
            <p class="text-sm text-gray-500 text-center">Sekretariat DPRD</p>
        </div>

        {{-- Pesan error login --}}
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm text-center animate-bounce">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                    placeholder="Masukkan email">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                    placeholder="Masukkan password">
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Bagian</label>
                <select name="bagian"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-600 focus:outline-none">
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

            <button type="submit"
                class="w-full bg-gray-700 text-white rounded-lg p-2 font-semibold hover:bg-gray-800 transition duration-200">

                Login
            </button>

            <div class="text-right mt-2">
                <a href="#" onclick="alert('Silakan hubungi admin untuk reset password.')" class="text-sm text-gray-600 hover:underline">
                    Lupa Password?
                </a>
            </div>
        </form>

        <footer class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Sekretariat DPRD - SILANDRA
        </footer>
    </div>

</body>
</html>
