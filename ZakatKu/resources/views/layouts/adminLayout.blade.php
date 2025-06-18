<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('/images/logo-zakat.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Tambahkan di <head> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
    <!-- Tambahkan sebelum </body> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    @include('components.navbarAdmin')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
