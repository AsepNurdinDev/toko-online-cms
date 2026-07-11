<x-shop.layout>
    {{-- Hero / banner slider — komponen sendiri di components/shop/hero-banner.blade.php,
         edit di sana kalau perlu ubah tampilan hero untuk semua halaman. --}}
    <x-shop.hero-banner :banners="$banners" />

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        <!-- Categories -->
        @if ($categories->isNotEmpty())
            <section class="mb-12">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-700">Kategori</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                    @foreach ($categories as $category)
                        @php
                            $slug = strtolower($category->slug ?? $category->name);

                            $iconType = match (true) {
                                str_contains($slug, 'kaos') || str_contains($slug, 't-shirt') || str_contains($slug, 'tshirt') => 'kaos',
                                str_contains($slug, 'jaket') || str_contains($slug, 'baju') || str_contains($slug, 'hoodie') || str_contains($slug, 'kemeja') => 'jaket',
                                str_contains($slug, 'helm') => 'helm',
                                str_contains($slug, 'sarung-tangan') || str_contains($slug, 'gloves') => 'sarung-tangan',
                                str_contains($slug, 'aksesoris') || str_contains($slug, 'perlengkapan') || str_contains($slug, 'gear') => 'perlengkapan',
                                default => 'default',
                            };
                        @endphp

                        <a href="{{ route('shop.products', ['kategori' => $category->slug]) }}"
                            class="flex flex-col items-center gap-2 rounded-xl border border-gray-100 bg-white p-4 text-center shadow-sm transition hover:border-[var(--shop-primary)]/40 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[var(--shop-primary-soft)] text-[var(--shop-primary)]">
                                @switch($iconType)
                                    @case('kaos')
                                        {{-- Ikon kaos --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 4L4 7l2 3 2-1.2V20h8V8.8L18 10l2-3-4-3-2 1.5h-4L8 4z" />
                                        </svg>
                                        @break

                                    @case('jaket')
                                        {{-- Ikon jaket / baju berkerah --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 4l3 2 3-2 5 3-1.5 3.5L17 10v10H7V10l-1.5.5L4 7l5-3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 4v6M15 4v6" />
                                        </svg>
                                        @break

                                    @case('helm')
                                        {{-- Ikon helm --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 14a8 8 0 0116 0v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15h6M4 13.5h4M16 13.5h4" />
                                        </svg>
                                        @break

                                    @case('sarung-tangan')
                                        {{-- Ikon sarung tangan --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 10V6a1.5 1.5 0 013 0v3M10 9V5a1.5 1.5 0 013 0v4M13 9V6a1.5 1.5 0 013 0v4.5M16 10.5V8a1.5 1.5 0 013 0v6a5 5 0 01-5 5H10a5 5 0 01-5-5v-3l1-1" />
                                        </svg>
                                        @break

                                    @case('perlengkapan')
                                        {{-- Ikon perlengkapan / aksesoris (kotak gear) --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        @break

                                    @default
                                        {{-- Ikon default untuk kategori lain --}}
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10" />
                                        </svg>
                                @endswitch
                            </span>
                            <span class="text-xs font-medium text-gray-600">{{ $category->name }}</span>
                            <span class="text-[11px] text-gray-400">{{ $category->products_count }} produk</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Featured products -->
        @if ($featuredProducts->isNotEmpty())
            <section class="mb-12">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-700">Produk Unggulan</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($featuredProducts as $product)
                        <x-shop.product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Latest products -->
        @if ($latestProducts->isNotEmpty())
            <section>
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-700">Produk Terbaru</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($latestProducts as $product)
                        <x-shop.product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        @if ($categories->isEmpty() && $featuredProducts->isEmpty() && $latestProducts->isEmpty())
            <div class="rounded-2xl border border-dashed border-gray-200 py-20 text-center">
                <p class="text-sm font-medium text-gray-700">Belum ada produk tersedia</p>
                <p class="mt-1 text-sm text-gray-400">Silakan cek kembali nanti.</p>
            </div>
        @endif
    </div>
</x-shop.layout>