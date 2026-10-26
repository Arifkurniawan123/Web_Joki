<x-public.layout :title="'Cara Order — ' . \App\Models\Setting::get('brand_name', 'FlyRif Service')">

    {{-- HEADER --}}
    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-12 text-center">
            <h1 class="text-3xl md:text-4xl font-bold">Cara Order</h1>
            <p class="mt-3 text-sm md:text-base text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                Ikuti langkah-langkah berikut untuk memesan jasa joki. Pastikan membaca setiap langkah agar proses order berjalan lancar.
            </p>
        </div>
    </section>

    {{-- STEPS --}}
    <section>
        <div class="mx-auto max-w-5xl px-6 py-12">

            @php
                $steps = [
                    [
                        'num'   => 1,
                        'title' => 'Pilih Paket',
                        'desc'  => 'Pilih paket joki yang sesuai dengan target progres akunmu. Pastikan membaca deskripsi dan benefit setiap paket sebelum melakukan order.',
                    ],
                    [
                        'num'   => 2,
                        'title' => 'Klik Order',
                        'desc'  => 'Setelah menemukan paket yang sesuai, klik tombol Tambah ke Keranjang dan lanjut ke halaman keranjang untuk melanjutkan proses pemesanan.',
                    ],
                    [
                        'num'   => 3,
                        'title' => 'Konfirmasi Pesanan',
                        'desc'  => 'Periksa kembali paket, jumlah pesanan, harga, dan estimasi pengerjaan sebelum melanjutkan ke pembayaran.',
                    ],
                    [
                        'num'   => 4,
                        'title' => 'Lakukan Pembayaran',
                        'desc'  => 'Setelah mengisi data pemesan, kamu akan diarahkan ke halaman pembayaran. Scan QRIS dengan aplikasi e-wallet atau mobile banking. Pastikan nominal sesuai.',
                    ],
                    [
                        'num'   => 5,
                        'title' => 'Kirim Data Akun',
                        'desc'  => 'Setelah pembayaran, isi data akun game (email/username, password, server) pada halaman yang disediakan. Kode verifikasi Gmail akan diminta admin via WhatsApp saat proses login.',
                    ],
                    [
                        'num'   => 6,
                        'title' => 'Simpan Kode Order',
                        'desc'  => 'Kamu akan menerima kode order (contoh: FLR-20251006-A3F2). Simpan kode ini untuk memantau status pesanan secara mandiri kapan saja.',
                    ],
                    [
                        'num'   => 7,
                        'title' => 'Tunggu Giliran',
                        'desc'  => 'Pesanan akan masuk antrean setelah pembayaran diverifikasi admin. Gunakan halaman Cek Order untuk memantau status pesananmu kapan saja.',
                    ],
                    [
                        'num'   => 8,
                        'title' => 'Proses & Selesai',
                        'desc'  => 'Saat giliran tiba, akun akan mulai dikerjakan sesuai paket yang dipilih. Setelah selesai, admin akan menginformasikan hasil pengerjaan via WhatsApp.',
                    ],
                ];
            @endphp

           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($steps as $step)
                    <div class="flex gap-5 rounded-xl border border-zinc-200 bg-white p-6 transition hover:border-zinc-300 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

                        {{-- NOMOR --}}
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-cyan-500 text-lg font-bold text-white shadow-md">
                            {{ $step['num'] }}
                        </div>

                        {{-- KONTEN --}}
                        <div class="flex-1">
                            <h3 class="font-bold text-lg">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                {{ $step['desc'] }}
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- WARNING / RULES --}}
    <section class="border-t border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-5xl px-6 py-12">

            <div class="rounded-xl border-2 border-amber-300 bg-amber-50 p-6 dark:border-amber-500/40 dark:bg-amber-900/20">
                <div class="flex gap-4">
                    <svg class="h-6 w-6 shrink-0 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-amber-900 dark:text-amber-100">Wajib Dibaca Sebelum Order</h3>
                        <ul class="mt-3 space-y-2 text-sm text-amber-900/90 dark:text-amber-200/90">
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Dengan melakukan pembayaran, customer dianggap telah membaca dan menyetujui seluruh syarat & ketentuan yang berlaku.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Pastikan data akun yang diberikan benar dan akun sudah memenuhi ketentuan login.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Simpan nomor WhatsApp admin setelah melakukan order untuk memastikan komunikasi tetap berjalan jika terjadi kendala.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>•</span>
                                <span>Data akun hanya digunakan untuk keperluan joki dan akan dihapus setelah order selesai.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-5xl px-6 py-12 text-center">
            <h2 class="text-2xl font-bold">Siap Mulai Order?</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Pilih paket joki yang sesuai atau cek status pesananmu.
            </p>
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('game.index') }}"
                   class="rounded-lg bg-zinc-900 px-6 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Lihat Paket
                </a>
                <a href="{{ route('order.status') }}"
                   class="rounded-lg border border-zinc-300 px-6 py-3 text-sm font-medium text-zinc-700 transition hover:border-zinc-400 dark:border-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600">
                    Cek Status Order
                </a>
            </div>
        </div>
    </section>

</x-public.layout>