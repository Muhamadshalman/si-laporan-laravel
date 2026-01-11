<header class="bg-white shadow-sm fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <a href="{{ route('welcome') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/logo_sukabumi3.png') }}" class="w-10 h-10" alt="Logo">
        <span class="font-bold text-lg">SILANDRA</span>
      </a>
    </div>

    <!-- Desktop page nav -->
    <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
      <a href="{{ route('welcome') }}" class="hover:text-blue-700">Beranda</a>
      <a href="{{ route('tentang') }}" class="hover:text-blue-700">Tentang</a>
      <a href="{{ route('informasi') }}" class="hover:text-blue-700">Informasi</a>
    </nav>

    <!-- Desktop auth nav -->
    <div class="hidden md:flex items-center gap-4">
      @if (Route::has('login'))
        @auth
          <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-600 text-white rounded-md text-sm shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-600 text-white rounded-md text-sm shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">Log in</a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Register</a>
          @endif
        @endauth
      @endif
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden relative">
      <button id="mobile-menu-button" aria-expanded="false" aria-controls="mobile-menu" class="p-2 rounded-md border border-transparent hover:border-[#19140035] dark:hover:border-[#62605b] bg-white dark:bg-[#161615]">
        <span class="sr-only">Open menu</span>
        <svg class="w-6 h-6 text-[#1b1b18] dark:text-[#EDEDEC]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <div id="mobile-menu" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md shadow-lg z-50">
        <div class="p-2">
          <a href="{{ route('welcome') }}" class="block px-3 py-2 rounded text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#FDFDFC] dark:hover:bg-[#1D0002]">Beranda</a>
          <a href="{{ route('tentang') }}" class="block px-3 py-2 rounded text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#FDFDFC] dark:hover:bg-[#1D0002]">Tentang</a>
          <a href="{{ route('informasi') }}" class="block px-3 py-2 rounded text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#FDFDFC] dark:hover:bg-[#1D0002]">Informasi</a>
          <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] my-2"></div>
          @if (Route::has('login'))
            @auth
              <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded text-sm bg-blue-600 text-white hover:bg-blue-700">Dashboard</a>
            @else
              <a href="{{ route('login') }}" class="block px-3 py-2 rounded text-sm bg-blue-600 text-white hover:bg-blue-700">Log in</a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#FDFDFC] dark:hover:bg-[#1D0002]">Register</a>
              @endif
            @endauth
          @endif
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (!btn || !menu) return;

    btn.addEventListener('click', function (e) {
      const isOpen = !menu.classList.contains('hidden');
      if (isOpen) {
        menu.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      } else {
        menu.classList.remove('hidden');
        btn.setAttribute('aria-expanded', 'true');
      }
    });

    // Close on outside click
    document.addEventListener('click', function (e) {
      if (!menu.classList.contains('hidden')) {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
          menu.classList.add('hidden');
          btn.setAttribute('aria-expanded', 'false');
        }
      }
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        menu.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  });
</script>