<x-shop.layout title="Tentang Kami">

    <div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Tentang {{ setting('site_name', config('app.name')) }}
        </h1>

        <div class="prose prose-sm sm:prose-base mt-6 max-w-none text-gray-600">
            <p>{{ setting('site_description', 'Tuliskan cerita singkat tentang toko ini di sini.') }}</p>
            <p>
                Ganti paragraf ini dengan informasi tentang toko Anda: sejarah singkat, keunggulan produk,
                atau apa pun yang ingin ditonjolkan ke pembeli.
            </p>
        </div>

        @if (setting('whatsapp'))
            <a href="{{ waGeneralLink() }}" target="_blank" rel="noopener"
                class="mt-8 inline-flex items-center gap-2 rounded-full bg-[var(--shop-primary)] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:brightness-90">
                Hubungi Kami
            </a>
        @endif
    </div>
</x-shop.layout>
