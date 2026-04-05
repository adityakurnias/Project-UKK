<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <!-- Mobile Sidebar -->
    <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('home') }}" class="flex items-center gap-3 px-2 mb-6" wire:navigate>
            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 shadow-md">
                <flux:icon name="cpu-chip" class="w-5 h-5 text-white" />
            </div>
            <div class="font-extrabold text-xl tracking-tight text-indigo-600 dark:text-indigo-400">Giga.id</div>
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')"
                wire:navigate>Home</flux:navlist.item>
            <flux:navlist.item icon="shopping-bag" href="{{ route('catalog') }}"
                :current="request()->routeIs('catalog')" wire:navigate>Products</flux:navlist.item>
            @auth
            <flux:navlist.item icon="clipboard-document-list" href="{{ route('orders.index') }}"
                :current="request()->routeIs('orders.*')" wire:navigate>Pesanan</flux:navlist.item>
            @endauth
        </flux:navlist>

        <flux:spacer />

        <div class="px-2 pb-4 space-y-4">
            <div class="flex items-center gap-2">
                <flux:icon name="shopping-cart" class="w-5 h-5 text-zinc-500" />
                <div class="font-semibold text-sm">Cart</div>
                <div class="ml-auto">
                    <livewire:store.cart-count />
                </div>
            </div>

            <div class="h-px bg-zinc-200 dark:bg-zinc-700"></div>

            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-2 font-medium text-sm text-indigo-600 dark:text-indigo-400 py-2"
                        wire:navigate>
                        <flux:icon name="chart-bar" class="w-5 h-5" /> Dashboard
                    </a>
                @endif
                <x-desktop-user-menu />
            @else
                <div class="flex flex-col gap-2">
                    <flux:button href="{{ route('login') }}" variant="ghost"
                        class="w-full justify-center rounded-full font-semibold" wire:navigate>Log in</flux:button>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center h-10 px-5 text-sm font-bold text-white transition-all duration-300 rounded-full shadow-md bg-indigo-600 hover:bg-indigo-500 hover:shadow-indigo-500/30"
                        wire:navigate>
                        Sign up
                    </a>
                </div>
            @endauth
        </div>
    </flux:sidebar>

    <flux:header container
        class="sticky top-0 z-50 border-b border-zinc-200/50 bg-white/80 dark:border-zinc-700/50 dark:bg-zinc-900/80 backdrop-blur-md shadow-sm">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('home') }}" class="flex items-center gap-3 transition-transform hover:scale-105"
            wire:navigate>
            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 shadow-md">
                <flux:icon name="cpu-chip" class="w-5 h-5 text-white" />
            </div>
            <div
                class="font-extrabold text-2xl tracking-tight text-transparent bg-clip-text bg-linear-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400 max-sm:hidden">
                Giga.id</div>
        </a>

        <flux:spacer />

        <flux:navbar class="-mb-px max-lg:hidden gap-1">
            <flux:navbar.item icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')"
                class="px-4 py-2 rounded-full transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800" wire:navigate>
                Home</flux:navbar.item>
            <flux:navbar.item icon="shopping-bag" href="{{ route('catalog') }}" :current="request()->routeIs('catalog')"
                class="px-4 py-2 rounded-full transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800" wire:navigate>
                Products</flux:navbar.item>
            @auth
            <flux:navbar.item icon="clipboard-document-list" href="{{ route('orders.index') }}" :current="request()->routeIs('orders.*')"
                class="px-4 py-2 rounded-full transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800" wire:navigate>
                Pesanan</flux:navbar.item>
            @endauth
        </flux:navbar>

        <flux:spacer />

        <div class="flex items-center gap-4 max-lg:hidden">
            <livewire:store.cart-count />
            <div class="h-6 w-px bg-zinc-200 dark:bg-zinc-700"></div>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center h-9 px-4 text-sm font-bold text-white transition-all duration-300 rounded-full shadow-md bg-zinc-900 hover:bg-indigo-600 hover:shadow-indigo-500/30 dark:bg-indigo-600 dark:hover:bg-indigo-500"
                        wire:navigate>
                        Dashboard
                    </a>
                @endif
                <x-desktop-user-menu />
            @else
                <flux:button href="{{ route('login') }}" variant="ghost" size="sm" class="rounded-full font-semibold"
                    wire:navigate>Log in</flux:button>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center h-9 px-5 text-sm font-bold text-white transition-all duration-300 rounded-full shadow-md bg-linear-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/30"
                    wire:navigate>
                    Sign up
                </a>
            @endauth
        </div>
    </flux:header>

    <flux:main container class="py-10">
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>

</html>
