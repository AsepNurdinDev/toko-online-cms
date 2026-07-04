<x-shop-layout>
    <!-- Hero / Banner slider -->
    @if ($banners->isNotEmpty())
        <section class="relative" x-data="{ active: 0, total: {{ $banners->count() }} }" x-init="setInterval(() => active = (active + 1) % total, 5000)">
            <div class="relative aspect-[16/7] w-full overflow-hidden sm:aspect-[21/7]">
                @foreach ($banners as $index => $banner)
                    <div x-show="active === {{ $index }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="absolute inset-0" style="{{ $index === 0 ? '' : 'display:none;' }}">
                        <img src="{{ storageUrl($banner->image) }}" alt="{{ $banner->title }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end sm:items-center">
                            <div class="mx-auto w-full max-w-7xl px-4 pb-8 sm:px-6 sm:pb-0 lg:px-8">
                                <div class="max-w-md text-white">
                                    <h2 class="text-2xl font-extrabold sm:text-4xl">{{ $banner->title }}</h2>
                                    @if ($banner->subtitle)
                                        <p class="mt-2 text-sm text-white/90 sm:text-base">{{ $banner->subtitle }}</p>
                                    @endif
                                    @if ($banner->button_text)
                                        <a href="{{ $banner->button_link ?: route('shop.products') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-full bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:bg-amber-600">
                                            {{ $banner->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($banners->count() > 1)
                <div class="absolute bottom-3 left-1/2 z-10 flex -translate-x-1/2 gap-1.5">
                    @foreach ($banners as $index => $banner)
                        <button @click="active = {{ $index }}"
                            :class="active === {{ $index }} ? 'w-6 bg-white' : 'w-2 bg-white/50'"
                            class="h-2 rounded-full transition-all"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        <section class="bg-gradient-to-br from-amber-500 to-orange-600 py-16 text-center text-white">
            <h2 class="text-3xl font-extrabold sm:text-4xl">{{ setting('hero_title', 'Selamat Datang') }}</h2>
            <p class="mt-2 text-white/90">{{ setting('hero_subtitle', 'Temukan produk terbaik untuk Anda') }}</p>
        </section>
    @endif

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        <!-- Categories -->
        @if ($categories->isNotEmpty())
            <section class="mb-12">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Kategori</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-amber-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                    @foreach ($categories as $category)
                        <a href="{{ route('shop.products', ['kategori' => $category->slug]) }}"
                            class="flex flex-col items-center gap-2 rounded-xl border border-gray-100 bg-white p-4 text-center shadow-sm transition hover:border-amber-300 hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-50 text-amber-600">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </span>
                            <span class="text-xs font-medium text-gray-700">{{ $category->name }}</span>
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
                    <h2 class="text-lg font-bold text-gray-900">Produk Unggulan</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-amber-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Latest products -->
        @if ($latestProducts->isNotEmpty())
            <section>
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Produk Terbaru</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-amber-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($latestProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        @if ($categories->isEmpty() && $featuredProducts->isEmpty() && $latestProducts->isEmpty())
            <div class="rounded-2xl border border-dashed border-gray-200 py-20 text-center">
                <p class="text-sm font-medium text-gray-900">Belum ada produk tersedia</p>
                <p class="mt-1 text-sm text-gray-500">Silakan cek kembali nanti.</p>
            </div>
        @endif
    </div>
</x-shop-layout>
