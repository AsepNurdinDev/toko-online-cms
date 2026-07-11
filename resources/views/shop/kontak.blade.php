<x-shop.layout>
    <!-- ============ PAGE BANNER ============ -->
    <header class="relative bg-neutral-900 py-24 px-4 text-center overflow-hidden">
        <div class="absolute inset-0 opacity-40 bg-cover bg-center mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?auto=format&fit=crop&q=80&w=1920');"></div>
        <div class="relative z-10">
            <p class="font-story italic text-neutral-400 mb-2 text-sm sm:text-base">Pintu Kami Selalu Terbuka</p>
            <h1 class="font-display text-5xl sm:text-6xl text-white tracking-widest">HUBUNGI KAMI</h1>
        </div>
    </header>

    <!-- ============ MAIN CONTENT ============ -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 flex-grow w-full">
        
        <!-- Tetap Menggunakan Grid 5 Kolom Sesuai Layout Asli -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            <!-- Contact Form (Kolom 3) -->
            <div class="lg:col-span-3 bg-white dark:bg-ink-900 border border-neutral-100 dark:border-neutral-800 p-8 rounded-xl shadow-sm">
                <h2 class="font-display text-3xl tracking-wide mb-2 text-neutral-900 dark:text-white">MARI MENGOBROL</h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-8 leading-relaxed">
                    Punya pertanyaan seputar ketersediaan ukuran kaos atau ingin sekadar berdiskusi santai mengenai motor tua? Isi form ini, kami lanjutkan lewat WhatsApp.
                </p>
                
                <form id="wa-contact-form" class="space-y-5">
                    <div>
                        <label for="wa-name" class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">Nama</label>
                        <input id="wa-name" type="text" placeholder="Nama Anda" class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-neutral-50/50 dark:bg-ink-950 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:bg-white text-neutral-900 dark:text-cream-100">
                    </div>
                    <div>
                        <label for="wa-message" class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">Pesan</label>
                        <textarea id="wa-message" rows="4" placeholder="Tulis pertanyaan Anda di sini..." class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-neutral-50/50 dark:bg-ink-950 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-neutral-400 focus:bg-white text-neutral-900 dark:text-cream-100"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg shadow-sm transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-6l-4 4v-4z"/>
                        </svg>
                        Kirim via WhatsApp
                    </button>
                </form>
            </div>

            <!-- Info & Maps (Kolom 2) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-ink-900 border border-neutral-100 dark:border-neutral-800 p-8 rounded-xl shadow-sm">
                    <h3 class="font-semibold text-neutral-900 dark:text-white text-lg mb-2">Lokasi Garasi</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed mb-4">Jl. Lawas No. 45, Kota Solo, Indonesia</p>
                    
                    <!-- Google Maps Embed -->
                    <div class="rounded-lg overflow-hidden border border-neutral-100 dark:border-neutral-800 h-56 relative bg-neutral-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.0681347055973!2d110.824314!3d-7.566139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1m2!1s0x0%3A0x0!2zN8KwMzMnNTguMSJTIDExMMKwNDknMjcuNSJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="w-full h-full border-0 absolute inset-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Tombol Chat WA Cepat Alternatif -->
                <a href="https://wa.me/628123456789?text=Halo%20Sudut%20Lawas%2C%20saya%20ingin%20bertanya..." target="_blank" class="block bg-neutral-900 hover:bg-neutral-800 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-white p-6 rounded-xl transition shadow-sm">
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

        <!-- FAQ Mini -->
        <div class="mt-20 max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <p class="font-story italic text-neutral-500 mb-1 text-sm">Sebelum Bertanya</p>
                <h2 class="font-display text-3xl sm:text-4xl tracking-wide text-neutral-900 dark:text-white">MUNGKIN SUDAH TERJAWAB</h2>
            </div>
            
            <div class="space-y-4">
                <div class="bg-white dark:bg-ink-900 border border-neutral-100 dark:border-neutral-800 rounded-xl overflow-hidden">
                    <div class="p-5 font-medium text-neutral-900 dark:text-white border-b border-neutral-50 dark:border-neutral-800/60">
                        Apakah bisa COD di area Solo?
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed p-5 font-light">
                        Bisa untuk area tertentu di Solo. Sampaikan lokasi Anda saat chat WhatsApp untuk konfirmasi pertemuan langsung di garasi atau titik temu.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-ink-900 border border-neutral-100 dark:border-neutral-800 rounded-xl overflow-hidden">
                    <div class="p-5 font-medium text-neutral-900 dark:text-white border-b border-neutral-50 dark:border-neutral-800/60">
                        Bagaimana jika ukuran tidak pas?
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed p-5 font-light">
                        Kami sediakan panduan ukuran lengkap di setiap detail produk. Silakan tanyakan detail atau konsultasi ukuran via form di atas sebelum memesan.
                    </p>
                </div>
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