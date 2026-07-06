@props(['banners'])

@if ($banners->isNotEmpty())
    <section class="relative bg-gray-900" x-data="{ active: 0, total: {{ $banners->count() }} }"
        @if ($banners->count() > 1) x-init="setInterval(() => active = (active + 1) % total, 5000)" @endif>

        <div class="relative aspect-[4/3] w-full overflow-hidden sm:aspect-[16/7] lg:aspect-[21/7]">
            @foreach ($banners as $index => $banner)
                <div x-show="active === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="absolute inset-0" style="{{ $index === 0 ? '' : 'display:none;' }}">

                    <!-- Gambar banner -->
                    <img src="{{ storageUrl($banner->image) }}" alt="{{ $banner->title ?: 'Banner' }}"
                        class="h-full w-full object-cover">

                    @php $hasText = $banner->title || $banner->subtitle || $banner->button_text; @endphp

                    @if ($hasText)
                        <!-- Scrim: gradasi gelap dari bawah & kiri, memastikan gambar tidak pernah "bentrok" dengan teks -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute inset-0 hidden bg-gradient-to-r from-black/60 via-black/10 to-transparent sm:block"></div>

                        <!-- Konten teks: diberi panel semi-transparan + blur supaya tetap terbaca di atas gambar apa pun -->
                        <div class="absolute inset-0 flex items-end sm:items-center">
                            <div class="mx-auto w-full max-w-7xl px-4 pb-6 sm:px-6 sm:pb-0 lg:px-8">
                                <div class="max-w-md rounded-2xl bg-black/25 p-4 text-white backdrop-blur-sm sm:bg-transparent sm:p-0 sm:backdrop-blur-0">
                                    @if ($banner->title)
                                        <h2 class="line-clamp-2 text-xl font-extrabold leading-tight drop-shadow-sm sm:text-3xl lg:text-4xl">
                                            {{ $banner->title }}
                                        </h2>
                                    @endif
                                    @if ($banner->subtitle)
                                        <p class="mt-2 line-clamp-2 text-sm text-white/90 drop-shadow-sm sm:text-base">
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif
                                    @if ($banner->button_text)
                                        <a href="{{ $banner->button_link ?: route('shop.products') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-full bg-[var(--shop-primary)] px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:brightness-90 sm:mt-5">
                                            {{ $banner->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if ($banners->count() > 1)
            <div class="absolute bottom-3 left-1/2 z-10 flex -translate-x-1/2 gap-1.5">
                @foreach ($banners as $index => $banner)
                    <button @click="active = {{ $index }}" aria-label="Slide {{ $index + 1 }}"
                        :class="active === {{ $index }} ? 'w-6 bg-white' : 'w-2 bg-white/50'"
                        class="h-2 rounded-full transition-all"></button>
                @endforeach
            </div>
        @endif
    </section>
@else
    <section class="bg-gradient-to-br from-[var(--shop-primary)] to-[var(--shop-primary-dark)] py-16 text-center text-white">
        <h2 class="text-3xl font-extrabold sm:text-4xl">{{ setting('hero_title', 'Selamat Datang') }}</h2>
        <p class="mt-2 text-white/90">{{ setting('hero_subtitle', 'Temukan produk terbaik untuk Anda') }}</p>
    </section>
@endif
