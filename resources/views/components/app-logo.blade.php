@props([
    'sidebar' => false,
])

@if($sidebar)
    {{-- Logo untuk di Sidebar Admin --}}
    <a href="{{ route('admin.dashboard') }}" {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
        <span class="font-bold text-lg">{{ config('app.name', 'Laravel') }}</span>
    </a>
@else
    {{-- Logo untuk di Halaman Login/Register --}}
    <a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
        <span class="font-bold text-xl">{{ config('app.name', 'Laravel') }}</span>
    </a>
@endif