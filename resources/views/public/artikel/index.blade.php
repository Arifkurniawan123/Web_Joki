<x-public.layout :title="$title">

    {{-- HEADER --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-bold">Artikel & Promo</h1>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Tips, update game, dan promo terbaru dari kami.
            </p>
        </div>
    </section>

    {{-- LIST POST --}}
    <section>
        <div class="mx-auto max-w-7xl px-6 py-10">

            @if ($posts->count() > 0)

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('post.show', $post->slug) }}"
                           class="group rounded-xl border border-zinc-200 bg-white overflow-hidden transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

                            {{-- GAMBAR THUMBNAIL --}}
                            @if ($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}"
                                     class="h-48 w-full object-cover object-center">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-900 flex items-center justify-center">
                                    <span class="text-4xl font-bold text-zinc-400 dark:text-zinc-600">
                                        {{ strtoupper(substr($post->title, 0, 2)) }}
                                    </span>
                                </div>
                            @endif

                            {{-- KONTEN --}}
                            <div class="p-5">
                                @if ($post->category)
                                    <span class="inline-block rounded-md bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        {{ $post->category }}
                                    </span>
                                @endif

                                <h3 class="mt-2 font-bold text-lg line-clamp-2 group-hover:text-blue-600 transition">
                                    {{ $post->title }}
                                </h3>

                                <p class="mt-2 text-sm text-zinc-600 line-clamp-3 dark:text-zinc-400">
                                    {{ $post->excerpt }}
                                </p>

                                <div class="mt-4 flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-500">
                                    <span>{{ $post->published_at?->format('d M Y') }}</span>
                                    <span class="group-hover:translate-x-1 transition">→</span>
                                </div>
                            </div>

                        </a>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="mt-10">
                    {{ $posts->links() }}
                </div>

            @else
                <div class="rounded-xl border border-dashed border-zinc-300 py-16 text-center dark:border-zinc-700">
                    <div class="text-zinc-400">Belum ada artikel</div>
                </div>
            @endif

        </div>
    </section>

</x-public.layout>