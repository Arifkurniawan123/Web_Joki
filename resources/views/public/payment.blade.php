<x-public.layout :title="$title">

    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6">
            <h1 class="text-2xl font-bold">Pembayaran</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Selesaikan pembayaran untuk melanjutkan order.
            </p>
        </div>
    </section>

    <section>
        <div class="mx-auto max-w-3xl px-6 py-10">

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

            {{-- QRIS --}}
            <div class="rounded-xl border border-zinc-200 p-6 text-center dark:border-zinc-800">
                <div class="mb-4">
                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Total yang harus dibayar</div>
                    <div class="mt-1 text-3xl font-bold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>

                <div class="mx-auto max-w-xs">
                    <img src="{{ asset('assets/qris.png') }}" alt="QRIS"
                         class="w-full rounded-lg border border-zinc-200 dark:border-zinc-800">
                </div>

                <p class="mt-4 text-xs text-zinc-500 dark:text-zinc-400">
                    Scan QRIS dengan aplikasi e-wallet atau mobile banking.
                </p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    Pastikan nominal sesuai. Simpan bukti transfer.
                </p>
            </div>

            {{-- KONFIRMASI --}}
            <form action="{{ route('payment.confirm', $order->order_code) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit"
                        class="w-full rounded-lg bg-zinc-900 px-4 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Saya Sudah Bayar
                </button>
            </form>

            <p class="mt-3 text-center text-xs text-zinc-500 dark:text-zinc-400">
                Setelah klik, kamu akan diminta mengisi data akun game.
            </p>

        </div>
    </section>

</x-public.layout>