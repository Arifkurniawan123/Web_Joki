{{-- resources/views/admin/post/edit.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                {{ $title }}
            </h1>
            <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                Ubah artikel, promo, atau berita.
            </p>
        </div>

        <form action="{{ route('admin.post.update', $post->slug) }}" method="POST" class="max-w-3xl">
            @csrf
            @method('PUT')

            <div class="furina-card rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Judul</label>
                    <flux:input name="title" value="{{ old('title', $post->title) }}" />
                    @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Slug</label>
                    <flux:input name="slug" value="{{ old('slug', $post->slug) }}" />
                    @error('slug') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Kategori</label>
                        <flux:input name="category" value="{{ old('category', $post->category) }}" placeholder="Promo / Tips / Update" />
                        @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Status</label>
                        <select name="status"
                            class="w-full rounded-lg border border-white/60 bg-white/70 px-3 py-2 text-sm text-blue-900 focus:outline-none focus:ring-2 focus:ring-sky-400 dark:border-sky-500/20 dark:bg-slate-900/60 dark:text-sky-100">
                            <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $post->status) === 'published')>Published</option>
                        </select>
                        @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Thumbnail (URL gambar)</label>
                    <flux:input name="thumbnail" value="{{ old('thumbnail', $post->thumbnail) }}" placeholder="https://..." />
                    @error('thumbnail') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Ringkasan (Excerpt)</label>
                    <flux:textarea name="excerpt" rows="2">{{ old('excerpt', $post->excerpt) }}</flux:textarea>
                    @error('excerpt') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Konten</label>
                    <flux:textarea name="content" rows="10">{{ old('content', $post->content) }}</flux:textarea>
                    @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="mt-5 flex gap-2">
                <flux:button variant="primary" type="submit">Update</flux:button>
                <flux:button href="{{ route('admin.post.index') }}" wire:navigate>Batal</flux:button>
            </div>
        </form>

    </flux:main>
</x-layouts::app.sidebar>