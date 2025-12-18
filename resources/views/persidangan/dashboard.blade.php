<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Persidangan - Sekretariat DPRD</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes slideIn {
      from {
        transform: translateX(-100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .sidebar-enter {
      animation: slideIn 0.3s ease-out;
    }

    .notification-enter {
      animation: fadeIn 0.3s ease-out;
    }

    .active-menu {
      background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .mobile-nav-active {
      color: #3b82f6;
      font-weight: 600;
      border-top: 3px solid #3b82f6;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">

  <x-persidangan></x-persidangan>

  <div class="flex min-h-screen">
    <!-- SIDEBAR DESKTOP -->
    <aside class="hidden md:flex md:w-72 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex-col shadow-2xl sidebar-enter">
      <!-- Sidebar Header -->
      <div class="p-6 border-b border-gray-700">
        <div class="flex items-center gap-3 mb-2">
          <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-3 rounded-xl shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <div>
            <h1 class="text-xl font-bold">SILANDRA</h1>
            <p class="text-xs text-gray-400">Sekretariat DPRD</p>
          </div>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="flex-1 p-4 space-y-2">
        <div class="mb-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>
          
          <button onclick="showUpload()" id="btn-upload" 
            class="group w-full text-left px-4 py-3.5 rounded-xl hover:bg-gray-700/50 transition-all duration-200 font-medium flex items-center gap-3 relative overflow-hidden">
            <div class="bg-blue-500/10 p-2 rounded-lg group-hover:bg-blue-500/20 transition-colors">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
              </svg>
            </div>
            <span class="text-sm">Upload Laporan</span>
          </button>

          <button onclick="showRiwayat()" id="btn-riwayat" 
            class="group w-full text-left px-4 py-3.5 rounded-xl hover:bg-gray-700/50 transition-all duration-200 font-medium flex items-center gap-3 relative overflow-hidden mt-2">
            <div class="bg-indigo-500/10 p-2 rounded-lg group-hover:bg-indigo-500/20 transition-colors">
              <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <span class="text-sm">Riwayat Laporan</span>
          </button>
        </div>

        <!-- User Info Card -->
        <div class="bg-gradient-to-br from-blue-600/20 to-indigo-600/20 backdrop-blur-sm border border-blue-500/30 rounded-xl p-4 mt-auto">
          <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-xs text-blue-300">Bagian Persidangan</p>
            </div>
          </div>
          
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
              class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 transition-all duration-200 font-medium text-white shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span class="text-sm">Logout</span>
            </button>
          </form>
        </div>
      </nav>

      <!-- Sidebar Footer -->
      <div class="p-4 border-t border-gray-700">
        <div class="text-center">
          <p class="text-xs text-gray-400">© {{ date('Y') }} DPRD Kab Sukabumi</p>
          <p class="text-xs text-gray-500 mt-1">Version 1.0.0</p>
        </div>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto">
      <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 pb-24 md:pb-8">
        
        <!-- NOTIFIKASI -->
        @if(session('success'))
          <div class="notification-enter fixed top-6 right-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-md">
            <div class="flex items-start gap-3">
              <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div class="flex-1">
                <p class="font-semibold mb-1">Berhasil!</p>
                <p class="text-sm opacity-90">{{ session('success') }}</p>
              </div>
              <button onclick="this.parentElement.parentElement.remove()" class="text-white/80 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
          </div>
        @endif

        <!-- UPLOAD SECTION -->
        <section id="upload-section" class="hidden">
          @include('persidangan.upload')
        </section>

        <!-- RIWAYAT SECTION -->
        <section id="riwayat-section" class="hidden">
          @include('persidangan.riwayat')
        </section>

        <!-- FOOTER -->
       <footer class="mt-12 pt-8 border-t border-gray-200">
    <div class="text-center space-y-2">

    <p class="text-gray-500 text-xs">
      © {{ date('Y') }} Sekretariat DPRD Kabupaten Sukabumi
    </p>

    <p class="text-xs text-gray-500">
      Developed by <strong class="text-slate-700">Muhamad Shalman</strong>
    </p>

  </div>
</footer>
  <!-- MOBILE BOTTOM NAV -->
  <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-lg border-t border-gray-200 shadow-2xl md:hidden z-50">
    <div class="flex items-center justify-around">
      <button onclick="showUpload()" id="btn-upload-mobile" 
        class="flex-1 flex flex-col items-center justify-center py-3 transition-all duration-200 relative">
        <div class="bg-blue-100 p-2 rounded-lg mb-1 group-hover:bg-blue-200 transition-colors">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
          </svg>
        </div>
        <span class="text-xs font-medium text-gray-600">Upload</span>
      </button>

      <button onclick="showRiwayat()" id="btn-riwayat-mobile" 
        class="flex-1 flex flex-col items-center justify-center py-3 transition-all duration-200 relative">
        <div class="bg-indigo-100 p-2 rounded-lg mb-1 group-hover:bg-indigo-200 transition-colors">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <span class="text-xs font-medium text-gray-600">Riwayat</span>
      </button>

      <form action="{{ route('logout') }}" method="POST" class="flex-1">
        @csrf
        <button type="submit" 
          class="w-full flex flex-col items-center justify-center py-3 transition-all duration-200">
          <div class="bg-red-100 p-2 rounded-lg mb-1 hover:bg-red-200 transition-colors">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
          </div>
          <span class="text-xs font-medium text-gray-600">Logout</span>
        </button>
      </form>
    </div>
  </div>

  <!-- Load JavaScript Files -->
  <script src="{{ asset('js/persidangan/uraian-options.js') }}"></script>
  <script src="{{ asset('js/persidangan/form-handlers.js') }}"></script>
  <script src="{{ asset('js/persidangan/ui-handlers.js') }}"></script>
  <script src="{{ asset('js/persidangan/app.js') }}"></script>

  <script>
    // Auto-hide notification after 5 seconds
    setTimeout(() => {
      const notification = document.querySelector('.notification-enter');
      if (notification) {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => notification.remove(), 300);
      }
    }, 5000);

    // Enhanced active state management
    function updateActiveState(section) {
      // Desktop buttons
      const uploadBtn = document.getElementById('btn-upload');
      const riwayatBtn = document.getElementById('btn-riwayat');
      
      // Mobile buttons
      const uploadBtnMobile = document.getElementById('btn-upload-mobile');
      const riwayatBtnMobile = document.getElementById('btn-riwayat-mobile');

      // Remove active class from all
      [uploadBtn, riwayatBtn].forEach(btn => {
        btn?.classList.remove('active-menu');
      });
      
      [uploadBtnMobile, riwayatBtnMobile].forEach(btn => {
        btn?.classList.remove('mobile-nav-active');
      });

      // Add active class to current
      if (section === 'upload') {
        uploadBtn?.classList.add('active-menu');
        uploadBtnMobile?.classList.add('mobile-nav-active');
      } else if (section === 'riwayat') {
        riwayatBtn?.classList.add('active-menu');
        riwayatBtnMobile?.classList.add('mobile-nav-active');
      }
    }

    // Override show functions to include active state
    const originalShowUpload = window.showUpload;
    const originalShowRiwayat = window.showRiwayat;

    window.showUpload = function() {
      if (originalShowUpload) originalShowUpload();
      updateActiveState('upload');
    };

    window.showRiwayat = function() {
      if (originalShowRiwayat) originalShowRiwayat();
      updateActiveState('riwayat');
    };
  </script>
</body>
</html>