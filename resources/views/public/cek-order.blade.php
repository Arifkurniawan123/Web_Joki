<x-public.layout :title="$title">

    {{-- Auto refresh tiap 15 detik kalau status belum final --}}
    @isset($order)
        @if (!in_array($order->status, ['done', 'cancel']))
            <meta http-equiv="refresh" content="15">
        @endif
    @endisset

    {{-- HEADER --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6">
            <h1 class="text-2xl font-bold">Cek Status Order</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Masukkan kode order untuk melihat status terkini.
            </p>
        </div>
    </section>

    <section>
        <div class="mx-auto max-w-3xl px-6 py-10">

            @if (session('error'))
                <div
                    class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-900/20 dark:text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            {{-- FORM INPUT --}}
            <form action="{{ route('order.status') }}" method="GET" class="mb-8">
                <div class="flex gap-3">
                    <input type="text" name="code" value="{{ request('code') }}"
                        placeholder="Contoh: FLR-20251005-A3F2"
                        class="flex-1 rounded-lg border border-zinc-200 bg-white px-4 py-3 font-mono text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">
                    <button type="submit"
                        class="rounded-lg bg-zinc-900 px-6 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                        Cek
                    </button>
                </div>
            </form>

            {{-- AUTO REDIRECT DARI QUERY PARAM --}}
            @if (request('code') && !isset($order))
                <script>
                    window.location.href = "{{ url('/cek-order') }}/" + encodeURIComponent("{{ request('code') }}");
                </script>
            @endif

            {{-- HASIL --}}
            @isset($order)
                @php
                    $statusConfig = [
                        'pending' => [
                            'label' => 'Menunggu Pembayaran',
                            'msg' => 'Selesaikan pembayaran untuk memulai order.',
                            'box' => 'border-amber-200 bg-amber-50 dark:border-amber-900 dark:bg-amber-900/20',
                            'sub' => 'text-amber-700 dark:text-amber-400',
                            'title' => 'text-amber-900 dark:text-amber-100',
                            'step' => 1,
                        ],
                        'paid' => [
                            'label' => 'Sudah Bayar',
                            'msg' => 'Menunggu verifikasi admin.',
                            'box' => 'border-sky-200 bg-sky-50 dark:border-sky-900 dark:bg-sky-900/20',
                            'sub' => 'text-sky-700 dark:text-sky-400',
                            'title' => 'text-sky-900 dark:text-sky-100',
                            'step' => 2,
                        ],
                        'awaiting_verify' => [
                            'label' => 'Menunggu Verifikasi',
                            'msg' => 'Admin sedang memverifikasi pembayaran kamu.',
                            'box' => 'border-cyan-200 bg-cyan-50 dark:border-cyan-900 dark:bg-cyan-900/20',
                            'sub' => 'text-cyan-700 dark:text-cyan-400',
                            'title' => 'text-cyan-900 dark:text-cyan-100',
                            'step' => 3,
                        ],
                        'process' => [
                            'label' => 'Sedang Diproses',
                            'msg' => 'Admin sedang mengerjakan order kamu.',
                            'box' => 'border-purple-200 bg-purple-50 dark:border-purple-900 dark:bg-purple-900/20',
                            'sub' => 'text-purple-700 dark:text-purple-400',
                            'title' => 'text-purple-900 dark:text-purple-100',
                            'step' => 4,
                        ],
                        'done' => [
                            'label' => 'Selesai',
                            'msg' => 'Order kamu sudah selesai. Terima kasih!',
                            'box' => 'border-emerald-200 bg-emerald-50 dark:border-emerald-900 dark:bg-emerald-900/20',
                            'sub' => 'text-emerald-700 dark:text-emerald-400',
                            'title' => 'text-emerald-900 dark:text-emerald-100',
                            'step' => 5,
                        ],
                        'cancel' => [
                            'label' => 'Dibatalkan',
                            'msg' => 'Order ini telah dibatalkan.',
                            'box' => 'border-red-200 bg-red-50 dark:border-red-900 dark:bg-red-900/20',
                            'sub' => 'text-red-700 dark:text-red-400',
                            'title' => 'text-red-900 dark:text-red-100',
                            'step' => 0,
                        ],
                    ];
                    $cfg = $statusConfig[$order->status] ?? [
                        'label' => $order->status,
                        'msg' => '',
                        'box' => 'border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/20',
                        'sub' => 'text-zinc-700 dark:text-zinc-400',
                        'title' => 'text-zinc-900 dark:text-zinc-100',
                        'step' => 0,
                    ];

                    $steps = [
                        1 => 'Order Dibuat',
                        2 => 'Sudah Bayar',
                        3 => 'Verifikasi',
                        4 => 'Diproses',
                        5 => 'Selesai',
                    ];

                @endphp

                {{-- STATUS CARD --}}
                <div class="mb-6 rounded-xl border {{ $cfg['box'] }} p-6 text-center">
                    <div class="text-sm {{ $cfg['sub'] }}">Status</div>
                    <div class="mt-1 text-2xl font-bold {{ $cfg['title'] }}">
                        {{ $cfg['label'] }}
                    </div>
                    <p class="mt-2 text-xs {{ $cfg['sub'] }}">
                        {{ $cfg['msg'] }}
                    </p>
                </div>

                {{-- PROGRESS STEPS --}}
                @if ($order->status !== 'cancel')
                    <div class="mb-6 rounded-xl border border-zinc-200 p-6 dark:border-zinc-800">
                        <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-4">
                            Progress Order
                        </div>

                        <div class="flex items-center justify-between">
                            @foreach ($steps as $num => $label)
                                @php
                                    $isDone = $cfg['step'] >= $num;
                                    $isCurrent = $cfg['step'] === $num;
                                @endphp

                                <div class="flex flex-col items-center flex-1 relative">
                                    @if ($num < 5)
                                        <div
                                            class="absolute top-4 left-1/2 w-full h-0.5 {{ $cfg['step'] > $num ? 'bg-blue-500' : 'bg-zinc-200 dark:bg-zinc-700' }}">
                                        </div>
                                    @endif

                                    <div
                                        class="relative z-10 flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold
                                        @if ($isCurrent) bg-blue-600 text-white ring-4 ring-blue-100 dark:ring-blue-900
                                        @elseif($isDone) bg-blue-500 text-white
                                        @else bg-zinc-200 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-500 @endif">
                                        @if ($isDone && !$isCurrent)
                                            ✓
                                        @else
                                            {{ $num }}
                                        @endif
                                    </div>

                                    <div
                                        class="mt-2 text-[10px] text-center leading-tight {{ $isCurrent ? 'font-bold text-blue-600 dark:text-blue-400' : ($isDone ? 'text-zinc-700 dark:text-zinc-300' : 'text-zinc-400') }}">
                                        {{ $label }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- KODE ORDER --}}
                <div class="mb-6 rounded-xl border border-zinc-200 p-5 dark:border-zinc-800">
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Kode Order</div>
                    <div class="mt-1 font-mono text-lg font-bold">{{ $order->order_code }}</div>
                </div>

                {{-- INFO CUSTOMER --}}
                <div class="mb-6 rounded-xl border border-zinc-200 p-5 dark:border-zinc-800">
                    <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-3">
                        Info Order
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">Nama</div>
                            <div class="mt-1 font-medium">{{ $order->customer_name }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">No. WhatsApp</div>
                            <div class="mt-1">
                                {{ substr($order->wa_number, 0, 4) . '****' . substr($order->wa_number, -3) }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">Tanggal Order</div>
                            <div class="mt-1">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400">Total</div>
                            <div class="mt-1 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                {{-- DETAIL ITEM --}}
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-800">
                    <div class="border-b border-zinc-200 p-5 dark:border-zinc-800">
                        <h2 class="font-semibold">Detail Layanan</h2>
                    </div>

                    <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @foreach ($order->items as $item)
                            <div class="p-5 flex items-start justify-between gap-4">
                                <div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $item->game->name ?? '-' }}
                                    </div>
                                    <div class="font-medium">{{ $item->service->name ?? '-' }}</div>
                                    @if ($item->service->estimated_days ?? false)
                                        <div class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                            Estimasi: {{ $item->service->estimated_days }}
                                        </div>
                                    @endif
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

                {{-- WA BUTTON --}}
                @if (in_array($order->status, ['pending', 'paid', 'awaiting_verify']))
                    @php
                        $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
                        $text = "Halo Admin, saya mau tanya tentang order:\n\nKode: {$order->order_code}\nNama: {$order->customer_name}";
                        $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($text);
                    @endphp

                    <a href="{{ $waLink }}" target="_blank"
                        class="mt-6 block w-full rounded-lg bg-green-600 px-4 py-3 text-center text-sm font-medium text-white transition hover:bg-green-700">
                        Tanya via WhatsApp
                    </a>
                @endif

            @endisset

        </div>
    </section>

</x-public.layout>
