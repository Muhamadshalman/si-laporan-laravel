@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- Header dengan Foto DPRD -->
    <header class="relative h-64 md:h-80 w-full rounded-2xl overflow-hidden shadow-lg mb-14">
        <img 
            src="{{ asset('images/dprd.png') }}"
            class="absolute inset-0 w-full h-full object-cover brightness-[0.55]"
        >

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-center text-white">
            <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-20 mb-4 opacity-90">
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-wide drop-shadow-lg">
                SUPER ADMIN SILANDRA
            </h1>

            <p class="text-lg mt-2 opacity-90">
               Sistem Laporan Dan Administrasi Sekretariat DPRD Kabupaten Sukabumi
            </p>
        </div>
    </header>

    <!-- Grid Menu -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- UMUM -->
        <a href="/dashboard/umum"
           class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-7 border border-gray-200 transition transform hover:-translate-y-1 hover:scale-[1.02]">
            
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-900">Bagian Umum</h2>
                <img src="{{ asset('images/bagianumum.png') }}" class="w-10 opacity-80 group-hover:scale-110 transition" />
            </div>

            <p class="text-gray-600 text-sm">
                Pengelolaan administrasi & surat-menyurat DPRD.
            </p>
        </a>

        <!-- KEUANGAN -->
        <a href="/dashboard/keuangan"
           class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-7 border border-gray-200 transition transform hover:-translate-y-1 hover:scale-[1.02]">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-900">Bagian Keuangan</h2>
                <img src="{{ asset('images/bagiankeuangan.png') }}" class="w-10 opacity-80 group-hover:scale-110 transition" />
            </div>

            <p class="text-gray-600 text-sm">
                Pengelolaan anggaran & laporan keuangan DPRD.
            </p>
        </a>

        <!-- FASILITASI -->
        <a href="/dashboard/fasilitasi"
           class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-7 border border-gray-200 transition transform hover:-translate-y-1 hover:scale-[1.02]">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-900">Bagian Fasilitasi</h2>
                <img src="{{ asset('images/bagianfasilitasi.png') }}" class="w-10 opacity-80 group-hover:scale-110 transition" />
            </div>

            <p class="text-gray-600 text-sm">
                Fasilitasi kegiatan kedewanan & koordinasi antar bagian.
            </p>
        </a>

        <!-- PERSIDANGAN -->
        <a href="/dashboard/persidangan"
           class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-7 border border-gray-200 transition transform hover:-translate-y-1 hover:scale-[1.02]">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-900">Bagian Persidangan</h2>
                <img src="{{ asset('images/bagianpersidangan.png') }}" class="w-10 opacity-80 group-hover:scale-110 transition" />
            </div>

            <p class="text-gray-600 text-sm">
                Pengelolaan agenda persidangan & risalah rapat DPRD.
            </p>
        </a>

    </div>

    <!-- Logout -->
    <div class="mt-16 flex justify-center">
        <form action="/logout" method="POST">
            @csrf
            <button
                class="px-10 py-3 bg-blue-700 text-white font-semibold rounded-xl hover:bg-blue-800 shadow-lg transition transform hover:-translate-y-1">
                Logout
            </button>
        </form>
    </div>

    <!-- Footer Pemerintah -->
    <footer class="mt-20 text-center py-6 text-gray-600 border-t border-gray-300">
        <p class="text-sm tracking-wide">
            <div class="text-center text-gray-600 text-sm">
    © {{ date('Y') }} Sekretariat DPRD Kab Sukabumi — SILANDRA
    <br>
    <span class="text-gray-500">Developed by <b>Muhamad Shalman</b></span>
</div>

@endsection
