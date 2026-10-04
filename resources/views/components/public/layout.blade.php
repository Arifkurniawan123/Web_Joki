<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? \App\Models\Setting::get('brand_name', 'FlyRif Service') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-zinc-800 dark:bg-zinc-900 dark:text-zinc-100">

    @include('components.public.navbar')

    <main class="w-full">
        {{ $slot }}
    </main>

    @include('components.public.footer')

</body>
</html>