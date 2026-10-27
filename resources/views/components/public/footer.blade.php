@php
    $brandName = \App\Models\Setting::get('brand_name', 'FlyRif Service');
    $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
    $email = \App\Models\Setting::get('email', 'admin@flyrif.com');
@endphp

<footer class="w-full border-t border-zinc-200 dark:border-zinc-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 py-10">

        {{-- Layout Flex: Numpuk vertikal di HP, sejajar di Desktop --}}
        <div class="flex flex-col items-center gap-8 md:flex-row md:justify-center md:gap-16 text-center md:text-left">

            <div>
                <div class="font-semibold">{{ $brandName }}</div>
                <p class="mt-2 max-w-sm text-sm text-zinc-600 dark:text-zinc-400 mx-auto md:mx-0">
                    {{ \App\Models\Setting::get('description', 'Jasa joki game terpercaya.') }}
                </p>
            </div>

            <div>
                <div class="text-sm font-semibold">Kontak</div>
                <ul class="mt-3 space-y-1.5 text-sm text-zinc-600 dark:text-zinc-400">
                    <li>WA: {{ $waNumber }}</li>
                    <li>Email: {{ $email }}</li>
                </ul>
            </div>

        </div>

        <div class="mt-10 border-t border-zinc-200 pt-6 text-center text-xs text-zinc-500 dark:border-zinc-800">
            &copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.
        </div>

    </div>
</footer>