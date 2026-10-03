{{-- resources/views/admin/service/index.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Daftar service joki yang tersedia.
                </p>
            </div>
            <flux:button href="{{ route('admin.service.create') }}" variant="primary" icon="plus" wire:navigate>
                Tambah Service
            </flux:button>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        <div class="furina-card rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-white/30 dark:bg-sky-500/5">
                    <tr class="border-b border-white/40 dark:border-sky-500/20">
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-12">No</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Nama</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-20">Game ID</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-32">Harga</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-28">ETA</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-24">Status</th>
                        <th class="px-5 py-3 text-right font-medium text-blue-800 dark:text-sky-300 w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $i => $service)
                        <tr class="border-b border-white/30 dark:border-sky-500/10">
                            <td class="px-5 py-3 text-blue-500">{{ $i + 1 }}</td>
                            <td class="px-5 py-3">
                                <div class="font-medium text-blue-900 dark:text-sky-100">{{ $service->name }}</div>
                                <div class="font-mono text-xs text-blue-500 dark:text-sky-400">{{ $service->slug }}</div>
                            </td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">{{ $service->game->name }}</td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">{{ $service->estimated_days ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @if($service->is_active)
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-red-200/70 text-red-800 dark:bg-red-500/20 dark:text-red-300">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right space-x-1">
                                <flux:button size="sm" href="{{ route('admin.service.show', $service->slug) }}" wire:navigate>
                                    Detail
                                </flux:button>
                                <flux:button size="sm" href="{{ route('admin.service.edit', $service->slug) }}" wire:navigate>
                                    Edit
                                </flux:button>
                                <form action="{{ route('admin.service.destroy', $service->slug) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" variant="danger" type="submit">Hapus</flux:button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center text-blue-400">
                                Belum ada service
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </flux:main>
</x-layouts::app.sidebar>