@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100">

    <!-- Header dengan Foto DPRD -->
    <header class="relative h-72 md:h-96 w-full rounded-3xl overflow-hidden shadow-2xl mb-12">
        <img 
            src="{{ asset('images/dprd.png') }}"
            class="absolute inset-0 w-full h-full object-cover brightness-[0.45]"
        >
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

        <div class="relative z-10 h-full w-full flex flex-col items-center justify-center text-center text-white px-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-full p-4 mb-5 border border-white/20">
                <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-20 md:w-24">
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight drop-shadow-2xl mb-2">
                SUPER ADMIN SILANDRA
            </h1>

            <div class="h-1 w-24 bg-blue-400 rounded-full mb-4"></div>

            <p class="text-base md:text-lg max-w-2xl opacity-95 font-light">
               Sistem Laporan Administrasi & Arsip Digital<br class="hidden md:block">
               Sekretariat DPRD Kabupaten Sukabumi
            </p>
        </div>
    </header>

    <!-- Grid Menu -->
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- UMUM -->
            <a href="/dashboard/umum"
               class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl p-8 border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-5">
                        <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition">
                            <img src="{{ asset('images/bagianumum.png') }}" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                        Bagian Umum
                    </h2>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Pengelolaan administrasi & surat-menyurat DPRD
                    </p>

                    <div class="mt-4 flex items-center text-blue-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                        Akses Dashboard
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- KEUANGAN -->
            <a href="/dashboard/keuangan"
               class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl p-8 border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-5">
                        <div class="bg-green-100 p-3 rounded-xl group-hover:bg-green-200 transition">
                            <img src="{{ asset('images/bagiankeuangan.png') }}" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition">
                        Bagian Keuangan
                    </h2>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Pengelolaan anggaran & laporan keuangan DPRD
                    </p>

                    <div class="mt-4 flex items-center text-green-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                        Akses Dashboard
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- FASILITASI -->
            <a href="/dashboard/fasilitasi"
               class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl p-8 border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-5">
                        <div class="bg-purple-100 p-3 rounded-xl group-hover:bg-purple-200 transition">
                            <img src="{{ asset('images/bagianfasilitasi.png') }}" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition">
                        Bagian Fasilitasi
                    </h2>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Fasilitasi kegiatan kedewanan & koordinasi antar bagian
                    </p>

                    <div class="mt-4 flex items-center text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                        Akses Dashboard
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- PERSIDANGAN -->
            <a href="/dashboard/persidangan"
               class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl p-8 border border-gray-100 transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-5">
                        <div class="bg-orange-100 p-3 rounded-xl group-hover:bg-orange-200 transition">
                            <img src="{{ asset('images/bagianpersidangan.png') }}" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition">
                        Bagian Persidangan
                    </h2>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Pengelolaan agenda persidangan & risalah rapat DPRD
                    </p>

                    <div class="mt-4 flex items-center text-orange-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                        Akses Dashboard
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

        </div>
    </div>

    <!-- Logout Button -->
    <div class="mt-16 flex justify-center px-4">
        <form action="/logout" method="POST">
            @csrf
            <button
                class="group px-12 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

    <!-- Footer -->
             <footer class="mt-12 pt-8 border-t border-gray-200">
                 <div class="text-center space-y-2">

                 <p class="text-gray-500 text-xs">
                 © {{ date('Y') }} Sekretariat DPRD Kabupaten Sukabumi
             </p>
                <p class="text-xs text-gray-500">
                 Developed by <strong class="text-slate-700">Muhamad Shalman</strong>
    </p>
            </div>
        </div>
    </footer>

</div>
@endsection