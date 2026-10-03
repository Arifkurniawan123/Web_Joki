{{-- resources/views/layouts/app/sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <style>
        body {
            background:
                radial-gradient(circle at 20% 20%, rgba(126, 200, 227, 0.35), transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(168, 216, 234, 0.3), transparent 45%),
                linear-gradient(135deg, #e8f6fb 0%, #d3eaf2 50%, #eaf5fa 100%);
            background-attachment: fixed;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            right: -120px;
            top: 50%;
            transform: translateY(-50%);
            width: 900px;
            height: 900px;
            background: url('{{ asset('assets/furina.png') }}') no-repeat center/cover;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
            border-radius: 50%;
            filter: blur(0.5px) saturate(120%);
            mask-image: radial-gradient(circle, black 45%, transparent 85%);
            -webkit-mask-image: radial-gradient(circle, black 45%, transparent 85%);
        }

        .furina-glass {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(18px) saturate(150%);
            border-right: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px rgba(31, 90, 130, 0.08);
        }

        .furina-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(31, 90, 130, 0.08);
        }

        .dark body {
            background:
                radial-gradient(circle at 20% 20%, rgba(30, 58, 95, 0.6), transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(45, 90, 130, 0.5), transparent 45%),
                linear-gradient(135deg, #0a1628 0%, #0f2942 50%, #0a1628 100%);
        }

        .dark .furina-glass {
            background: rgba(15, 41, 66, 0.75);
            border-right: 1px solid rgba(126, 200, 227, 0.15);
        }

        .dark .furina-card {
            background: rgba(15, 41, 66, 0.85);
            border: 1px solid rgba(126, 200, 227, 0.2);
        }
    </style>
</head>
<body class="min-h-screen">

    <flux:sidebar sticky collapsible="mobile" class="furina-glass">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('admin.dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>

            <flux:sidebar.group :heading="__('Dashboard')" class="grid">
                <flux:sidebar.item icon="home" :href="route('admin.dashboard')"
                    :current="request()->routeIs('admin.dashboard')" wire:navigate>
                    Dashboard
                </flux:sidebar.item>
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Master Data')" class="grid">
                @if (Route::has('admin.game.index'))
                    <flux:sidebar.item icon="puzzle-piece" :href="route('admin.game.index')"
                        :current="request()->routeIs('admin.game.*')" wire:navigate>
                        Games
                    </flux:sidebar.item>
                @endif

                @if (Route::has('admin.service.index'))
                    <flux:sidebar.item icon="wrench-screwdriver" :href="route('admin.service.index')"
                        :current="request()->routeIs('admin.service.*')" wire:navigate>
                        Services
                    </flux:sidebar.item>
                @endif
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Transaksi')" class="grid">
                @if (Route::has('admin.order.index'))
                    <flux:sidebar.item icon="inbox-arrow-down" :href="route('admin.order.index')"
                        :current="request()->routeIs('admin.order.*')" wire:navigate>
                        Orders
                    </flux:sidebar.item>
                @endif
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Konten')" class="grid">
                @if (Route::has('admin.post.index'))
                    <flux:sidebar.item icon="document-text" :href="route('admin.post.index')"
                        :current="request()->routeIs('admin.post.*')" wire:navigate>
                        Posts
                    </flux:sidebar.item>
                @endif
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Pengaturan')" class="grid">
                @if (Route::has('admin.setting.index'))
                    <flux:sidebar.item icon="cog-6-tooth" :href="route('admin.setting.index')"
                        :current="request()->routeIs('admin.setting.*')" wire:navigate>
                        Settings
                    </flux:sidebar.item>
                @endif
            </flux:sidebar.group>

        </flux:sidebar.nav>

        <flux:spacer />

        <div class="px-4 py-3 border-t border-white/40 dark:border-sky-500/20 text-xs text-blue-900/70 dark:text-sky-200/70">
            FlyRif Service
        </div>
    </flux:sidebar>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group><flux:toast /></flux:toast.group>
    @endpersist

    @fluxScripts
</body>
</html>