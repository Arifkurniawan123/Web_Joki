<x-public.layout :title="$title">

    {{-- HEADER --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Checkout</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    Isi data untuk melanjutkan pemesanan.
                </p>
            </div>
            <a href="{{ route('cart.index') }}"
               class="text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                ← Kembali ke Keranjang
            </a>
        </div>
    </section>

    {{-- FORM --}}
    <section>
        <div class="mx-auto max-w-7xl px-6 py-10">

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    {{-- KIRI: FORM --}}
                    <div class="lg:col-span-2 space-y-5">

                        {{-- DATA CUSTOMER --}}
                        <div class="rounded-xl border border-zinc-200 p-6 dark:border-zinc-800">
                            <h2 class="font-semibold mb-4">Data Pemesan</h2>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                                    <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                           placeholder="Nama kamu"
                                           class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">
                                    @error('customer_name')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">No. WhatsApp Aktif</label>
                                    <input type="text" name="wa_number" value="{{ old('wa_number') }}"
                                           placeholder="08xxxxxxxxxx"
                                           class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">
                                    @error('wa_number')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- CATATAN --}}
                        <div class="rounded-xl border border-zinc-200 p-6 dark:border-zinc-800">
                            <h2 class="font-semibold mb-1">Catatan untuk Admin</h2>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">
                                Opsional. Sampaikan permintaan khusus kamu ke admin.
                            </p>

                            <textarea name="notes" rows="4"
                                      placeholder="Contoh: Tolong kerjakan malam hari ya, atau minta konfirmasi dulu sebelum mulai..."
                                      class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">{{ old('notes') }}</textarea>

                            @error('notes')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- KANAN: SUMMARY --}}
                    <div class="lg:col-span-1">
                        <div class="rounded-xl border border-zinc-200 p-5 dark:border-zinc-800 sticky top-24">

                            <h2 class="font-semibold mb-4">Ringkasan Order</h2>

                            <div class="space-y-3 mb-4">
                                @foreach($cart as $item)
                                    <div class="flex items-start justify-between gap-3 text-sm">
                                        <div>
                                            <div class="font-medium">{{ $item['name'] }}</div>
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $item['game_name'] }}</div>
                                        </div>
                                        <div class="shrink-0 font-medium">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-zinc-200 pt-4 dark:border-zinc-800">
                                <div class="flex justify-between font-semibold">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit"
                                    class="mt-5 w-full rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                                Lanjut ke Pembayaran
                            </button>

                        </div>
                    </div>

                </div>

            </form>

        </div>
    </section>

</x-public.layout>