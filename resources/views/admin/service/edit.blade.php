<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                {{ $title }}
            </h1>
            <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                Ubah data service.
            </p>
        </div>

        <form action="{{ route('admin.service.update', $service->slug) }}" method="POST" class="max-w-2xl">
            @csrf
            @method('PUT')

            <div class="furina-card rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Game</label>
                    <select name="game_id" class="w-full rounded-lg border border-white/60 bg-white/70 px-3 py-2 text-sm text-blue-900 focus:outline-none focus:ring-2 focus:ring-sky-400 dark:border-sky-500/20 dark:bg-slate-900/60 dark:text-sky-100">
                        <option value="">-- Pilih Game --</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" @selected(old('game_id', $service->game_id) == $game->id)>
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('game_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Nama Service</label>
                    <flux:input name="name" value="{{ old('name', $service->name) }}" />
                    @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Slug</label>
                    <flux:input name="slug" value="{{ old('slug', $service->slug) }}" />
                    @error('slug') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Deskripsi</label>
                    <flux:textarea name="description" rows="3">{{ old('description', $service->description) }}</flux:textarea>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Harga (Rp)</label>
                        <flux:input type="number" name="price" value="{{ old('price', $service->price) }}" />
                        @error('price') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Estimasi Pengerjaan</label>
                        <flux:input name="estimated_days" value="{{ old('estimated_days', $service->estimated_days) }}" />
                        @error('estimated_days') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">URL Gambar</label>
                    <flux:input name="image" value="{{ old('image', $service->image) }}" placeholder="https://..." />
                    @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Urutan</label>
                        <flux:input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Status</label>
                        <div class="pt-2">
                            <flux:checkbox name="is_active" value="1" :checked="old('is_active', $service->is_active)" label="Aktif" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-5 flex gap-2">
                <flux:button variant="primary" type="submit">Update</flux:button>
                <flux:button href="{{ route('admin.service.index') }}" wire:navigate>Batal</flux:button>
            </div>
        </form>

    </flux:main>
</x-layouts::app.sidebar>