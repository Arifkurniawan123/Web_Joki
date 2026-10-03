{{-- resources/views/admin/dashboard/index.blade.php --}}
<x-layouts::app.sidebar :title="$title ?? 'Dashboard'">
    <flux:main>

        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                Dashboard Admin
            </h1>
            <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                Ringkasan data order dan service joki.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">

            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-300 uppercase tracking-wide">Total Order</div>
                <div class="text-3xl font-bold text-blue-900 dark:text-sky-100 mt-2">
                    {{ $stats['total_orders'] }}
                </div>
            </div>

            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-amber-600 dark:text-amber-300 uppercase tracking-wide">Pending</div>
                <div class="text-3xl font-bold text-amber-800 dark:text-amber-100 mt-2">
                    {{ $stats['pending_orders'] }}
                </div>
            </div>

            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-purple-600 dark:text-purple-300 uppercase tracking-wide">Diproses</div>
                <div class="text-3xl font-bold text-purple-800 dark:text-purple-100 mt-2">
                    {{ $stats['process_orders'] }}
                </div>
            </div>

            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-emerald-600 dark:text-emerald-300 uppercase tracking-wide">Selesai</div>
                <div class="text-3xl font-bold text-emerald-800 dark:text-emerald-100 mt-2">
                    {{ $stats['done_orders'] }}
                </div>
            </div>

            <div class="furina-card rounded-2xl p-5">
                <div class="text-xs font-medium text-cyan-600 dark:text-cyan-300 uppercase tracking-wide">Games</div>
                <div class="text-3xl font-bold text-cyan-800 dark:text-cyan-100 mt-2">
                    {{ $stats['total_games'] }}
                </div>
            </div>

        </div>

        <div class="furina-card rounded-2xl p-6 mb-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-sky-300/20 via-cyan-200/10 to-amber-200/30 pointer-events-none"></div>
            <div class="relative">
                <div class="text-xs font-medium text-blue-700 dark:text-sky-300 uppercase tracking-wide">
                    Total Revenue (Order Selesai)
                </div>
                <div class="text-4xl font-bold bg-gradient-to-r from-blue-800 via-cyan-600 to-amber-600 bg-clip-text text-transparent mt-2">
                    Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="furina-card rounded-2xl overflow-hidden">

            <div class="p-5 border-b border-white/40 dark:border-sky-500/20">
                <span class="font-semibold text-blue-900 dark:text-sky-100">Order Terbaru</span>
            </div>

            <table class="w-full text-sm">
                <thead class="bg-white/30 dark:bg-sky-500/5">
                    <tr class="border-b border-white/40 dark:border-sky-500/20">
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-12">No</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Kode</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Customer</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300">Total</th>
                        <th class="px-5 py-3 text-left font-medium text-blue-800 dark:text-sky-300 w-32">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $i => $order)
                        <tr class="border-b border-white/30 dark:border-sky-500/10">
                            <td class="px-5 py-3 text-blue-500">{{ $i + 1 }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-blue-900 dark:text-sky-100">
                                {{ $order->order_code }}
                            </td>
                            <td class="px-5 py-3 text-blue-900 dark:text-sky-100">{{ $order->customer_name }}</td>
                            <td class="px-5 py-3 text-blue-700 dark:text-sky-300">
                                Rp {{ number_format($order->price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'pending') bg-amber-200/70 text-amber-800 dark:bg-amber-500/20 dark:text-amber-300
                                    @elseif($order->status === 'paid') bg-sky-200/70 text-sky-800 dark:bg-sky-500/20 dark:text-sky-300
                                    @elseif($order->status === 'process') bg-purple-200/70 text-purple-800 dark:bg-purple-500/20 dark:text-purple-300
                                    @elseif($order->status === 'done') bg-emerald-200/70 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300
                                    @else bg-red-200/70 text-red-800 dark:bg-red-500/20 dark:text-red-300
                                    @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center text-blue-400">
                                Belum ada order masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </flux:main>
</x-layouts::app.sidebar>