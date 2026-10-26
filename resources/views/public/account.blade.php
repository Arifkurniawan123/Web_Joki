<x-public.layout :title="$title">

    <section class="border-b border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-6">
            <h1 class="text-2xl font-bold">Isi Data Akun</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Kode Order: <span class="font-mono">{{ $order->order_code }}</span>
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

            <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-5 dark:border-blue-900 dark:bg-blue-900/20">
                <div class="text-sm text-blue-800 dark:text-blue-300">
                    <strong>Catatan:</strong> Password kamu akan dienkripsi dan hanya digunakan untuk keperluan joki.
                    Setelah order selesai, data akan dihapus. <strong>Kode verifikasi Gmail</strong> akan diminta admin
                    via WhatsApp.
                </div>
            </div>

            <form action="{{ route('account.store', $order->order_code) }}" method="POST">
                @csrf

                <div class="space-y-5">
                    @foreach ($itemsByGame as $gameId => $items)
                        @php
                            $game = $items->first()->game;
                        @endphp

                        <div class="rounded-xl border border-zinc-200 p-6 dark:border-zinc-800">

                            {{-- HEADER GAME --}}
                            <div class="mb-5 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                                <div class="font-semibold text-lg">{{ $game->name ?? '-' }}</div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                    {{ $items->count() }} layanan:
                                    {{ $items->map(fn($i) => $i->service->name ?? '-')->implode(', ') }}
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Email / Username</label>
                                    <input type="text" name="game_email[{{ $gameId }}]"
                                        value="{{ old('game_email.' . $gameId) }}"
                                        placeholder="email@example.com atau username"
                                        class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">
                                    @error('game_email.' . $gameId)
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">Password</label>
                                    <input type="text" name="game_password[{{ $gameId }}]"
                                        value="{{ old('game_password.' . $gameId) }}" placeholder="Password akun"
                                        class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">
                                    @error('game_password.' . $gameId)
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">
                                        Server
                                    </label>
                                    <input type="text" name="game_server[{{ $gameId }}]"
                                        value="{{ old('game_server.' . $gameId) }}" placeholder="Asia / America / Europe"
                                        class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm focus:border-zinc-400 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900">

                                    {{-- TAMBAHIN BARIS INI BUAT NAMPILIN ERROR --}}
                                    @error('game_server.' . $gameId)
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <button type="submit"
                    class="mt-6 w-full rounded-lg bg-zinc-900 px-4 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Simpan Data Akun
                </button>

            </form>

        </div>
    </section>

</x-public.layout>
