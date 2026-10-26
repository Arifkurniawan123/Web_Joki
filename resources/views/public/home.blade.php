<x-public.layout :title="\App\Models\Setting::get('brand_name', 'FlyRif Service')">

    {{-- HERO --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-20 text-center">
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">
                {{ \App\Models\Setting::get('brand_name', 'FlyRif Service') }}
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-zinc-600 dark:text-zinc-400">
                {{ \App\Models\Setting::get('tagline', 'Jasa joki game terpercaya.') }}
            </p>
            <div class="mt-8">
                <a href="#games"
                   class="inline-block rounded-lg bg-zinc-900 px-6 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Lihat Layanan
                </a>
            </div>
        </div>
    </section>

    {{-- GAMES --}}
    <section id="games" class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-16">

            <div class="mb-10">
                <h2 class="text-2xl font-bold">Pilih Game</h2>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    Pilih game untuk lihat layanan joki yang tersedia.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($games as $game)
                   <a href="{{ route('game.show', $game->slug) }}" class="group rounded-xl border border-zinc-200 bg-white overflow-hidden transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

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

    {{-- ARTIKEL --}}
    @if($posts->count())
        <section id="artikel" class="border-b border-zinc-200 dark:border-zinc-800">
            <div class="mx-auto max-w-7xl px-6 py-16">

                <div class="mb-10">
                    <h2 class="text-2xl font-bold">Artikel & Promo</h2>
                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                        Update terbaru dari kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    @foreach($posts as $post)
                        <a href="{{ route('post.show', $post->slug) }}" class="group rounded-xl border border-zinc-200 bg-white overflow-hidden transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">
                            
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}"
                                     class="h-48 w-full object-cover object-center">
                            @endif

                            <div class="p-5">
                                @if($post->category)
                                    <span class="inline-block rounded-md bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        {{ $post->category }}
                                    </span>
                                @endif

                                <h3 class="mt-2 font-semibold line-clamp-2 group-hover:text-blue-600 transition">{{ $post->title }}</h3>
                                <p class="mt-1 text-sm text-zinc-600 line-clamp-2 dark:text-zinc-400">{{ $post->excerpt }}</p>
                                <div class="mt-3 text-xs text-zinc-500 dark:text-zinc-500">
                                    {{ $post->published_at?->format('d M Y') }}
                                </div>
                            </div>

                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

</x-public.layout>