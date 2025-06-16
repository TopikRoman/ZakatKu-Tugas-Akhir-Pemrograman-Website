@extends('layouts.guestLayout')

@section('content')

<div class="bg-gradient-to-r from-green-100 via-green-200 to-yellow-100">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-12 mx-auto lg:gap-8 xl:gap-0 lg:py-20 lg:grid-cols-12 lg:pt-28">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-6 text-4xl font-extrabold leading-tight tracking-tight text-green-800 md:text-5xl xl:text-6xl">
                Ayo Tunaikan <br>
                <span class="text-green-600">Zakatmu</span> Bersama
                <span class="underline decoration-green-400">Zakatku</span>
            </h1>
            <p class="max-w-2xl mb-8 font-medium text-gray-800 lg:text-lg lg:mb-10">
                Wujudkan keberkahan melalui zakat. Platform zakat digital yang aman, transparan, dan terpercaya dalam menyalurkan kebaikan kepada sesama.
            </p>
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-green-700 hover:bg-green-800 rounded-lg shadow transition">
                    <i class="fas fa-hand-holding-heart mr-2"></i> Bayar Zakat Sekarang
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-green-700 border border-green-600 rounded-lg hover:bg-green-100 transition">
                    <i class="fas fa-info-circle mr-2"></i> Tentang Zakatku
                </a>
            </div>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <div class="relative w-full max-w-md mx-auto aspect-video overflow-hidden bg-transparent backdrop-blur-md rounded-lg" id="slider">
            <img id="slide-image"
                src="{{ asset('images/gambar1.png') }}"
                alt="Slide Zakatku"
                class="w-full h-full object-contain transition-opacity duration-500 ease-in-out opacity-100">

            <!-- Tombol Prev -->
            <button onclick="prevSlide()"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white/40 hover:bg-white/70 text-green-700 px-3 py-1 rounded-full backdrop-blur-md">
                ‹
            </button>

            <!-- Tombol Next -->
            <button onclick="nextSlide()"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white/40 hover:bg-white/70 text-green-700 px-3 py-1 rounded-full backdrop-blur-md">
                ›
            </button>

            <!-- Dots -->
            <div class="flex justify-center mt-4 space-x-2">
                <button class="dot w-3 h-3 rounded-full bg-green-700" onclick="goToSlide(0)"></button>
                <button class="dot w-3 h-3 rounded-full bg-green-300" onclick="goToSlide(1)"></button>
                <button class="dot w-3 h-3 rounded-full bg-green-300" onclick="goToSlide(2)"></button>
            </div>
            </div>


        </div>

    </div>
</div>

<section class="bg-white dark:bg-gray-800 py-16">
  <div class="max-w-screen-xl px-4 mx-auto">
    <h2 class="text-3xl font-bold text-center text-green-800 mb-12">Fitur Unggulan Zakatku</h2>

    <div class="grid gap-12 md:grid-cols-3 text-center">
      <!-- Fitur 1: Pembayaran Online -->
      <div class="flex flex-col items-center">
        <div class="bg-green-100 text-green-700 w-20 h-20 flex items-center justify-center rounded-full shadow-md mb-6">
          <i class="fas fa-credit-card text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Pembayaran Zakat Online</h3>
        <p class="text-gray-600 dark:text-gray-300">Mudah, cepat, dan aman melalui berbagai metode pembayaran digital.</p>
      </div>

      <!-- Fitur 2: Laporan Pembagian -->
      <div class="flex flex-col items-center">
        <div class="bg-yellow-100 text-yellow-700 w-20 h-20 flex items-center justify-center rounded-full shadow-md mb-6">
          <i class="fas fa-chart-line text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Laporan Pembagian Transparan</h3>
        <p class="text-gray-600 dark:text-gray-300">Pantau penyaluran zakat secara berkala melalui laporan sistem.</p>
      </div>

      <!-- Fitur 3: Akses Mudah -->
      <div class="flex flex-col items-center">
        <div class="bg-green-100 text-green-700 w-20 h-20 flex items-center justify-center rounded-full shadow-md mb-6">
          <i class="fas fa-mobile-alt text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Akses Sistem Mudah</h3>
        <p class="text-gray-600 dark:text-gray-300">Bisa diakses dari perangkat apa saja kapan pun dan di mana pun.</p>
      </div>
    </div>
  </div>
</section>

<section class="bg-green-50 dark:bg-gray-900 py-16">
  <div class="max-w-screen-xl px-4 mx-auto">
    <h2 class="text-3xl font-bold text-center text-green-800 mb-12">Jenis-Jenis Zakat</h2>

    <div class="grid md:grid-cols-3 gap-10 text-center">
      <!-- Zakat Fitrah -->
      <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <div class="text-green-700 text-4xl mb-4">
          <i class="fas fa-seedling"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Zakat Fitrah</h3>
        <p class="text-gray-600 dark:text-gray-300">Zakat wajib yang dikeluarkan setiap individu muslim menjelang Idul Fitri sebagai bentuk pensucian jiwa.</p>
      </div>

      <!-- Zakat Mal -->
      <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <div class="text-yellow-600 text-4xl mb-4">
          <i class="fas fa-coins"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Zakat Mal</h3>
        <p class="text-gray-600 dark:text-gray-300">Zakat harta benda yang wajib dikeluarkan oleh setiap muslim atas kekayaan tertentu seperti emas, tabungan, dan hasil usaha.</p>
      </div>

      <!-- Zakat Profesi -->
      <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <div class="text-green-500 text-4xl mb-4">
          <i class="fas fa-briefcase"></i>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Zakat Profesi</h3>
        <p class="text-gray-600 dark:text-gray-300">Zakat yang dikeluarkan dari penghasilan atau gaji profesi seperti pegawai, dokter, pengajar, dan lainnya.</p>
      </div>
    </div>
  </div>
</section>


<footer class="bg-green-50 dark:bg-gray-900 border-t border-green-100 dark:border-gray-700">
  <div class="max-w-screen-xl px-6 py-10 mx-auto text-center">

    <!-- Nama Masjid -->
    <h2 class="text-2xl font-bold text-green-800 dark:text-white mb-2">Masjid An-Nur</h2>

    <!-- Alamat -->
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
      Jl. Trunojoyo VIII, Kaliwates, Jember, Jawa Timur 68133, Indonesia
    </p>

    <!-- Social Media Opsional -->
    <div class="flex justify-center mb-6 space-x-4 text-green-700 dark:text-green-300">
      <a href="#" class="hover:text-green-900 dark:hover:text-white transition">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#" class="hover:text-green-900 dark:hover:text-white transition">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="#" class="hover:text-green-900 dark:hover:text-white transition">
        <i class="fab fa-whatsapp"></i>
      </a>
    </div>

    <!-- Divider -->
    <hr class="my-6 border-green-200 dark:border-gray-700">

    <!-- Copyright -->
    <p class="text-sm text-gray-500 dark:text-gray-400">
      © 2025 Masjid An-Nur. Seluruh hak cipta dilindungi.
    </p>
  </div>
</footer>


<script>
  const images = [
    "{{ asset('images/gambar1.png') }}",
    "{{ asset('images/gambar2.png') }}",
    "{{ asset('images/gambar3.png') }}"
  ];

  let currentSlide = 0;
  const img = document.getElementById("slide-image");

  function updateSlide() {
    const imageElement = document.getElementById("slide-image");

    // Tambahkan efek fade-out
    imageElement.classList.remove("opacity-100");
    imageElement.classList.add("opacity-0");

    setTimeout(() => {
      imageElement.src = images[currentSlide];

      // Tambahkan efek fade-in
      imageElement.classList.remove("opacity-0");
      imageElement.classList.add("opacity-100");
    }, 300);

    // Update dot color
    const dots = document.querySelectorAll(".dot");
    dots.forEach((dot, index) => {
      dot.classList.remove("bg-green-700");
      dot.classList.add("bg-green-300");
      if (index === currentSlide) {
        dot.classList.remove("bg-green-300");
        dot.classList.add("bg-green-700");
      }
    });
  }

  function nextSlide() {
    currentSlide = (currentSlide + 1) % images.length;
    updateSlide();
  }

  function prevSlide() {
    currentSlide = (currentSlide - 1 + images.length) % images.length;
    updateSlide();
  }

  function goToSlide(index) {
    currentSlide = index;
    updateSlide();
  }

  // Otomatis slide setiap 3 detik
  setInterval(nextSlide, 3000);
</script>


@endsection
