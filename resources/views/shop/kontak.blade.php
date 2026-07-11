<x-shop.layout>
    <!-- ============ INTRO / PENGGANTI BANNER ============ -->
    <section class="bg-white px-4 sm:px-6 lg:px-8 pt-16 pb-12 border-b border-neutral-200">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">

            <!-- Teks Pembuka -->
            <div class="lg:col-span-3">
                <p class="font-story italic text-amber-800 mb-2 text-sm sm:text-base">Pintu Garasi Selalu Terbuka</p>
                <h1 class="font-display text-4xl sm:text-5xl text-neutral-900 tracking-wide leading-tight">
                    HUBUNGI KAMI
                </h1>
                <div class="w-16 h-[3px] bg-amber-800/70 my-5"></div>
                <p class="text-sm sm:text-base text-neutral-600 leading-relaxed max-w-md">
                    Mau tanya stok kaos, ukuran yang pas, atau sekadar ngobrol soal motor tua kesayangan Anda —
                    isi form di bawah atau langsung mampir ke WhatsApp. Yang balas orang asli, bukan admin robot.
                </p>
            </div>

            <!-- Kartu Info Gaya "Tiket Sobekan" -->
            <div class="lg:col-span-2">
                <div class="relative bg-white border border-dashed border-amber-800/40 rounded-lg px-6 py-6">
                    <!-- notch kiri & kanan -->
                    <span class="absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-white border border-dashed border-amber-800/40 rounded-full"></span>
                    <span class="absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-white border border-dashed border-amber-800/40 rounded-full"></span>

                    <div class="space-y-4 divide-y divide-dashed divide-amber-800/20">
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-amber-800 font-medium">Jam Buka</p>
                            <p class="text-sm text-neutral-800 mt-1">Senin – Sabtu, 10.00 – 18.00 WIB</p>
                        </div>
                        <div class="pt-4">
                            <p class="text-[11px] uppercase tracking-widest text-amber-800 font-medium">Respon Chat</p>
                            <p class="text-sm text-neutral-800 mt-1">Biasanya dibalas dalam 1×24 jam</p>
                        </div>
                        <div class="pt-4">
                            <p class="text-[11px] uppercase tracking-widest text-amber-800 font-medium">Lokasi</p>
                            <p class="text-sm text-neutral-800 mt-1">Solo, Jawa Tengah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ MAIN CONTENT ============ -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 flex-grow w-full bg-white">

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            <!-- Contact Form (Kolom 3) -->
            <div class="lg:col-span-3 bg-white border border-neutral-200 p-8 rounded-xl">
                <h2 class="font-display text-3xl tracking-wide mb-2 text-neutral-900">MARI MENGOBROL</h2>
                <p class="text-sm text-neutral-500 mb-8 leading-relaxed">
                    Punya pertanyaan seputar ketersediaan ukuran kaos atau ingin sekadar berdiskusi santai mengenai motor tua? Isi form ini, kami lanjutkan lewat WhatsApp.
                </p>

                <form id="wa-contact-form" class="space-y-5">
                    <div>
                        <label for="wa-name" class="block text-sm font-medium mb-1.5 text-neutral-700">Nama</label>
                        <input id="wa-name" type="text" placeholder="Nama Anda"
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-800/60 focus:border-amber-800/60">
                    </div>
                    <div>
                        <label for="wa-message" class="block text-sm font-medium mb-1.5 text-neutral-700">Pesan</label>
                        <textarea id="wa-message" rows="4" placeholder="Tulis pertanyaan Anda di sini..."
                            class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-800/60 focus:border-amber-800/60"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg transition flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-6l-4 4v-4z"/>
                        </svg>
                        Kirim via WhatsApp
                    </button>
                </form>
            </div>

            <!-- Info & Maps (Kolom 2) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-neutral-200 p-8 rounded-xl">
                    <h3 class="font-semibold text-neutral-900 text-lg mb-2">Lokasi Garasi</h3>
                    <p class="text-sm text-neutral-500 leading-relaxed mb-4">Jl. Lawas No. 45, Kota Solo, Indonesia</p>

                    <!-- Google Maps Embed -->
                    <!-- Ganti bagian "q=" di bawah dengan alamat asli, atau ambil dari Google Maps > Bagikan > Sematkan peta -->
                    <div class="rounded-lg overflow-hidden border border-neutral-200 h-56 relative bg-neutral-100">
                        <iframe
                            src="https://www.google.com/maps?q=Jl.+Lawas+No.+45,+Solo,+Jawa+Tengah,+Indonesia&output=embed"
                            class="w-full h-full border-0 absolute inset-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Tombol Chat WA Cepat Alternatif -->
                <a href="https://wa.me/628123456789?text=Halo%20Sudut%20Lawas%2C%20saya%20ingin%20bertanya..." target="_blank"
                    class="block bg-neutral-900 hover:bg-neutral-800 text-white p-6 rounded-xl transition focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="font-medium text-sm mb-0.5">Langsung Chat Saja</h3>
                            <p class="text-xs text-neutral-400">Hubungi Melalui WhatsApp</p>
                        </div>
                        <svg class="w-4 h-4 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!-- FAQ Mini (bisa dibuka/tutup) -->
        <div class="mt-20 max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <p class="font-story italic text-amber-800 mb-1 text-sm">Sebelum Bertanya</p>
                <h2 class="font-display text-3xl sm:text-4xl tracking-wide text-neutral-900">MUNGKIN SUDAH TERJAWAB</h2>
            </div>

            <div class="space-y-3">
                <details class="group bg-white border border-neutral-200 rounded-xl overflow-hidden open:border-amber-800/40 transition-colors">
                    <summary class="flex items-center justify-between gap-4 p-5 font-medium text-neutral-900 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <span>Apakah bisa COD di area Solo?</span>
                        <svg class="w-4 h-4 shrink-0 text-amber-800 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="px-5 pb-5 text-sm text-neutral-600 leading-relaxed font-light">
                        Bisa untuk area tertentu di Solo. Sampaikan lokasi Anda saat chat WhatsApp untuk konfirmasi pertemuan langsung di garasi atau titik temu.
                    </p>
                </details>

                <details class="group bg-white border border-neutral-200 rounded-xl overflow-hidden open:border-amber-800/40 transition-colors">
                    <summary class="flex items-center justify-between gap-4 p-5 font-medium text-neutral-900 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <span>Bagaimana jika ukuran tidak pas?</span>
                        <svg class="w-4 h-4 shrink-0 text-amber-800 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="px-5 pb-5 text-sm text-neutral-600 leading-relaxed font-light">
                        Kami sediakan panduan ukuran lengkap di setiap detail produk. Silakan tanyakan detail atau konsultasi ukuran via form di atas sebelum memesan.
                    </p>
                </details>

                <details class="group bg-white border border-neutral-200 rounded-xl overflow-hidden open:border-amber-800/40 transition-colors">
                    <summary class="flex items-center justify-between gap-4 p-5 font-medium text-neutral-900 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <span>Berapa lama proses pengiriman?</span>
                        <svg class="w-4 h-4 shrink-0 text-amber-800 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="px-5 pb-5 text-sm text-neutral-600 leading-relaxed font-light">
                        Pesanan diproses 1–2 hari kerja, dan pengiriman dalam kota Solo umumnya sampai di hari yang sama atau keesokan harinya. Estimasi luar kota mengikuti jasa ekspedisi terkait.
                    </p>
                </details>

                <details class="group bg-white border border-neutral-200 rounded-xl overflow-hidden open:border-amber-800/40 transition-colors">
                    <summary class="flex items-center justify-between gap-4 p-5 font-medium text-neutral-900 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <span>Apakah produk bisa ditukar atau dikembalikan?</span>
                        <svg class="w-4 h-4 shrink-0 text-amber-800 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <p class="px-5 pb-5 text-sm text-neutral-600 leading-relaxed font-light">
                        Penukaran ukuran bisa dilakukan maksimal 3 hari setelah barang diterima, selama kondisi masih seperti awal. Hubungi kami via WhatsApp untuk memulai proses penukaran.
                    </p>
                </details>
            </div>
        </div>
    </main>

    <!-- Handle Logic Submit Form ke WhatsApp via JS -->
    <script>
        document.getElementById('wa-contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('wa-name').value.trim();
            const message = document.getElementById('wa-message').value.trim();

            if(!name || !message) {
                alert('Silakan isi nama dan pesan Anda terlebih dahulu.');
                return;
            }

            const nomorWA = "628123456789"; // Ganti dengan nomor operasional Anda
            const teksHasil = `Halo Sudut Lawas, nama saya *${name}*.\n\n${message}`;
            const urlWhatsApp = `https://wa.me/${nomorWA}?text=${encodeURIComponent(teksHasil)}`;

            window.open(urlWhatsApp, '_blank');
        });
    </script>
</x-shop.layout>