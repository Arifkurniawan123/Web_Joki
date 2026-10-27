@php
    $brandName = \App\Models\Setting::get('brand_name', 'FlyRif Service');
    $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
    $cartCount = count(session()->get('cart', []));
@endphp

<header class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/80">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6">

        {{-- KIRI: Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
            <div class="flex h-8 w-8 items-center justify-center rounded-md bg-zinc-900 text-sm font-bold text-white dark:bg-white dark:text-zinc-900">
                F
            </div>
            {{-- Sembunyikan nama brand di HP --}}
            <span class="font-semibold hidden sm:block">{{ $brandName }}</span>
        </a>

        {{-- TENGAH: Nav (Hanya muncul di Desktop) --}}
        <nav class="hidden items-center gap-6 text-sm md:flex">
            <a href="{{ route('home') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Beranda</a>
            <a href="{{ route('game.index') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Layanan</a>
            <a href="{{ route('post.index') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Artikel</a>
            <a href="{{ route('order.status') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Cek Order</a>
            <a href="{{ route('cara-order') }}" class="text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Cara Order</a>
        </nav>

        {{-- KANAN: Cart + Login/Logout + Hubungi --}}
        <div class="flex items-center gap-1.5 sm:gap-2">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="relative rounded-lg border border-zinc-200 p-2 text-zinc-600 transition hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-800 dark:text-zinc-400 dark:hover:border-zinc-700 dark:hover:text-zinc-100">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                @if ($cartCount > 0)
                    <span class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-blue-600 px-1 text-[10px] font-bold text-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            {{-- Login / Logout --}}
            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="rounded-lg border border-zinc-200 px-3 py-2 text-xs sm:text-sm font-medium text-zinc-700 transition hover:border-zinc-300 dark:border-zinc-800 dark:text-zinc-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="rounded-lg border border-zinc-200 px-3 py-2 text-xs sm:text-sm font-medium text-zinc-700 transition hover:border-zinc-300 dark:border-zinc-800 dark:text-zinc-300">
                    Login
                </a>
            @endauth

            {{-- Hubungi (Sembunyikan di HP) --}}
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="hidden sm:inline-block rounded-lg bg-zinc-900 px-3 py-2 text-xs sm:text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                Hubungi
            </a>

        </div>
    </div>
</header>