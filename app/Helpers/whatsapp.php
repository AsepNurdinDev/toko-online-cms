<?php

if (! function_exists('normalizeWhatsappNumber')) {

    /**
     * Normalisasi nomor WhatsApp ke format internasional tanpa "+"
     * agar kompatibel dengan wa.me (contoh: 0812xxxx -> 62812xxxx).
     */
    function normalizeWhatsappNumber(?string $number): string
    {
        $digits = preg_replace('/\D/', '', (string) $number);

        if ($digits === '') {
            return '';
        }

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return $digits;
    }

}

if (! function_exists('waOrderLink')) {

    /**
     * Bangun link wa.me untuk memesan sebuah produk.
     */
    function waOrderLink(\App\Models\Product $product, int $qty = 1): string
    {
        $phone = normalizeWhatsappNumber(setting('whatsapp'));

        $price = $product->discount_price && $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;

        $subtotal = $price * $qty;

        $message = "Halo ".setting('site_name', config('app.name')).", saya ingin memesan produk berikut:\n\n"
            ."*{$product->name}*\n"
            ."Jumlah: {$qty}\n"
            ."Harga satuan: ".rupiah($price)."\n"
            ."Subtotal: ".rupiah($subtotal)."\n\n"
            ."Link produk: ".route('shop.show', $product->slug)."\n\n"
            ."Mohon info ketersediaan stok dan total pembayarannya. Terima kasih!";

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }

}

if (! function_exists('waGeneralLink')) {

    /**
     * Link WA umum (dipakai di navbar/footer/CTA tanpa konteks produk).
     */
    function waGeneralLink(?string $message = null): string
    {
        $phone = normalizeWhatsappNumber(setting('whatsapp'));

        $message = $message ?? 'Halo '.setting('site_name', config('app.name')).', saya ingin bertanya tentang produk yang tersedia.';

        return 'https://wa.me/'.$phone.'?text='.rawurlencode($message);
    }

}
