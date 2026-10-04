@php
    $brandName = \App\Models\Setting::get('brand_name', 'FlyRif Service');
    $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
    $email = \App\Models\Setting::get('email', 'admin@flyrif.com');
@endphp

<footer class="w-full border-t border-zinc-200 dark:border-zinc-800">
    <div class="mx-auto max-w-7xl px-6 py-10">

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            <div>
                <div class="font-semibold">{{ $brandName }}</div>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ \App\Models\Setting::get('description', 'Jasa joki game terpercaya.') }}
                </p>
            </div>

            <div>
                <div class="text-sm font-semibold">Navigasi</div>
                <ul class="mt-3 space-y-1.5 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Beranda</a></li>
                    <li><a href="#games" class="hover:text-zinc-900 dark:hover:text-zinc-100">Layanan</a></li>
                    <li><a href="#artikel" class="hover:text-zinc-900 dark:hover:text-zinc-100">Artikel</a></li>
                </ul>
            </div>

            <div>
                <div class="text-sm font-semibold">Kontak</div>
                <ul class="mt-3 space-y-1.5 text-sm text-zinc-600 dark:text-zinc-400">
                    <li>WA: {{ $waNumber }}</li>
                    <li>Email: {{ $email }}</li>
                </ul>
            </div>

        </div>

        <div class="mt-10 border-t border-zinc-200 pt-6 text-center text-xs text-zinc-500 dark:border-zinc-800">
            &copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.
        </div>

    </div>
</footer>