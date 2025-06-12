<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar -->
    @include('components.navbarUser')

    <!-- Content -->
    <main class="max-w-7xl mx-auto py-8 px-4">
        @yield('content')
    </main>

</body>
</html>
