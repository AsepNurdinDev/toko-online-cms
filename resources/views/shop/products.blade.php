<x-shop-layout title="Semua Produk">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="mb-4 text-xs text-gray-500">
            <a href="{{ route('shop.home') }}" class="hover:text-amber-600">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $activeCategory->name ?? 'Semua Produk' }}</span>
        </nav>

        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">
            {{ $activeCategory->name ?? 'Semua Produk' }}
        </h1>
        @if (request('q'))
            <p class="mt-1 text-sm text-gray-500">Hasil pencarian untuk "{{ request('q') }}"</p>
        @endif

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-4">

            <!-- Sidebar filter -->
            <aside class="lg:col-span-1">
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h3 class="mb-3 text-sm font-semibold text-gray-900">Kategori</h3>
                    <ul class="space-y-1 text-sm">
                        <li>
                            <a href="{{ route('shop.products', array_filter(['q' => request('q')])) }}"
                                class="block rounded-md px-2.5 py-1.5 {{ ! $activeCategory ? 'bg-amber-50 font-medium text-amber-700' : 'text-gray-600 hover:bg-gray-50' }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('shop.products', array_filter(['kategori' => $category->slug, 'q' => request('q')])) }}"
                                    class="block rounded-md px-2.5 py-1.5 {{ $activeCategory && $activeCategory->id === $category->id ? 'bg-amber-50 font-medium text-amber-700' : 'text-gray-600 hover:bg-gray-50' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Product grid -->
            <div class="lg:col-span-3">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-500">{{ $products->total() }} produk ditemukan</p>

                    <form method="GET" class="flex items-center gap-2">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <label for="sort" class="text-sm text-gray-500">Urutkan:</label>
                        <select id="sort" name="sort" onchange="this.form.submit()"
                            class="rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                            <option value="termurah" @selected($sort === 'termurah')>Harga Terendah</option>
                            <option value="termahal" @selected($sort === 'termahal')>Harga Tertinggi</option>
                        </select>
                    </form>
                </div>

                @if ($products->isNotEmpty())
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="rounded-2xl border border-dashed border-gray-200 py-20 text-center">
                        <p class="text-sm font-medium text-gray-900">Produk tidak ditemukan</p>
                        <p class="mt-1 text-sm text-gray-500">Coba kata kunci atau kategori lain.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-shop-layout>
