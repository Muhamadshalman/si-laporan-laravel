<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SILANDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-image: url('{{ asset("images/gedungdprd.png") }}');
            background-size: cover;
            background-position: center;
        }
       body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    backdrop-filter: blur(1.5px);
    z-index: -1;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl border border-gray-200">

    <!-- LOGO -->
    <div class="text-center mb-6">
        <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-20 mx-auto mb-3">
        <h1 class="text-3xl font-extrabold tracking-wide">SILANDRA</h1>
        <p class="text-sm text-gray-600">Sekretariat DPRD Kabupaten Sukabumi</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 text-sm text-center p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="text-sm font-semibold">Email</label>
            <input type="text" name="email" value="{{ old('email') }}"
                class="w-full mt-1 p-2 rounded-lg border focus:ring-2 focus:ring-blue-800">
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="text-sm font-semibold">Password</label>
            <input type="password" name="password"
                class="w-full mt-1 p-2 rounded-lg border focus:ring-2 focus:ring-blue-800">
        </div>

        <!-- PILIH BAGIAN (MODERN) -->
        <div>
    <label class="text-sm font-semibold text-gray-700 block mb-2">
        Pilih Bagian
    </label>

    <div class="grid grid-cols-2 gap-3">
        @foreach ([
            'umum' => 'Bagian Umum',
            'keuangan' => 'Bagian Keuangan',
            'fasilitasi' => 'Bagian Fasilitasi',
            'persidangan' => 'Bagian Persidangan'
        ] as $key => $label)
        <label class="cursor-pointer">
            <input type="radio" name="bagian" value="{{ $key }}" class="peer hidden">
            <div class="border rounded-lg px-3 py-2 text-center text-sm font-medium
                        text-gray-700
                        peer-checked:border-blue-800
                        peer-checked:bg-blue-50
                        peer-checked:text-blue-800
                        hover:bg-gray-50 transition">
                {{ $label }}
            </div>
        </label>
        @endforeach
    </div>

    @error('bagian')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
        <!-- BUTTON -->
        <button class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 rounded-xl shadow">
            LOGIN
        </button>
    </form>

    <div class="text-center text-xs text-gray-500 mt-6">
        © {{ date('Y') }} Sekretariat DPRD Kab. Sukabumi<br>
        Developed by <b>Muhamad Shalman</b>
    </div>

</div>

</body>
</html>
