{{-- resources/views/admin/post/show.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Detail post: {{ $post->title }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('admin.post.edit', $post->slug) }}" wire:navigate>Edit</flux:button>
                <flux:button href="{{ route('admin.post.index') }}" wire:navigate>Kembali</flux:button>
            </div>
        </div>

        <div class="furina-card rounded-2xl p-6 mb-6">

            {{-- Thumbnail --}}
            @if($post->thumbnail)
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}"
                     class="w-full max-h-72 object-cover rounded-xl border border-white/50 dark:border-sky-500/20 mb-6">
            @endif

            {{-- Judul + Meta --}}
            <div class="mb-5">
                <h2 class="text-xl font-bold text-blue-900 dark:text-sky-100 mb-2">{{ $post->title }}</h2>
                <div class="flex items-center gap-3 text-xs flex-wrap">
                    @if($post->category)
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-200/70 text-sky-800 dark:bg-sky-500/20 dark:text-sky-300">
                            {{ $post->category }}
                        </span>
                    @endif

                    @if($post->status === 'published')
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300">
                            Published
                        </span>
                    @else
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-200/70 text-amber-800 dark:bg-amber-500/20 dark:text-amber-300">
                            Draft
                        </span>
                    @endif

                    <span class="text-blue-500 dark:text-sky-400">
                        {{ $post->published_at?->format('d M Y, H:i') ?? 'Belum dipublish' }}
                    </span>
                </div>
            </div>

            {{-- Slug --}}
            <div class="mb-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Slug</div>
                <div class="font-mono text-sm text-blue-700 dark:text-sky-300 mt-1">{{ $post->slug }}</div>
            </div>

            {{-- Excerpt --}}
            @if($post->excerpt)
                <div class="mb-5">
                    <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Ringkasan</div>
                    <div class="text-sm italic text-blue-900/80 dark:text-sky-200/80 mt-1">
                        {{ $post->excerpt }}
                    </div>
                </div>
            @endif

            {{-- Konten --}}
            <div>
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-2">Konten</div>
                <div class="text-sm text-blue-900/90 dark:text-sky-100/90 leading-relaxed whitespace-pre-line">
                    {{ $post->content }}
                </div>
            </div>

        </div>

        {{-- Meta Info --}}
        <div class="furina-card rounded-2xl p-5">
            <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                    <div class="text-xs text-blue-500 dark:text-sky-400">ID</div>
                    <div class="text-blue-900 dark:text-sky-100 mt-1">{{ $post->id }}</div>
                </div>
                <div>
                    <div class="text-xs text-blue-500 dark:text-sky-400">Dibuat</div>
                    <div class="text-blue-900 dark:text-sky-100 mt-1">{{ $post->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div>
                    <div class="text-xs text-blue-500 dark:text-sky-400">Terakhir Update</div>
                    <div class="text-blue-900 dark:text-sky-100 mt-1">{{ $post->updated_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </div>

    </flux:main>
</x-layouts::app.sidebar>