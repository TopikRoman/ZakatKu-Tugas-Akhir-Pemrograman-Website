<nav class="bg-white shadow-md border-b border-green-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-2 text-green-700 font-bold text-2xl">
        <img src="{{ asset('storage/images/logo-zakat.png') }}" alt="Logo" class="h-8">
        <span>Zakatku</span>
      </div>

      <!-- Menu Desktop -->
      <div class="hidden md:flex items-center space-x-6">

        <!-- Tombol Dashboard -->
        <a href="{{ route('dashboard') }}" class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
            Dashboard
        </a>
        <!-- Dropdown Pembayaran -->
        <div class="relative group">
          <button class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
            Pembayaran
          </button>
          <div
            class="absolute left-0 mt-2 w-48 bg-white border border-green-100 rounded-md shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('transaksi-zakat.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Pembayaran Zakat</a>
            <a href="{{ route('user.riwayat') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Riwayat Pembayaran</a>
          </div>
        </div>

        <!-- Laporan -->
        <a href="#" class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">Laporan</a>

        <!-- Dropdown Profil -->
        <div class="relative group">
          <button class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md flex items-center transition-colors">
            {{ Auth::user()->username }}
            <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div
            class="absolute right-0 mt-2 w-48 bg-white border border-green-100 rounded-md shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Profil</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-green-50">Logout</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Hamburger Menu Button -->
      <div class="md:hidden flex items-center">
        <button id="mobile-menu-button" class="text-green-700 hover:text-green-900 focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="md:hidden hidden px-4 pt-2 pb-4 space-y-2 bg-green-50" id="mobile-menu">
    <!-- Dropdown Pembayaran -->
    <button onclick="toggleDropdown('mobile-pembayaran')" class="w-full text-left text-green-800 text-base font-semibold py-2">
      Pembayaran
    </button>
    <div id="mobile-pembayaran" class="hidden ml-4 space-y-1">
      <a href="#" class="block text-gray-700 py-1">Pembayaran Zakat</a>
      <a href="#" class="block text-gray-700 py-1">Riwayat Pembayaran</a>
    </div>

    <!-- Laporan -->
    <a href="#" class="block text-green-800 text-base font-semibold py-2">Laporan</a>

    <!-- Profil -->
    <button onclick="toggleDropdown('mobile-profil')" class="w-full text-left text-green-800 text-base font-semibold py-2">
      Profil
    </button>
    <div id="mobile-profil" class="hidden ml-4 space-y-1">
      <a href="{{ route('profile.edit') }}" class="block text-gray-700 py-1">Profil</a>
      <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="block text-left w-full text-gray-700 py-1">Logout</button>
      </form>
    </div>
  </div>
</nav>

<script>
  document.getElementById('mobile-menu-button').addEventListener('click', () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });

  function toggleDropdown(id) {
    document.getElementById(id).classList.toggle('hidden');
  }
</script>
