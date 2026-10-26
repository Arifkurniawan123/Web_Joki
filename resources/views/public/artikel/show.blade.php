<x-public.layout :title="$title . ' — ' . \App\Models\Setting::get('brand_name', 'FlyRif Service')">

    {{-- BREADCRUMB --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-4xl px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('post.index') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Artikel</a>
            <span class="mx-2">/</span>
            <span class="text-zinc-900 dark:text-zinc-100 truncate">{{ $post->title }}</span>
        </div>
    </section>

    {{-- ARTIKEL --}}
    <article class="mx-auto max-w-4xl px-6 py-10">

        {{-- HEADER --}}
        <header class="mb-8">
            @if($post->category)
                <span class="inline-block rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                    {{ $post->category }}
                </span>
            @endif

            <h1 class="mt-3 text-3xl md:text-4xl font-bold leading-tight">
                {{ $post->title }}
            </h1>

            <div class="mt-4 flex items-center gap-4 text-sm text-zinc-500 dark:text-zinc-400">
                <span>{{ $post->published_at?->format('d M Y') }}</span>
            </div>
        </header>

        {{-- THUMBNAIL --}}
        @if($post->thumbnail)
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}"
                 class="mb-8 w-full rounded-xl border border-zinc-200 dark:border-zinc-800">
        @endif

        {{-- EXCERPT --}}
        @if($post->excerpt)
            <div class="mb-8 rounded-xl border-l-4 border-blue-500 bg-blue-50 p-5 dark:bg-blue-900/20">
                <p class="text-sm italic text-blue-900 dark:text-blue-300">
                    {{ $post->excerpt }}
                </p>
            </div>
        @endif

        {{-- CONTENT --}}
        <div class="prose prose-zinc dark:prose-invert max-w-none text-zinc-700 dark:text-zinc-300 leading-relaxed whitespace-pre-line">
            {{ $post->content }}
        </div>

        {{-- CTA WA --}}
        <div class="mt-12 rounded-xl border border-zinc-200 bg-zinc-50 p-6 text-center dark:border-zinc-800 dark:bg-zinc-900/50">
            <h3 class="font-semibold">Butuh Joki Sekarang?</h3>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Chat admin untuk konsultasi atau pesan langsung.
            </p>
            <div class="mt-4 flex items-center justify-center gap-3">
                <a href="{{ route('game.index') }}"
                   class="rounded-lg bg-zinc-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Lihat Layanan
                </a>
                <a href="https://wa.me/{{ \App\Models\Setting::get('wa_number', '6281998060507') }}" target="_blank"
                   class="rounded-lg border border-zinc-300 px-5 py-2.5 text-sm font-medium text-zinc-700 transition hover:border-zinc-400 dark:border-zinc-700 dark:text-zinc-300">
                    Chat Admin
                </a>
            </div>
        </div>

    </article>

    {{-- RELATED --}}
    @if($related->count() > 0)
        <section class="border-t border-zinc-200 dark:border-zinc-800">
            <div class="mx-auto max-w-7xl px-6 py-12">

                <h2 class="text-2xl font-bold mb-6">Artikel Terkait</h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    @foreach($related as $item)
                        <a href="{{ route('post.show', $item->slug) }}"
                           class="group rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

                            @if($item->thumbnail)
                                <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}"
                                     class="mb-4 h-40 w-full rounded-lg object-cover">
                            @endif

                            <h3 class="font-semibold line-clamp-2 group-hover:text-blue-600 transition">
                                {{ $item->title }}
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 line-clamp-2 dark:text-zinc-400">
                                {{ $item->excerpt }}
                            </p>
                            <div class="mt-3 text-xs text-zinc-500 dark:text-zinc-500">
                                {{ $item->published_at?->format('d M Y') }}
                            </div>

                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

</x-public.layout>