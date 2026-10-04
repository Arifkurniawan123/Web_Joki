@php
    $brandName = \App\Models\Setting::get('brand_name', 'FlyRif Service');
    $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
@endphp

<header class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/80">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">

        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="flex h-8 w-8 items-center justify-center rounded-md bg-zinc-900 text-sm font-bold text-white dark:bg-white dark:text-zinc-900">
                F
            </div>
            <span class="font-semibold">{{ $brandName }}</span>
        </a>

        <nav class="hidden items-center gap-6 text-sm md:flex">
            <a href="{{ route('home') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Beranda</a>
            <a href="#games" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Layanan</a>
            <a href="#artikel" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Artikel</a>
            <a href="#" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Cara Order</a>
        </nav>

        <a href="https://wa.me/{{ $waNumber }}" target="_blank"
           class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
            Hubungi
        </a>

    </div>
</header>