{{-- resources/views/admin/setting/index.blade.php --}}
<x-layouts::app.sidebar :title="$title">
    <flux:main>

        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-700 via-cyan-500 to-blue-400 bg-clip-text text-transparent">
                {{ $title }}
            </h1>
            <p class="text-sm text-blue-900/70 dark:text-sky-200/70 mt-1">
                Pengaturan umum website.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.setting.update') }}" method="POST" class="max-w-3xl">
            @csrf
            @method('PUT')

            {{-- Brand --}}
            <div class="furina-card rounded-2xl p-6 mb-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-4">
                    Brand
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Nama Brand</label>
                        <flux:input name="brand_name" value="{{ old('brand_name', $settings['brand_name'] ?? '') }}" placeholder="FlyRif Service" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Tagline</label>
                        <flux:input name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="Jasa Joki Game Terpercaya" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Deskripsi</label>
                        <flux:textarea name="description" rows="3">{{ old('description', $settings['description'] ?? '') }}</flux:textarea>
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="furina-card rounded-2xl p-6 mb-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-4">
                    Kontak & Sosial Media
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">No. WhatsApp</label>
                        <flux:input name="wa_number" value="{{ old('wa_number', $settings['wa_number'] ?? '') }}" placeholder="6281998060507" />
                        <p class="text-xs text-blue-500 dark:text-sky-400 mt-1">Format: 62xxx (tanpa tanda +)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Email</label>
                        <flux:input name="email" value="{{ old('email', $settings['email'] ?? '') }}" placeholder="admin@flyrif.com" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">Instagram</label>
                            <flux:input name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="@flyrifservice" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">TikTok</label>
                            <flux:input name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}" placeholder="@flyrifservice" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pembayaran --}}
            <div class="furina-card rounded-2xl p-6 mb-5">
                <div class="text-xs font-medium text-blue-600 dark:text-sky-400 uppercase tracking-wide mb-4">
                    Pembayaran
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-sky-200 mb-1">File QRIS</label>
                    <flux:input name="qris_image" value="{{ old('qris_image', $settings['qris_image'] ?? '') }}" placeholder="qris.png" />
                    <p class="text-xs text-blue-500 dark:text-sky-400 mt-1">
                        Simpan file di <code>public/assets/</code>, tulis nama file saja.
                    </p>
                </div>
            </div>

            <div class="flex gap-2">
                <flux:button variant="primary" type="submit">Simpan Pengaturan</flux:button>
            </div>
        </form>

    </flux:main>
</x-layouts::app.sidebar>