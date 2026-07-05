<x-shop-layout>
    {{-- Hero / banner slider — komponen sendiri di components/shop/hero-banner.blade.php,
         edit di sana kalau perlu ubah tampilan hero untuk semua halaman. --}}
    <x-shop.hero-banner :banners="$banners" />

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        <!-- Categories -->
        @if ($categories->isNotEmpty())
            <section class="mb-12">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Kategori</h2>
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                    @foreach ($categories as $category)
                        <a href="{{ route('shop.products', ['kategori' => $category->slug]) }}"
                            class="flex flex-col items-center gap-2 rounded-xl border border-gray-100 bg-white p-4 text-center shadow-sm transition hover:border-[var(--shop-primary)] hover:shadow-md">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[var(--shop-primary-soft)] text-[var(--shop-primary)]">
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
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
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
                    <a href="{{ route('shop.products') }}" class="text-sm font-medium text-[var(--shop-primary)] hover:underline">Lihat semua &rarr;</a>
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
