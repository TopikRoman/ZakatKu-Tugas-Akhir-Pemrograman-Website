<nav class="bg-white shadow-md border-b border-green-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-2 text-green-700 font-bold text-2xl">
        <img src="{{ asset('storage/images/logo-zakat.png') }}" alt="Logo" class="h-8">
        <span>Zakatku Admin</span>
      </div>

      <!-- Menu Desktop -->
      <div class="hidden md:flex items-center space-x-6">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
          Dashboard
        </a>

        <!-- Pembayaran -->
        <div class="relative group">
          <button class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
            Pembayaran
          </button>
          <div class="absolute left-0 mt-2 w-56 bg-white border border-green-100 rounded-md shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('admin.pembayaran.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Pembayaran Zakat</a>
            <a href="{{ route('admin.zakat.verifikasiList') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Verifikasi Pembayaran</a>
          </div>
        </div>

        <!-- Penyaluran -->
        <a href="{{route('pembagian.index')}}" class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
          Penyaluran
        </a>

        <!-- Data Akun -->
        <div class="relative group">
          <button class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md transition-colors">
            Data
          </button>
          <div class="absolute left-0 mt-2 w-56 bg-white border border-green-100 rounded-md shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('amil.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Akun Amil</a>
            <a href="{{ route('muzakki.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Akun Muzakki</a>
            <a href="{{ route('penerima_zakat.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Data Mustahik</a>
          </div>
        </div>

        <!-- Profil -->
        <div class="relative group">
          <button class="text-green-800 hover:text-green-900 px-3 py-2 text-base font-semibold rounded-md flex items-center transition-colors">
            {{ Auth::user()->username }}
            <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-white border border-green-100 rounded-md shadow-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Profil</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-green-50">Logout</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Hamburger Button -->
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
    <a href="{{ route('admin.dashboard') }}" class="block text-green-800 text-base font-semibold py-2">Dashboard</a>

    <button onclick="toggleDropdown('mobile-pembayaran')" class="w-full text-left text-green-800 text-base font-semibold py-2">Pembayaran</button>
    <div id="mobile-pembayaran" class="hidden ml-4 space-y-1">
      <a href="{{ route('admin.pembayaran.index') }}" class="block text-gray-700 py-1">Pembayaran Zakat</a>
      <a href="#" class="block text-gray-700 py-1">Verifikasi Pembayaran</a>
    </div>

    <a href="{{route('pembagian.index')}}" class="block text-green-800 text-base font-semibold py-2">Penyaluran</a>

    <button onclick="toggleDropdown('mobile-akun')" class="w-full text-left text-green-800 text-base font-semibold py-2">Data</button>
    <div id="mobile-akun" class="hidden ml-4 space-y-1">
      <a href="{{ route('amil.index') }}" class="block text-gray-700 py-1">Akun Amil</a>
      <a href="{{ route('muzakki.index') }}" class="block text-gray-700 py-1">Akun Muzakki</a>
      <a href="{{ route('penerima_zakat.index') }}" class="block text-gray-700 py-1">Data Mustahik</a>
    </div>

    <button onclick="toggleDropdown('mobile-profil')" class="w-full text-left text-green-800 text-base font-semibold py-2">Profil</button>
    <div id="mobile-profil" class="hidden ml-4 space-y-1">
      <a href="{{ route('profile.edit') }}" class="block text-gray-700 py-1">Profil</a>
      <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="block w-full text-left text-gray-700 py-1">Logout</button>
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
