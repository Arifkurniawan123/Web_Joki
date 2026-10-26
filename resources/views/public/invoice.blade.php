<x-public.layout :title="$title">

    @isset($order)
        @if (!in_array($order->status, ['done', 'cancel']))
            <script>
                setTimeout(() => {
                    window.location.reload();
                }, 5000); // 5000 ms = 5 detik
            </script>
        @endif
    @endisset
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6">
            <h1 class="text-2xl font-bold">Invoice</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Simpan kode order di bawah ini untuk cek status.
            </p>
        </div>
    </section>

    <section>
        <div class="mx-auto max-w-3xl px-6 py-10">

            @if (session('success'))
                <div
                    class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif

            {{-- STATUS DINAMIS --}}
            @php
                $statusConfig = [
                    'paid' => [
                        'label' => 'Sudah Bayar',
                        'msg' => 'Sedang menunggu verifikasi admin.',
                        'box' => 'border-sky-200 bg-sky-50 dark:border-sky-900 dark:bg-sky-900/20',
                        'sub' => 'text-sky-700 dark:text-sky-400',
                        'title' => 'text-sky-900 dark:text-sky-100',
                    ],
                    'awaiting_verify' => [
                        'label' => 'Menunggu Verifikasi',
                        'msg' => 'Admin akan segera memproses order kamu.',
                        'box' => 'border-cyan-200 bg-cyan-50 dark:border-cyan-900 dark:bg-cyan-900/20',
                        'sub' => 'text-cyan-700 dark:text-cyan-400',
                        'title' => 'text-cyan-900 dark:text-cyan-100',
                    ],
                    'process' => [
                        'label' => 'Sedang Diproses',
                        'msg' => 'Admin sedang mengerjakan order kamu.',
                        'box' => 'border-purple-200 bg-purple-50 dark:border-purple-900 dark:bg-purple-900/20',
                        'sub' => 'text-purple-700 dark:text-purple-400',
                        'title' => 'text-purple-900 dark:text-purple-100',
                    ],
                    'done' => [
                        'label' => 'Selesai',
                        'msg' => 'Order kamu sudah selesai. Terima kasih!',
                        'box' => 'border-emerald-200 bg-emerald-50 dark:border-emerald-900 dark:bg-emerald-900/20',
                        'sub' => 'text-emerald-700 dark:text-emerald-400',
                        'title' => 'text-emerald-900 dark:text-emerald-100',
                    ],
                    'cancel' => [
                        'label' => 'Dibatalkan',
                        'msg' => 'Order ini telah dibatalkan.',
                        'box' => 'border-red-200 bg-red-50 dark:border-red-900 dark:bg-red-900/20',
                        'sub' => 'text-red-700 dark:text-red-400',
                        'title' => 'text-red-900 dark:text-red-100',
                    ],
                ];
                $cfg = $statusConfig[$order->status] ?? [
                    'label' => $order->status,
                    'msg' => '',
                    'box' => 'border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/20',
                    'sub' => 'text-zinc-700 dark:text-zinc-400',
                    'title' => 'text-zinc-900 dark:text-zinc-100',
                ];
            @endphp

            <div class="mb-6 rounded-xl border {{ $cfg['box'] }} p-5 text-center">
                <div class="text-sm {{ $cfg['sub'] }}">Status</div>
                <div class="mt-1 text-2xl font-bold {{ $cfg['title'] }}">
                    {{ $cfg['label'] }}
                </div>
                <p class="mt-2 text-xs {{ $cfg['sub'] }}">
                    {{ $cfg['msg'] }}
                </p>
            </div>

            {{-- KODE ORDER --}}
            <div class="mb-6 rounded-xl border border-zinc-200 p-5 dark:border-zinc-800">
                <div class="text-xs text-zinc-500 dark:text-zinc-400">Kode Order</div>
                <div class="mt-1 flex items-center gap-3">
                    <div class="font-mono text-lg font-bold">{{ $order->order_code }}</div>
                    <button type="button"
                        onclick="navigator.clipboard.writeText('{{ $order->order_code }}'); this.innerText='Tersalin!'"
                        class="text-xs text-zinc-500 hover:text-zinc-900 dark:text-zinc-400">
                        Salin
                    </button>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-800">
                <div class="border-b border-zinc-200 p-5 dark:border-zinc-800">
                    <h2 class="font-semibold">Detail Order</h2>
                </div>

                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @foreach ($order->items as $item)
                        <div class="p-5 flex items-start justify-between gap-4">
                            <div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $item->game->name ?? '-' }}
                                </div>
                                <div class="font-medium">{{ $item->service->name ?? '-' }}</div>
                            </div>
                            <div class="shrink-0 font-semibold">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-zinc-200 p-5 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50">
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- WA (hanya kalau belum process/done) --}}
            @if (in_array($order->status, ['paid', 'awaiting_verify']))
                <a href="{{ $waLink }}" target="_blank"
                    class="mt-6 block w-full rounded-lg bg-green-600 px-4 py-3 text-center text-sm font-medium text-white transition hover:bg-green-700">
                    Konfirmasi via WhatsApp
                </a>

                <p class="mt-3 text-center text-xs text-zinc-500 dark:text-zinc-400">
                    Kirim pesan ke admin untuk konfirmasi pembayaran & percepat proses.
                </p>
            @endif

        </div>
    </section>

</x-public.layout>
