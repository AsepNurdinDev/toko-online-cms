<x-shop.layout title="Profil & Cerita Kami">
    {{-- Mengirimkan Font khusus Sudut Lawas & Tailwind Config ke dalam head layout jika belum ada --}}
    <x-slot name="head">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,500&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            display: ['"Bebas Neue"', 'sans-serif'],
                            story: ['"Fraunces"', 'serif'],
                            sans: ['"Work Sans"', 'sans-serif'],
                        },
                        colors: {
                            cream: { 50:'#FBF7EE',100:'#F5EDD9',200:'#EEE0BE',300:'#E4CE9B' },
                            ink:   { 700:'#3A2C22',800:'#2A1F18',900:'#1C140F',950:'#120D09' },
                            rust:  { 400:'#C15B3F',500:'#A3432E',600:'#8C3624',700:'#732B1C' },
                            brass: { 300:'#DDBA76',400:'#CBA050',500:'#B8863B',600:'#9C6E2D' },
                            olive: { 400:'#7A8267',500:'#5C6650',600:'#4A5340' },
                        }
                    }
                }
            }
        </script>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </x-slot>

    {{-- KONTEN UTAMA PROFIL --}}
    <div class="bg-cream-100 dark:bg-ink-950 text-ink-900 dark:text-cream-100 transition-colors duration-300 relative">
        <div class="grain-overlay"></div>

        <!-- ============ PAGE BANNER ============ -->
        <header class="relative bg-cover-fixed py-28 px-4 text-center overflow-hidden"
                style="background-image:linear-gradient(rgba(18,13,9,.55),rgba(18,13,9,.88)), url('{{ asset('images/gallery/bg.png') }}');">
            {{-- Ganti gambar di atas dengan foto motor klasik / garasi milik kalian sendiri,
                 simpan di public/images/about-banner.jpg agar tidak bergantung pada gambar luar --}}

            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-transparent via-brass-400 to-transparent"></div>

            <p class="font-story italic text-brass-300 mb-3 text-lg">Cerita Kami</p>
            <h1 class="font-display text-5xl sm:text-7xl text-cream-50 tracking-wide mb-5">TENTANG SUDUT LAWAS</h1>
            <p class="font-story text-cream-200/90 max-w-2xl mx-auto text-base sm:text-lg leading-relaxed">
                Di setiap perjalanan, selalu ada tempat untuk kembali.
                <span class="text-brass-300">Sudut Lawas</span> adalah tempat itu.
            </p>

            <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-transparent via-brass-400 to-transparent"></div>
        </header>

        <!-- Origin story -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="reveal order-2 md:order-1">
                    <p class="font-story text-xl italic text-rust-600 dark:text-brass-400 mb-2">Dari Mana Kami Berangkat</p>
                    <h2 class="font-display text-4xl text-gray-700 sm:text-5xl mb-5 tracking-wide">BERMULA DARI DERU MESIN TUA</h2>
                    <p class="leading-relaxed text-ink-700 dark:text-cream-300 mb-4">
                        Sudut Lawas lahir dari kecintaan sederhana pada motor klasik sebuah sudut kecil tempat deru mesin lama dan aroma oli masih terasa hidup. Di sinilah kaos-kaos vintage pilihan berkumpul, menunggu untuk melanjutkan cerita yang sudah mereka bawa sejak lama.
                    </p>
                    <p class="leading-relaxed text-ink-700 dark:text-cream-300">
                        Setiap kaos yang kami kurasi sudah melewati waktu, namun masih layak dipakai dan dihargai. Merawatnya kembali dan meletakkannya di rak toko adalah cara kami menghormati sejarah yang tersisa di dalamnya.
                    </p>
                </div>
                <div class="reveal order-1 md:order-2">
                    <img src="{{ asset('images/about-garasi.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&q=80&w=700'"
                         alt="Garasi klasik Sudut Lawas"
                         class="rounded-2xl shadow-xl object-cover h-96 w-full border-4 border-cream-50 dark:border-ink-800">
                </div>
            </div>
        </section>

        <div class="road-divider max-w-5xl mx-auto text-brass-500"></div>

        <!-- Komunitas Harley -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="reveal">
                    <img src="{{ asset('images/about-komunitas.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=700'"
                         alt="Komunitas motor Harley Sudut Lawas"
                         class="rounded-2xl shadow-xl object-cover h-96 w-full border-4 border-cream-50 dark:border-ink-800">
                </div>
                <div class="reveal">
                    <p class="font-story italic text-rust-600 text-xl dark:text-brass-400 mb-2">Lebih Dari Sekadar Toko</p>
                    <h2 class="font-display text-4xl sm:text-5xl mb-5 text-gray-700 tracking-wide">SEBUAH KOMUNITAS MOTOR HARLEY</h2>
                    <p class="leading-relaxed text-ink-700 dark:text-cream-300 mb-4">
                        Sudut Lawas tumbuh bersama para pengendara Harley-Davidson yang percaya bahwa perjalanan bukan sekadar jarak, melainkan cerita yang dibawa pulang. Setiap kumpul, setiap konvoi, dan setiap obrolan di garasi adalah bagian dari perjalanan itu.
                    </p>
                    <p class="leading-relaxed text-ink-700 dark:text-cream-300">
                        Kami membuka sudut ini sebagai tempat singgah bagi yang mencari kaos vintage bermakna, maupun bagi yang sekadar ingin berbagi cerita tentang motor klasik kesayangannya.
                    </p>
                </div>
            </div>
        </section>

        <!-- Visi & Misi -->
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-14 reveal">
                <p class="font-story italic text-rust-600 dark:text-brass-400 text-xl mb-2">Arah Langkah Kami</p>
                <h2 class="font-display text-4xl sm:text-5xl text-gray-700 tracking-wide">VISI &amp; MISI</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="patch-card bg-cream-50 dark:bg-ink-900 p-8 rounded-2xl border border-brass-500/10">
                    <h3 class="font-display text-2xl text-rust-600 dark:text-brass-400 mb-3 tracking-wide">VISI</h3>
                    <p class="text-sm text-ink-700 text-white leading-relaxed">
                        Menjadi wadah utama dan ruang temu bagi para pencinta otomotif klasik dan penikmat sandang vintage untuk merawat ingatan visual masa lalu melalui produk berkualitas tinggi.
                    </p>
                </div>
                <div class="patch-card bg-cream-50 dark:bg-ink-900 p-8 rounded-2xl border border-brass-500/10">
                    <h3 class="font-display text-2xl text-rust-600 dark:text-brass-400 mb-3 tracking-wide">MISI</h3>
                    <ul class="text-sm text-ink-700 text-white leading-relaxed list-disc list-inside space-y-2">
                        <li>Mengonfirmasi dan memverifikasi keaslian setiap produk kaos vintage secara ketat.</li>
                        <li>Menyediakan koleksi sandang bertema motor klasik yang bernilai sejarah dan estetika tinggi.</li>
                        <li>Mendukung sirkularitas fashion dengan merawat kembali pakaian lawas layak pakai.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Values -->
        <section class="bg-cream-200/60 dark:bg-ink-900/60 py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14 reveal">
                    <p class="font-story italic text-xl text-rust-600 dark:text-brass-400 mb-2">Nilai Yang Kami Pegang</p>
                    <h2 class="font-display text-4xl sm:text-5xl tracking-wide">PRINSIP DI SETIAP SUDUT</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="patch-card bg-cream-50 dark:bg-ink-950 p-6 reveal">
                        <h3 class="font-semibold text-gray-700 text-lg mb-2">Kejujuran Kondisi</h3>
                        <p class="text-sm text-ink-600 text-black leading-relaxed">Setiap cacat atau tanda usia dijelaskan apa adanya tidak ada yang ditutup-tutupi.</p>
                    </div>
                    <div class="patch-card bg-cream-50 dark:bg-ink-950 p-6 reveal">
                        <h3 class="font-semibold text-gray-700 text-lg mb-2">Hormat Pada Sejarah</h3>
                        <p class="text-sm text-ink-600 text-black leading-relaxed">Kami memperlakukan setiap kaos sebagai artefak budaya, bukan sekadar barang dagangan.</p>
                    </div>
                    <div class="patch-card bg-cream-50 dark:bg-ink-950 p-6 reveal">
                        <h3 class="font-semibold text-lg text-gray-700 mb-2">Komunitas Lebih Dulu</h3>
                        <p class="text-sm text-ink-600 dark:text-black leading-relaxed">Kami tumbuh bersama klub motor Harley dan komunitas vintage di seluruh Indonesia.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan Produk -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12 reveal">
                <p class="font-story italic text-xl text-rust-600 dark:text-brass-400 mb-2">Standar Kurasi</p>
                <h2 class="font-display text-4xl sm:text-5xl text-gray-700 tracking-wide">KENAPA MEMILIH PRODUK KAMI?</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-cream-50 dark:bg-ink-900 p-6 rounded-xl border border-brass-500/20 text-center">
                    <div class="text-rust-600 dark:text-brass-400 font-display text-3xl mb-2">01</div>
                    <h4 class="font-semibold mb-1 text-base">Garansi Otentik</h4>
                    <p class="text-xs text-ink-600 dark:text-cream-400 leading-relaxed">Setiap kaos vintage dipastikan keaslian era produksinya melalui cek tag dan jahitan.</p>
                </div>
                <div class="bg-cream-50 dark:bg-ink-900 p-6 rounded-xl border border-brass-500/20 text-center">
                    <div class="text-rust-600 dark:text-brass-400 font-display text-3xl mb-2">02</div>
                    <h4 class="font-semibold mb-1 text-base">Siap Pakai</h4>
                    <p class="text-xs text-ink-600 dark:text-cream-400 leading-relaxed">Sudah melalui proses cuci higienis dan treatment khusus agar bebas dari bau apek gudang.</p>
                </div>
                <div class="bg-cream-50 dark:bg-ink-900 p-6 rounded-xl border border-brass-500/20 text-center">
                    <div class="text-rust-600 dark:text-brass-400 font-display text-3xl mb-2">03</div>
                    <h4 class="font-semibold mb-1 text-base">Karakter Khas</h4>
                    <p class="text-xs text-ink-600 dark:text-cream-400 leading-relaxed">Efek pudar alami (fading) dan crack sablon asli bawaan waktu yang tidak bisa ditiru kaos baru.</p>
                </div>
                <div class="bg-cream-50 dark:bg-ink-900 p-6 rounded-xl border border-brass-500/20 text-center">
                    <div class="text-rust-600 dark:text-brass-400 font-display text-3xl mb-2">04</div>
                    <h4 class="font-semibold mb-1 text-base">Koleksi Terbatas</h4>
                    <p class="text-xs text-ink-600 dark:text-cream-400 leading-relaxed">Satu desain umumnya hanya tersedia satu potong. Benar-benar eksklusif untuk Anda.</p>
                </div>
            </div>
        </section>

        <div class="road-divider max-w-5xl mx-auto text-brass-500"></div>

        <!-- ============ GALERI ============ -->
        @php
            // Sediakan variabel $galleries dari controller berupa array/collection:
            // [['image' => 'images/gallery/1.jpg', 'caption' => 'Kopdar akhir pekan'], ...]
            // Simpan foto asli di: public/images/gallery/
            // (kalau nanti mau dikelola lewat admin panel, lebih baik pindah ke
            //  storage/app/public/gallery lalu jalankan `php artisan storage:link`)
            $galleryItems = $galleries ?? collect([
                ['image' => 'images/gallery/1.jpg', 'caption' => 'Kopdar rutin akhir pekan'],
                ['image' => 'images/gallery/2.jpg', 'caption' => 'Konvoi menuju Bromo'],
                ['image' => 'images/gallery/3.jpg', 'caption' => 'Koleksi kaos vintage terbaru'],
                ['image' => 'images/gallery/4.jpg', 'caption' => 'Servis rutin di garasi'],
                ['image' => 'images/gallery/5.jpg', 'caption' => 'Sesi ngopi bareng klub'],
                ['image' => 'images/gallery/6.jpg', 'caption' => 'Detail jahitan kaos original'],
                ['image' => 'images/gallery/7.jpg', 'caption' => 'Meet up komunitas Harley'],
                ['image' => 'images/gallery/8.jpg', 'caption' => 'Sudut garasi Sudut Lawas'],
                ['image' => 'images/gallery/9.jpg', 'caption' => 'Perjalanan panjang, cerita panjang'],
            ]);
            $galleryTotal = count($galleryItems);
            $galleryInitialLimit = 8;
        @endphp

        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24" id="galeri">
            <div class="text-center mb-16 reveal">
                <p class="font-story text-xl italic text-rust-600 dark:text-brass-400 mb-2">Sepotong Ingatan</p>
                <h2 class="font-display text-gray-700 text-4xl sm:text-5xl tracking-wide">GALERI SUDUT LAWAS</h2>
                <p class="mt-3 text-sm text-ink-600 dark:text-black max-w-xl mx-auto leading-relaxed">
                    Potongan momen dari garasi, konvoi, dan kumpul rutin komunitas.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
                @foreach ($galleryItems as $index => $item)
                    @php
                        $rotations = ['-rotate-2', 'rotate-1', 'rotate-2', '-rotate-1'];
                        $rotate = $rotations[$index % count($rotations)];
                        $isExtra = $index >= $galleryInitialLimit;
                    @endphp
                    <button type="button"
                        data-gallery-trigger
                        data-index="{{ $index }}"
                        data-full="{{ asset($item['image']) }}"
                        data-caption="{{ $item['caption'] ?? '' }}"
                        class="gallery-item group relative {{ $isExtra ? 'hidden' : '' }} {{ $rotate }} transition duration-300 hover:rotate-0 hover:-translate-y-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass-400 rounded-sm">
                        <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 z-10 h-4 w-4 rounded-full bg-brass-400 shadow-sm border border-brass-600/40"></span>
                        <span class="block bg-cream-50 dark:bg-ink-900 p-2 pb-6 shadow-lg group-hover:shadow-2xl transition duration-300">
                            <span class="block aspect-[4/5] w-full overflow-hidden bg-ink-900/5">
                                <img src="{{ asset($item['image']) }}"
                                     onerror="this.src='https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&q=80&w=500'"
                                     alt="{{ $item['caption'] ?? 'Galeri Sudut Lawas' }}"
                                     loading="lazy"
                                     class="h-full w-full object-cover">
                            </span>
                            @if (!empty($item['caption']))
                                <span class="mt-2 block font-story italic text-[11px] text-ink-600 dark:text-cream-400 text-center leading-snug px-1">
                                    {{ $item['caption'] }}
                                </span>
                            @endif
                        </span>
                    </button>
                @endforeach
            </div>

            @if ($galleryTotal > $galleryInitialLimit)
            @endif
        </section>

        {{-- Lightbox untuk melihat foto galeri secara penuh --}}
        <div id="gallery-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-ink-950/90 backdrop-blur-sm px-4">
            <button type="button" id="gallery-lightbox-close" class="absolute top-5 right-5 text-cream-100/80 hover:text-cream-50">
                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <button type="button" id="gallery-lightbox-prev" class="absolute left-3 sm:left-6 text-cream-100/70 hover:text-cream-50">
                <svg class="h-9 w-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="max-w-3xl w-full">
                <img id="gallery-lightbox-image" src="" alt="" class="w-full max-h-[75vh] object-contain rounded-md shadow-2xl">
                <p id="gallery-lightbox-caption" class="mt-4 text-center font-story italic text-cream-200/90 text-sm"></p>
            </div>

            <button type="button" id="gallery-lightbox-next" class="absolute right-3 sm:right-6 text-cream-100/70 hover:text-cream-50">
                <svg class="h-9 w-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mengirimkan Script animasi/interaksi kustom ke bagian bawah layout --}}
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script>
            (function () {
                var toggleBtn = document.getElementById('gallery-toggle');
                var toggleIcon = document.getElementById('gallery-toggle-icon');
                var items = Array.prototype.slice.call(document.querySelectorAll('.gallery-item'));
                var expanded = false;

                if (toggleBtn) {
                    toggleBtn.addEventListener('click', function () {
                        expanded = !expanded;
                        items.forEach(function (item) {
                            if (item.classList.contains('hidden') || expanded === false) {
                                // biarkan logic di bawah yang menentukan
                            }
                        });
                        items.forEach(function (item) {
                            var idx = parseInt(item.getAttribute('data-index'), 10);
                            if (idx >= {{ $galleryInitialLimit }}) {
                                item.classList.toggle('hidden', !expanded);
                            }
                        });
                        toggleBtn.firstChild.textContent = expanded
                            ? toggleBtn.getAttribute('data-label-less') + ' '
                            : toggleBtn.getAttribute('data-label-more') + ' ';
                        toggleIcon.style.transform = expanded ? 'rotate(180deg)' : 'rotate(0deg)';
                    });
                }

                // Lightbox
                var lightbox = document.getElementById('gallery-lightbox');
                var lightboxImage = document.getElementById('gallery-lightbox-image');
                var lightboxCaption = document.getElementById('gallery-lightbox-caption');
                var closeBtn = document.getElementById('gallery-lightbox-close');
                var prevBtn = document.getElementById('gallery-lightbox-prev');
                var nextBtn = document.getElementById('gallery-lightbox-next');
                var currentIndex = 0;

                function openLightbox(index) {
                    var item = items[index];
                    if (!item) return;
                    currentIndex = index;
                    lightboxImage.src = item.getAttribute('data-full');
                    lightboxImage.alt = item.getAttribute('data-caption') || '';
                    lightboxCaption.textContent = item.getAttribute('data-caption') || '';
                    lightbox.classList.remove('hidden');
                    lightbox.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }

                function closeLightbox() {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                    document.body.style.overflow = '';
                }

                function showRelative(offset) {
                    var nextIndex = (currentIndex + offset + items.length) % items.length;
                    openLightbox(nextIndex);
                }

                items.forEach(function (item, index) {
                    item.addEventListener('click', function () {
                        openLightbox(index);
                    });
                });

                if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
                if (prevBtn) prevBtn.addEventListener('click', function () { showRelative(-1); });
                if (nextBtn) nextBtn.addEventListener('click', function () { showRelative(1); });

                if (lightbox) {
                    lightbox.addEventListener('click', function (e) {
                        if (e.target === lightbox) closeLightbox();
                    });
                }

                document.addEventListener('keydown', function (e) {
                    if (lightbox.classList.contains('hidden')) return;
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowLeft') showRelative(-1);
                    if (e.key === 'ArrowRight') showRelative(1);
                });
            })();
        </script>
    </x-slot>
</x-shop.layout>