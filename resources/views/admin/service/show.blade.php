<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Detail service: {{ $service->name }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('admin.service.edit', $service->slug) }}" wire:navigate>Edit</flux:button>
                <flux:button href="{{ route('admin.service.index') }}" wire:navigate>Kembali</flux:button>
            </div>
        </div>

        <div class="furina-card rounded-2xl p-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Gambar --}}
                <div>
                    @if($service->image)
                        <img src="{{ $service->image }}" alt="{{ $service->name }}"
                             class="w-full rounded-xl border border-white/50 dark:border-sky-500/20 object-cover">
                    @else
                        <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-sky-100 to-cyan-100 dark:from-sky-900/30 dark:to-cyan-900/30 border border-white/50 dark:border-sky-500/20 flex items-center justify-center text-blue-400 text-sm">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="md:col-span-2 space-y-4">

                    <div>
                        <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Nama Service</div>
                        <div class="text-lg font-semibold text-blue-900 dark:text-sky-100 mt-1">{{ $service->name }}</div>
                    </div>

                    <div>
                        <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Game</div>
                        <div class="text-sm text-blue-900 dark:text-sky-100 mt-1">
                            {{ $service->game->name ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Slug</div>
                        <div class="font-mono text-sm text-blue-700 dark:text-sky-300 mt-1">{{ $service->slug }}</div>
                    </div>

                    <div>
                        <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Deskripsi</div>
                        <div class="text-sm text-blue-900/80 dark:text-sky-200/80 mt-1">
                            {{ $service->description ?: '—' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Harga</div>
                            <div class="text-sm font-semibold text-blue-900 dark:text-sky-100 mt-1">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">ETA</div>
                            <div class="text-sm text-blue-900 dark:text-sky-100 mt-1">
                                {{ $service->estimated_days ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide">Status</div>
                            <div class="mt-1">
                                @if($service->is_active)
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-red-200/70 text-red-800 dark:bg-red-500/20 dark:text-red-300">
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </flux:main>
</x-layouts::app.sidebar>