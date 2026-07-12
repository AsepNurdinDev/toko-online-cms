<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>401 - Anda Perlu Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-neutral-50 flex items-center justify-center px-4">
    <div class="max-w-md w-full text-center">
        <p class="text-sm font-medium text-neutral-400 tracking-widest mb-3">ERROR 401</p>
        <h1 class="text-2xl font-semibold text-neutral-900 mb-3">Anda Perlu Masuk</h1>
        <p class="text-neutral-500 text-sm leading-relaxed mb-8">
            Halaman ini hanya bisa diakses setelah Anda login. Silakan masuk terlebih dahulu untuk melanjutkan.
        </p>
        <div class="flex items-center justify-center gap-3">
            <a href="/login" class="inline-block px-5 py-2.5 bg-neutral-900 text-white text-sm rounded-lg hover:bg-neutral-800 transition focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                Masuk
            </a>
            <a href="/" class="inline-block px-5 py-2.5 bg-white text-neutral-700 text-sm rounded-lg border border-neutral-300 hover:bg-neutral-100 transition focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>