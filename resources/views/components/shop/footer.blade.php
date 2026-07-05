<footer class="mt-16 border-t border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
            <div>
                <h3 class="text-lg font-bold text-gray-900">{{ setting('site_name', config('app.name')) }}</h3>
                <p class="mt-2 text-sm text-gray-500">{{ setting('site_description', '') }}</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-400">Kontak</h4>
                <ul class="mt-3 space-y-2 text-sm text-gray-600">
                    @if (setting('whatsapp'))
                        <li>WhatsApp: {{ setting('whatsapp') }}</li>
                    @endif
                    @if (setting('email'))
                        <li>Email: {{ setting('email') }}</li>
                    @endif
                    @if (setting('address'))
                        <li>{{ setting('address') }}</li>
                    @endif
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-400">Ikuti Kami</h4>
                <div class="mt-3 flex gap-3">
                    @if (setting('facebook'))
                        <a href="{{ setting('facebook') }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-[var(--shop-primary)]">Facebook</a>
                    @endif
                    @if (setting('instagram'))
                        <a href="{{ setting('instagram') }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-[var(--shop-primary)]">Instagram</a>
                    @endif
                    @if (setting('tiktok'))
                        <a href="{{ setting('tiktok') }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-[var(--shop-primary)]">TikTok</a>
                    @endif
                </div>
            </div>
        </div>
        <p class="mt-10 border-t border-gray-100 pt-6 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. Semua hak dilindungi.
        </p>
    </div>
</footer>
