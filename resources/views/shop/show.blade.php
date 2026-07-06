@php
    $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
    $displayPrice = $hasDiscount ? $product->discount_price : $product->price;
    $waPhone = normalizeWhatsappNumber(setting('whatsapp'));
    $waMessageTemplate = "Halo ".setting('site_name', config('app.name')).", saya ingin memesan produk berikut:\n\n"
        ."*{$product->name}*\n"
        ."Jumlah: __QTY__\n"
        ."Harga satuan: ".rupiah($displayPrice)."\n"
        ."Subtotal: __SUBTOTAL__\n\n"
        ."Link produk: ".route('shop.show', $product->slug)."\n\n"
        ."Mohon info ketersediaan stok dan total pembayarannya. Terima kasih!";
@endphp

<x-shop.layout :title="$product->name">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs text-gray-500">
            <a href="{{ route('shop.home') }}" class="hover:text-[var(--shop-primary)]">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('shop.products') }}" class="hover:text-[var(--shop-primary)]">Produk</a>
            @if ($product->category)
                <span class="mx-1">/</span>
                <a href="{{ route('shop.products', ['kategori' => $product->category->slug]) }}" class="hover:text-[var(--shop-primary)]">{{ $product->category->name }}</a>
            @endif
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">

            <!-- Galeri Foto -->
            @php $galleryImages = $product->images ?? collect(); @endphp
            <div x-data="{ active: 0, images: {{ Illuminate\Support\Js::from(
                    $galleryImages->isNotEmpty()
                        ? $galleryImages->pluck('image')->map(fn ($img) => storageUrl($img))->prepend(storageUrl($product->thumbnail, 'images/no-image.png'))
                        : [storageUrl($product->thumbnail, 'images/no-image.png')]
                ) }} }">
                <div class="aspect-square overflow-hidden rounded-2xl border border-gray-100 bg-gray-100">
                    <img :src="images[active]" alt="{{ $product->name }}" class="h-full w-full object-cover">
                </div>

                @if ($galleryImages->isNotEmpty())
                    <div class="mt-3 flex gap-3 overflow-x-auto pb-1">
                        <template x-for="(image, index) in images" :key="index">
                            <button type="button" @click="active = index"
                                class="h-16 w-16 shrink-0 overflow-hidden rounded-lg border-2 transition"
                                :class="active === index ? 'border-[var(--shop-primary)]' : 'border-transparent opacity-70 hover:opacity-100'">
                                <img :src="image" class="h-full w-full object-cover">
                            </button>
                        </template>
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div x-data="{
                    qty: 1,
                    stock: {{ (int) $product->stock }},
                    price: {{ (float) $displayPrice }},
                    phone: '{{ $waPhone }}',
                    template: {{ Illuminate\Support\Js::from($waMessageTemplate) }},
                    get subtotal() { return this.qty * this.price },
                    get waLink() {
                        const msg = this.template
                            .replace('__QTY__', this.qty)
                            .replace('__SUBTOTAL__', this.formatRupiah(this.subtotal));
                        return 'https://wa.me/' + this.phone + '?text=' + encodeURIComponent(msg);
                    },
                    formatRupiah(v) {
                        return 'Rp ' + Math.round(v).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    },
                    inc() { if (this.qty < this.stock) this.qty++ },
                    dec() { if (this.qty > 1) this.qty-- }
                }">
                @if ($product->category)
                    <span class="text-xs font-semibold uppercase tracking-wide text-[var(--shop-primary)]">{{ $product->category->name }}</span>
                @endif

                <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl">{{ $product->name }}</h1>

                <div class="mt-4 flex items-baseline gap-3">
                    <span class="text-2xl font-extrabold text-gray-900">{{ rupiah($displayPrice) }}</span>
                    @if ($hasDiscount)
                        <span class="text-base text-gray-400 line-through">{{ rupiah($product->price) }}</span>
                        <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">
                            Hemat {{ discountPercentage($product->price, $product->discount_price) }}%
                        </span>
                    @endif
                </div>

                <p class="mt-2 text-sm {{ $product->stock > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $product->stock > 0 ? 'Stok tersedia: '.$product->stock : 'Stok habis' }}
                </p>

                @if ($product->description)
                    <div class="prose prose-sm mt-6 max-w-none text-gray-600">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @endif

                @if ($product->stock > 0)
                    <div class="mt-8 flex items-center gap-4">
                        <span class="text-sm font-medium text-gray-700">Jumlah</span>
                        <div class="flex items-center rounded-lg border border-gray-200">
                            <button type="button" @click="dec()" class="px-3 py-2 text-gray-600 hover:bg-gray-50">−</button>
                            <span class="w-10 text-center text-sm font-medium" x-text="qty"></span>
                            <button type="button" @click="inc()" class="px-3 py-2 text-gray-600 hover:bg-gray-50">+</button>
                        </div>
                    </div>

                    <div class="mt-2 text-sm text-gray-500">
                        Subtotal: <span class="font-semibold text-gray-900" x-text="formatRupiah(subtotal)"></span>
                    </div>

                    <a :href="waLink" target="_blank" rel="noopener"
                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-6 py-3.5 text-sm font-semibold text-white shadow-md transition hover:bg-emerald-600 sm:w-auto sm:px-10">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.15-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 5.001L2 22l5.117-1.341a9.958 9.958 0 0 0 4.887 1.244h.004c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.181-2.929-7.07a9.935 9.935 0 0 0-7.072-2.833zm0 18.187h-.003a8.184 8.184 0 0 1-4.166-1.14l-.299-.177-3.037.796.81-2.96-.194-.304a8.176 8.176 0 0 1-1.255-4.375c0-4.523 3.68-8.203 8.204-8.203a8.15 8.15 0 0 1 5.802 2.405 8.15 8.15 0 0 1 2.399 5.803c0 4.524-3.68 8.203-8.204 8.203z"/></svg>
                        Pesan via WhatsApp
                    </a>
                @else
                    <button disabled class="mt-8 w-full cursor-not-allowed rounded-xl bg-gray-100 px-6 py-3.5 text-sm font-semibold text-gray-400 sm:w-auto sm:px-10">
                        Stok Habis
                    </button>
                @endif

                <p class="mt-3 text-xs text-gray-400">
                    Pemesanan diproses langsung lewat chat WhatsApp — Anda akan diarahkan ke aplikasi WhatsApp dengan pesan yang sudah terisi otomatis.
                </p>
            </div>
        </div>

        <!-- Related products -->
        @if ($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <h2 class="mb-5 text-lg font-bold text-gray-900">Produk Terkait</h2>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        <x-shop.product-card :product="$related" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-shop.layout>
