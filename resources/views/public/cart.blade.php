<x-public.layout :title="$title">

    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Keranjang</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    {{ count($cart) }} item di keranjang kamu.
                </p>
            </div>
            <a href="{{ route('game.index') }}"
                class="text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                ← Lanjut Belanja
            </a>
        </div>
    </section>

    <section>
        <div class="mx-auto max-w-7xl px-6 py-10">

            @if (session('success'))
                <div
                    class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('info'))
                <div
                    class="mb-4 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700 dark:border-blue-900 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ session('info') }}
                </div>
            @endif

            @if (count($cart) > 0)

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    {{-- LIST ITEM --}}
                    <div class="lg:col-span-2">
                        <div class="overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-800">

                            @foreach ($cart as $id => $item)
                                <div
                                    class="flex items-center gap-4 border-b border-zinc-200 p-4 last:border-0 dark:border-zinc-800">

                                    @if ($item['image'])
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                            class="h-16 w-16 rounded-lg object-cover">
                                    @else
                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-lg bg-zinc-100 text-xs text-zinc-400 dark:bg-zinc-800">
                                            No Img
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $item['game_name'] }}
                                        </div>
                                        <div class="font-semibold">{{ $item['name'] }}</div>
                                        @if ($item['estimated_days'])
                                            <div class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                                Estimasi: {{ $item['estimated_days'] }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-right">
                                        <div class="font-semibold">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </div>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs text-red-600 hover:text-red-700 dark:text-red-400">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-zinc-500 hover:text-red-600 dark:text-zinc-400">
                                Kosongkan keranjang
                            </button>
                        </form>
                    </div>

                    {{-- SUMMARY --}}
                    <div class="lg:col-span-1">
                        <div class="rounded-xl border border-zinc-200 p-5 dark:border-zinc-800">

                            <h2 class="font-semibold">Ringkasan</h2>

                            @php
                                $total = collect($cart)->sum('price');
                            @endphp

                            <div class="mt-4 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-zinc-600 dark:text-zinc-400">Subtotal</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div
                                    class="flex justify-between border-t border-zinc-200 pt-2 font-semibold dark:border-zinc-800">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout.index') }}"
                                class="mt-5 block w-full rounded-lg bg-zinc-900 px-4 py-2.5 text-center text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                                Lanjut Checkout
                            </a>


                        </div>
                    </div>

                </div>
            @else
                <div class="rounded-xl border border-dashed border-zinc-300 py-16 text-center dark:border-zinc-700">
                    <div class="text-zinc-400">Keranjang masih kosong</div>
                    <a href="{{ route('home') }}"
                        class="mt-4 inline-block rounded-lg bg-zinc-900 px-5 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900">
                        Lihat Layanan
                    </a>
                </div>

            @endif
        </div>
    </section>

</x-public.layout>
