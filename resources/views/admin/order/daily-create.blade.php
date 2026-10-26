<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Order: <span class="font-mono">{{ $item->order->order_code }}</span> | 
                    Service: {{ $item->service->name }} ({{ $item->service->duration_days }} Hari)
                </p>
            </div>
            <flux:button href="{{ route('admin.order.show', $item->order->order_code) }}" wire:navigate>Kembali</flux:button>
        </div>

        @if (session('error'))
            <div class="mb-4 rounded-lg border border-red-300 bg-red-50 text-red-800 px-4 py-3 text-sm dark:border-red-900 dark:bg-red-900/30 dark:text-red-400">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.daily.store', $item->id) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
            @csrf

            <div class="furina-card rounded-2xl p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Hari Ke-</label>
                    <flux:input type="number" name="day_number" value="{{ old('day_number', $nextDay) }}" min="1" max="{{ $item->service->duration_days }}" />
                    @error('day_number') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Catatan Progress</label>
                    <flux:textarea name="notes" rows="3" placeholder="Contoh: Daily commission, resin, event selesai">{{ old('notes') }}</flux:textarea>
                    @error('notes') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Screenshot Bukti (Opsional)</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900 text-zinc-700 dark:text-zinc-300">
                    <p class="text-xs text-blue-500 dark:text-sky-400 mt-1">Pilih gambar dari komputer (Maks 2MB).</p>
                    @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="mt-5 flex gap-2">
                <flux:button variant="primary" type="submit">Simpan Progress</flux:button>
                <flux:button href="{{ route('admin.order.show', $item->order->order_code) }}" wire:navigate>Batal</flux:button>
            </div>
        </form>

    </flux:main>
</x-layouts::app.sidebar>