<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muzakki | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/53ff4c58cd.js" crossorigin="anonymous"></script>

    <link rel="icon" href="{{ asset('/images/logo-zakat.png') }}" type="image/png">

    <!-- Tambahkan font default Inter -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar -->
    @include('components.navbarUser')

    <!-- Content -->
    @yield('content')

</body>
</html>
