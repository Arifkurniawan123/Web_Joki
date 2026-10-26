<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                {{ $title }}
            </h1>
            <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                Tambahkan game baru untuk joki.
            </p>
        </div>

        <form action="{{ route('admin.game.store') }}" method="POST" class="max-w-2xl">
            @csrf

            <div class="furina-card rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Nama Game</label>
                    <flux:input name="name" value="{{ old('name') }}" placeholder="Contoh: Genshin Impact" />
                    @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Slug (opsional)</label>
                    <flux:input name="slug" value="{{ old('slug') }}" placeholder="auto dari nama" />
                    @error('slug') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Deskripsi</label>
                    <flux:textarea name="description" rows="3" placeholder="Deskripsi singkat game">{{ old('description') }}</flux:textarea>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">URL Gambar (opsional)</label>
                    <flux:input name="image" value="{{ old('image') }}" placeholder="https://..." />
                    @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Urutan</label>
                        <flux:input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Status</label>
                        <div class="pt-2">
                            <flux:checkbox name="is_active" value="1" :checked="old('is_active', true)" label="Aktif" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-5 flex gap-2">
                <flux:button variant="primary" type="submit">Simpan</flux:button>
                <flux:button href="{{ route('admin.game.index') }}" wire:navigate>Batal</flux:button>
            </div>
        </form>

    </flux:main>
</x-layouts::app.sidebar>