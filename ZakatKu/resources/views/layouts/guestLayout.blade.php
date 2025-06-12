<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Zakatku' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Panggil Komponen Navbar -->
    @include('components.navbarGuest')

    <!-- Konten -->
    <main class="py-10 px-4 md:px-8">
        @yield('content')
    </main>

</body>
</html>
