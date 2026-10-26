<x-public.layout :title="$game->name . ' — ' . \App\Models\Setting::get('brand_name', 'FlyRif Service')">

    {{-- BREADCRUMB --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('game.index') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Game</a>
            <span class="mx-2">/</span>
            <span class="text-zinc-900 dark:text-zinc-100">{{ $game->name }}</span>
        </div>
    </section>

    {{-- HEADER GAME --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-10">
            <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">

                @if ($game->image)
                    <img src="{{ $game->image }}" alt="{{ $game->name }}" class="h-28 w-48 rounded-xl object-cover">
                @else
                    <div class="flex h-28 w-48 items-center justify-center rounded-xl bg-zinc-100 text-xl font-bold text-zinc-400 dark:bg-zinc-800">
                        {{ substr($game->name, 0, 2) }}
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl font-bold md:text-3xl">{{ $game->name }}</h1>
                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $game->description ?: 'Pilih layanan joki yang tersedia di bawah ini.' }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- LIST SERVICE --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-10">

            <div class="mb-8">
                <h2 class="text-xl font-bold">Layanan Tersedia</h2>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $services->count() }} layanan joki tersedia untuk {{ $game->name }}.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                @forelse($services as $service)
                    <div class="rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

                        @if ($service->image)
                            <img src="{{ $service->image }}" alt="{{ $service->name }}"
                                class="mb-4 h-40 w-full rounded-lg object-cover">
                        @endif

                        <h3 class="font-semibold text-lg">{{ $service->name }}</h3>

                        <p class="mt-1 text-sm text-zinc-600 line-clamp-2 dark:text-zinc-400">
                            {{ $service->description ?: 'Layanan joki profesional.' }}
                        </p>

                        <div class="mt-4 flex items-center justify-between border-t border-zinc-100 pt-4 dark:border-zinc-800">
                            <div>
                                <div class="text-xl font-bold">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </div>
                                @if ($service->estimated_days)
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                        Estimasi: {{ $service->estimated_days }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('cart.add', $service->slug) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="mt-4 w-full rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-3 py-12 text-center text-zinc-400">
                        Belum ada layanan untuk game ini
                    </div>
                @endforelse
            </div>

        </div>
    </section>

</x-public.layout>