@props(['title' => null])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- CSS & Font -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,500&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" text-ink-900 dark:text-cream-100 font-sans min-h-screen flex flex-col transition-colors duration-300">
    
    <!-- Panggil Navbar Baru yang sudah kita buat -->
    <x-shop.navbar />

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-shop.footer />
    <x-shop.whatsapp-button />

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>