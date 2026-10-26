<x-public.layout :title="'Semua Game — ' . \App\Models\Setting::get('brand_name', 'FlyRif Service')">

    {{-- HEADER --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Semua Game</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $games->count() }} game tersedia untuk dijoki.
                </p>
            </div>
            <a href="{{ route('home') }}"
               class="text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                ← Beranda
            </a>
        </div>
    </section>

    {{-- LIST GAME --}}
    <section>
        <div class="mx-auto max-w-7xl px-6 py-10">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($games as $game)
                    <a href="{{ route('game.show', $game->slug) }}"
                       class="group rounded-xl border border-zinc-200 bg-white overflow-hidden transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

                        @if($game->image)
                            <img src="{{ $game->image }}" alt="{{ $game->name }}"
                                 class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 w-full items-center justify-center bg-zinc-100 text-zinc-400 dark:bg-zinc-800">
                                {{ $game->name }}
                            </div>
                        @endif

                        <div class="p-5">
                            <h3 class="font-semibold text-lg">{{ $game->name }}</h3>
                            <p class="mt-1 text-sm text-zinc-600 line-clamp-2 dark:text-zinc-400">
                                {{ $game->description ?: 'Klik untuk lihat service.' }}
                            </p>

                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="text-zinc-500 dark:text-zinc-400">Lihat service</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-3 py-12 text-center text-zinc-400">
                        Belum ada game tersedia
                    </div>
                @endforelse
            </div>

        </div>
    </section>

</x-public.layout>