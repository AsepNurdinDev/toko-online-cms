<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online Saya - Beranda</title>
    <!-- Menggunakan Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJS untuk interaktivitas mobile menu atau dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <!-- NAVBAR / HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-black tracking-tight text-indigo-600">TOKOKU<span class="text-amber-500">.</span></a>
                </div>

                <!-- Kolom Pencarian (Desktop) -->
                <div class="hidden sm:block flex-1 max-w-md mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Cari produk impianmu di sini..." class="w-full bg-gray-100 pl-10 pr-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <div class="absolute left-3.5 top-2.5 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Menu Navigasi & Ikon -->
                <div class="flex items-center space-x-4">
                    <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-600">
                        <a href="#" class="hover:text-indigo-600 transition">Beranda</a>
                        <a href="#" class="hover:text-indigo-600 transition">Kategori</a>
                        <a href="#" class="hover:text-indigo-600 transition">Promo</a>
                    </nav>

                    <span class="h-6 w-px bg-gray-200 hidden md:block"></span>

                    <!-- Tombol Keranjang -->
                    <a href="#" class="p-2 text-gray-600 hover:text-indigo-600 relative transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">3</span>
                    </a>

                    <!-- Tombol Akun / Masuk -->
                    <a href="#" class="hidden sm:inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        <!-- HERO BANNER -->
        <section class="bg-gradient-to-r lg:min-h-[380px] from-indigo-600 to-purple-700 rounded-2xl overflow-hidden shadow-lg text-white p-8 sm:p-12 flex flex-col justify-center relative">
            <!-- Dekorasi Estetik Belakang -->
            <div class="absolute right-0 bottom-0 top-0 w-1/3 opacity-10 bg-[radial-gradient(circle_at_bottom_right,_var(--tw-gradient-stops))] from-white via-indigo-200 to-transparent hidden lg:block"></div>
            
            <div class="max-w-xl space-y-4 relative z-10">
                <span class="bg-amber-500 text-gray-900 text-xs font-extrabold uppercase px-3 py-1 rounded-full tracking-wider">Promo Spesial Bulan Ini</span>
                <h2 class="text-3xl sm:text-5xl font-black leading-tight tracking-tight">Gaya Maksimal, Harga Minimal!</h2>
                <p class="text-indigo-100 text-sm sm:text-base">Dapatkan diskon hingga <strong class="text-amber-400 text-lg">50%</strong> untuk koleksi pakaian dan aksesoris pilihan terbaru.</p>
                <div class="pt-2">
                    <a href="#" class="inline-block bg-white text-indigo-700 font-bold px-6 py-3 rounded-full shadow-md hover:bg-amber-400 hover:text-gray-900 transition-all transform hover:-translate-y-0.5">Jelajahi Sekarang</a>
                </div>
            </div>
        </section>

        <!-- KATEGORI POPULER -->
        <section class="space-y-4">
            <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Kategori Populer</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                <!-- Kategori item -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Elektronik</span>
                </a>
                <!-- Kategori item 2 -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Fashion</span>
                </a>
                <!-- Kategori item 3 -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-green-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Kecantikan</span>
                </a>
                <!-- Kategori item 4 -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Rumah Tangga</span>
                </a>
                <!-- Kategori item 5 -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-red-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Gaming</span>
                </a>
                <!-- Kategori item 6 -->
                <a href="#" class="bg-white p-4 rounded-xl text-center border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition group">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Kesehatan</span>
                </a>
            </div>
        </section>

        <!-- GRID PRODUK TERBARU -->
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Produk Rekomendasi</h3>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition">Lihat Semua →</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                
                <!-- CARD PRODUK 1 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    <div class="bg-gray-100 aspect-square w-full relative overflow-hidden flex items-center justify-center text-gray-400">
                        <!-- Mockup Gambar menggunakan SVG / Placeholder -->
                        <span class="font-bold text-xs bg-indigo-100 text-indigo-800 absolute top-3 left-3 px-2 py-0.5 rounded-md">Baru</span>
                        <svg class="w-16 h-16 opacity-40 group-hover:scale-105 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path></svg>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Fashion Pria</p>
                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base line-clamp-2 hover:text-indigo-600 transition"><a href="#">Jaket Denim Kasual Premium</a></h4>
                            <!-- Rating Bintang -->
                            <div class="flex items-center mt-1 text-amber-400 space-x-0.5">
                                <span class="text-xs font-semibold text-gray-500 mr-1">4.8</span>
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <div class="pt-2 flex items-center justify-between">
                            <span class="font-extrabold text-gray-900 text-base">Rp 249.000</span>
                            <button class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-lg transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CARD PRODUK 2 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    <div class="bg-gray-100 aspect-square w-full relative overflow-hidden flex items-center justify-center text-gray-400">
                        <span class="font-bold text-xs bg-red-100 text-red-800 absolute top-3 left-3 px-2 py-0.5 rounded-md">Diskon 15%</span>
                        <svg class="w-16 h-16 opacity-40 group-hover:scale-105 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Gadget</p>
                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base line-clamp-2 hover:text-indigo-600 transition"><a href="#">Smartphone Pro Max 128GB</a></h4>
                            <div class="flex items-center mt-1 text-amber-400 space-x-0.5">
                                <span class="text-xs font-semibold text-gray-500 mr-1">4.9</span>
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <div>
                                <span class="text-xs text-gray-400 line-through">Rp 4.200.000</span>
                                <p class="font-extrabold text-gray-900 text-base">Rp 3.570.000</p>
                            </div>
                            <button class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-lg transition-all shadow-sm self-end sm:self-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CARD PRODUK 3 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    <div class="bg-gray-100 aspect-square w-full relative overflow-hidden flex items-center justify-center text-gray-400">
                        <svg class="w-16 h-16 opacity-40 group-hover:scale-105 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Elektronik</p>
                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base line-clamp-2 hover:text-indigo-600 transition"><a href="#">Smart LED Bulb RGB 9W</a></h4>
                            <div class="flex items-center mt-1 text-amber-400 space-x-0.5">
                                <span class="text-xs font-semibold text-gray-500 mr-1">4.6</span>
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <div class="pt-2 flex items-center justify-between">
                            <span class="font-extrabold text-gray-900 text-base">Rp 85.000</span>
                            <button class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-lg transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CARD PRODUK 4 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    <div class="bg-gray-100 aspect-square w-full relative overflow-hidden flex items-center justify-center text-gray-400">
                        <svg class="w-16 h-16 opacity-40 group-hover:scale-105 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Gaya Hidup</p>
                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base line-clamp-2 hover:text-indigo-600 transition"><a href="#">Botol Minum Tumbler Termos 500ml</a></h4>
                            <div class="flex items-center mt-1 text-amber-400 space-x-0.5">
                                <span class="text-xs font-semibold text-gray-500 mr-1">4.7</span>
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <div class="pt-2 flex items-center justify-between">
                            <span class="font-extrabold text-gray-900 text-base">Rp 120.000</span>
                            <button class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-lg transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <a href="#" class="text-2xl font-black tracking-tight text-indigo-600">TOKOKU<span class="text-amber-500">.</span></a>
                    <p class="text-sm text-gray-500">Platform e-commerce andalan untuk menemukan barang terbaik dengan pelayanan super cepat.</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-indigo-600 transition">Bantuan & Komplain</a></li>
                        <li><li><a href="#" class="hover:text-indigo-600 transition">Metode Pembayaran</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Lacak Pengiriman</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Tentang Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-indigo-600 transition">Info Perusahaan</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4 text-gray-400">
                        <!-- Placeholder Sosial Media ringan -->
                        <span class="text-xs font-semibold text-gray-500">Instagram: @tokoku</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-100 pt-8 text-center text-sm text-gray-400">
                &copy; 2026 TOKOKU. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>