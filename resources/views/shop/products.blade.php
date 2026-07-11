<x-shop.layout title="Semua Produk">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8" x-data="{ filterOpen: false }">

        <!-- Breadcrumb -->
        <nav class="mb-3 flex items-center gap-1.5 text-xs text-gray-500">
            <a href="{{ route('shop.home') }}" class="flex items-center gap-1 transition hover:text-[var(--shop-primary-dark)]">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7m-14 0v8a1 1 0 001 1h3m10-9l2 2m-2-2v8a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>
            <svg class="h-3 w-3 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            <span class="truncate font-medium text-gray-700">{{ $activeCategory->name ?? 'Semua Produk' }}</span>
        </nav>

        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
            <div class="min-w-0">
                <h1 class="truncate text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    {{ $activeCategory->name ?? 'Semua Produk' }}
                </h1>
                @if (request('q'))
                    <p class="mt-1 text-sm text-gray-500">
                        Hasil pencarian untuk <span class="font-medium text-gray-700">"{{ request('q') }}"</span>
                    </p>
                @endif
            </div>

            <!-- Tombol filter (mobile only) -->
            <button @click="filterOpen = true"
                class="mt-3 inline-flex shrink-0 items-center justify-center gap-2 text-black rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 sm:hidden">
                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M6 9h12M9.75 13.5h4.5M11.25 18h1.5" />
                </svg>
                Filter Kategori
            </button>
        </div>

        <!-- Chip filter aktif -->
        @if (request('q') || $activeCategory ?? null)
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <span class="text-xs font-medium uppercase tracking-wide text-gray-500">Filter aktif:</span>

                @if ($activeCategory ?? null)
                    <a href="{{ route('shop.products', array_filter(['q' => request('q')])) }}"
                        class="inline-flex items-center gap-1.5 rounded-full bg-[var(--shop-primary-soft)] py-1 pl-3 pr-2 text-xs font-medium text-[var(--shop-primary-dark)] transition hover:brightness-95">
                        {{ $activeCategory->name }}
                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif

                @if (request('q'))
                    <a href="{{ route('shop.products', array_filter(['kategori' => request('kategori')])) }}"
                        class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 py-1 pl-3 pr-2 text-xs font-medium text-gray-700 transition hover:bg-gray-200">
                        "{{ request('q') }}"
                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif

                <a href="{{ route('shop.products') }}" class="text-xs font-medium text-gray-500 hover:text-gray-700 hover:underline">
                    Hapus semua
                </a>
            </div>
        @endif

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-4">

            <!-- Sidebar filter (desktop) -->
            <aside class="hidden lg:col-span-1 lg:block">
                <div class="sticky top-24 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h3 class="mb-3 flex items-center gap-2 text-sm font-semibold text-gray-900">
                        <svg class="h-4 w-4 text-[var(--shop-primary-dark)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M6 9h12M9.75 13.5h4.5M11.25 18h1.5" />
                        </svg>
                        Kategori
                    </h3>
                    <ul class="space-y-1 text-sm">
                        <li>
                            <a href="{{ route('shop.products', array_filter(['q' => request('q')])) }}"
                                class="group flex items-center justify-between rounded-lg px-3 py-2 transition {{ ! ($activeCategory ?? null) ? 'bg-[var(--shop-primary-soft)] font-semibold text-[var(--shop-primary-dark)]' : 'text-gray-600 hover:bg-gray-50' }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('shop.products', array_filter(['kategori' => $category->slug, 'q' => request('q')])) }}"
                                    class="group flex items-center justify-between rounded-lg px-3 py-2 transition {{ ($activeCategory->id ?? null) === $category->id ? 'bg-[var(--shop-primary-soft)] font-semibold text-[var(--shop-primary-dark)]' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <span class="truncate">{{ $category->name }}</span>
                                    @isset($category->products_count)
                                        <span class="ml-2 shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-[11px] text-gray-500 group-hover:bg-white">
                                            {{ $category->products_count }}
                                        </span>
                                    @endisset
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Drawer filter (mobile) -->
            <div x-show="filterOpen" x-transition.opacity @click="filterOpen = false"
                class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" style="display: none;"></div>

            <aside x-show="filterOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed inset-y-0 right-0 z-50 w-[85%] max-w-sm overflow-y-auto bg-white p-5 shadow-xl lg:hidden"
                style="display: none;">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-900">Filter Kategori</h3>
                    <button @click="filterOpen = false" class="rounded-md p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <ul class="space-y-1 text-sm">
                    <li>
                        <a href="{{ route('shop.products', array_filter(['q' => request('q')])) }}"
                            class="flex items-center justify-between rounded-lg px-3 py-2.5 {{ ! ($activeCategory ?? null) ? 'bg-[var(--shop-primary-soft)] font-semibold text-[var(--shop-primary-dark)]' : 'text-gray-600 hover:bg-gray-50' }}">
                            Semua Kategori
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('shop.products', array_filter(['kategori' => $category->slug, 'q' => request('q')])) }}"
                                class="flex items-center justify-between rounded-lg px-3 py-2.5 {{ ($activeCategory->id ?? null) === $category->id ? 'bg-[var(--shop-primary-soft)] font-semibold text-[var(--shop-primary-dark)]' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <!-- Product grid -->
            <div class="lg:col-span-3">
                <div class="mb-5 flex flex-col gap-3 rounded-xl border border-gray-100 bg-white px-4 py-3 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-500">
                        <span class="font-semibold text-gray-900">{{ $products->total() }}</span> produk ditemukan
                    </p>

                    <form method="GET" class="flex items-center gap-2">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <label for="sort" class="shrink-0 text-sm text-gray-500">Urutkan</label>
                        <div class="relative min-w-0 flex-1 sm:flex-none">
                            <select id="sort" name="sort" onchange="this.form.submit()"
                                class="w-full appearance-none rounded-lg border-gray-200 bg-gray-50 py-2 pl-3 pr-8 text-sm font-medium text-gray-700 shadow-sm focus:border-[var(--shop-primary-dark)] focus:bg-white focus:ring-[var(--shop-primary-dark)]">
                                <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                                <option value="termurah" @selected($sort === 'termurah')>Harga Terendah</option>
                                <option value="termahal" @selected($sort === 'termahal')>Harga Tertinggi</option>
                            </select>
                            <svg class="pointer-events-none absolute right-2.5 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </form>
                </div>

                @if ($products->isNotEmpty())
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 xl:grid-cols-4">
                        @foreach ($products as $product)
                            <x-shop.product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="flex flex-col items-center rounded-2xl border border-dashed border-gray-200 bg-white py-20 text-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-50 text-gray-300">
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-sm font-medium text-gray-900">Produk tidak ditemukan</p>
                        <p class="mt-1 text-sm text-gray-500">Coba kata kunci atau kategori lain.</p>
                        {{-- Pakai shop-primary-dark sebagai background tombol (bukan shop-primary mentah)
                             supaya teks putih di atasnya tetap terbaca walau warna tema klien terang/pastel --}}
                        <a href="{{ route('shop.products') }}"
                            class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-[var(--shop-primary-dark)] px-4 py-2 text-xs font-semibold text-white transition hover:brightness-110">
                            Lihat Semua Produk
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-shop.layout>