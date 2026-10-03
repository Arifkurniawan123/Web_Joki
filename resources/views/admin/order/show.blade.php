{{-- resources/views/admin/order/show.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Kode: <span class="font-mono">{{ $order->order_code }}</span>
                </p>
            </div>
            <flux:button href="{{ route('admin.order.index') }}" wire:navigate>Kembali</flux:button>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

            {{-- Info Customer --}}
            <div class="furina-card rounded-2xl p-5 lg:col-span-2">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-3">
                    Data Customer
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs text-blue-500 dark:text-sky-400">Nama</div>
                        <div class="text-sm font-semibold text-blue-900 dark:text-sky-100 mt-1">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-blue-500 dark:text-sky-400">No. WhatsApp</div>
                        <div class="text-sm text-blue-900 dark:text-sky-100 mt-1">{{ $order->wa_number }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-blue-500 dark:text-sky-400">Tanggal Order</div>
                        <div class="text-sm text-blue-900 dark:text-sky-100 mt-1">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-blue-500 dark:text-sky-400">Total</div>
                        <div class="text-sm font-bold text-blue-900 dark:text-sky-100 mt-1">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-3">
                    Status Order
                </div>

                <div class="mb-3">
                    <span class="inline-flex px-3 py-1.5 rounded-full text-xs font-semibold
                        @if ($order->status === 'pending') bg-amber-200/70 text-amber-800 dark:bg-amber-500/20 dark:text-amber-300
                        @elseif($order->status === 'paid') bg-sky-200/70 text-sky-800 dark:bg-sky-500/20 dark:text-sky-300
                        @elseif($order->status === 'awaiting_verify') bg-cyan-200/70 text-cyan-800 dark:bg-cyan-500/20 dark:text-cyan-300
                        @elseif($order->status === 'process') bg-purple-200/70 text-purple-800 dark:bg-purple-500/20 dark:text-purple-300
                        @elseif($order->status === 'done') bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300
                        @else bg-red-200/70 text-red-800 dark:bg-red-500/20 dark:text-red-300 @endif">
                        {{ $order->status }}
                    </span>
                </div>

                <form action="{{ route('admin.order.update', $order) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <select name="status"
                        class="w-full rounded-lg border border-white/60 bg-white/70 px-3 py-2 text-sm text-blue-900 focus:outline-none focus:ring-2 focus:ring-sky-400 dark:border-sky-500/20 dark:bg-slate-900/60 dark:text-sky-100">
                        @foreach (\App\Models\Order::statuses() as $key => $label)
                            <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <flux:button size="sm" variant="primary" type="submit" class="w-full">
                        Update Status
                    </flux:button>
                </form>
            </div>

        </div>

        {{-- Items --}}
        <div class="furina-card rounded-2xl overflow-hidden mb-6">
            <div class="p-5 border-b border-white/40 dark:border-sky-500/20">
                <span class="font-semibold text-blue-900 dark:text-sky-100">
                    Detail Item ({{ $order->items->count() }})
                </span>
            </div>

            <table class="w-full text-sm">
                <thead class="bg-white/30 dark:bg-sky-500/5">
                    <tr class="border-b border-white/40 dark:border-sky-500/20">
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-12">No</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Email</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Password</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Game</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Service</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Account ID</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Server</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-32">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $i => $item)
                        <tr class="border-b border-white/30 dark:border-sky-500/10">
                            <td class="px-5 py-3 text-blue-500">{{ $i + 1 }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-blue-700 dark:text-sky-300">
                                {{ $item->game_email ?? '-' }}
                            </td>
                            <td class="px-5 py-3 font-mono text-xs">
                                @if ($item->game_password)
                                    <span id="pw-{{ $item->id }}" class="blur-sm select-none cursor-pointer"
                                        onclick="this.classList.toggle('blur-sm')">
                                        {{ $item->game_password }}
                                    </span>
                                @else
                                    <span class="text-blue-400">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-blue-900 dark:text-sky-100">{{ $item->game->name ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <div class="text-blue-900 dark:text-sky-100">{{ $item->service->name ?? '-' }}</div>
                                @if ($item->notes)
                                    <div class="text-xs text-blue-500 dark:text-sky-400 mt-0.5">
                                        Catatan: {{ $item->notes }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3 font-mono text-xs text-blue-700 dark:text-sky-300">
                                {{ $item->game_account_id ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">{{ $item->game_server ?? '-' }}</td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-8 text-center text-blue-400">
                                Tidak ada item
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </flux:main>
</x-layouts::app.sidebar>