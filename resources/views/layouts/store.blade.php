<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('home') }}" class="flex items-center gap-2" wire:navigate>
            <div class="font-bold text-xl tracking-tight text-indigo-600 dark:text-indigo-400">Giga.id</div>
        </a>

        <flux:spacer />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')"
                wire:navigate>Home</flux:navbar.item>
            <flux:navbar.item icon="shopping-bag" href="{{ route('catalog') }}" :current="request()->routeIs('catalog')"
                wire:navigate>Products</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <div class="flex items-center gap-4">
            <livewire:store.cart-count />
            @auth
                <flux:button href="{{ route('dashboard') }}" variant="primary" size="sm" wire:navigate>Dashboard
                </flux:button>
            @else
                <flux:button href="{{ route('login') }}" variant="primary" size="sm" wire:navigate>Log in</flux:button>
            @endauth
        </div>
    </flux:header>

    <flux:main container class="py-10">
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>

</html>
