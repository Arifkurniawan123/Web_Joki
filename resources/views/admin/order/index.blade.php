{{-- resources/views/admin/order/index.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                    {{ $title }}
                </h1>
                <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                    Daftar order masuk dari user.
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter Status --}}
        <div class="furina-card rounded-2xl p-4 mb-4">
            <form method="GET" action="{{ route('admin.order.index') }}" class="flex items-center gap-3">
                <label class="text-sm font-medium text-blue-900 dark:text-sky-200">Filter Status:</label>
                <select name="status"
                    class="rounded-lg border border-white/60 bg-white/70 px-3 py-2 text-sm text-blue-900 focus:outline-none focus:ring-2 focus:ring-sky-400 dark:border-sky-500/20 dark:bg-slate-900/60 dark:text-sky-100">
                    <option value="">Semua</option>
                    @foreach (\App\Models\Order::statuses() as $key => $label)
                        <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <flux:button size="sm" type="submit" variant="primary">Filter</flux:button>
                @if (request('status'))
                    <flux:button size="sm" href="{{ route('admin.order.index') }}">Reset</flux:button>
                @endif
            </form>
        </div>

        <div class="furina-card rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-white/30 dark:bg-sky-500/5">
                    <tr class="border-b border-white/40 dark:border-sky-500/20">
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-12">No</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Kode Order</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Customer</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-24">Items</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-32">Total</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-32">Status</th>
                        <th class="px-5 py-3 text-right font-medium text-blue-800 dark:text-sky-300 w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $i => $order)
                        <tr class="border-b border-white/30 dark:border-sky-500/10">
                            <td class="px-5 py-3 text-blue-500">{{ $i + 1 }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-blue-900 dark:text-sky-100">
                                {{ $order->order_code }}
                            </td>
                            <td class="px-5 py-3">
                                <div class="font-medium text-blue-900 dark:text-sky-100">{{ $order->customer_name }}</div>
                                <div class="text-xs text-blue-500 dark:text-sky-400">{{ $order->wa_number }}</div>
                            </td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">
                                {{ $order->items->count() }} item
                            </td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if ($order->status === 'pending') bg-amber-200/70 text-amber-800 dark:bg-amber-500/20 dark:text-amber-300
                                    @elseif($order->status === 'paid') bg-sky-200/70 text-sky-800 dark:bg-sky-500/20 dark:text-sky-300
                                    @elseif($order->status === 'awaiting_verify') bg-cyan-200/70 text-cyan-800 dark:bg-cyan-500/20 dark:text-cyan-300
                                    @elseif($order->status === 'process') bg-purple-200/70 text-purple-800 dark:bg-purple-500/20 dark:text-purple-300
                                    @elseif($order->status === 'done') bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300
                                    @else bg-red-200/70 text-red-800 dark:bg-red-500/20 dark:text-red-300 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <flux:button size="sm" href="{{ route('admin.order.show', $order) }}" wire:navigate>
                                    Detail
                                </flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center text-blue-400">
                                Belum ada order masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </flux:main>
</x-layouts::app.sidebar>