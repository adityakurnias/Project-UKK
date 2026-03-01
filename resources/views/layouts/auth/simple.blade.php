<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased text-zinc-900 dark:text-zinc-100 dark:bg-zinc-900">
    <!-- Modern Auth Wrapper -->
    <div class="relative flex min-h-screen flex-col items-center justify-center p-6 md:p-10">

        <div class="relative z-10 flex w-full max-w-md flex-col gap-8">
            <!-- Branding Header -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-4 font-medium" wire:navigate>
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-600 shadow-md">
                    <flux:icon name="cpu-chip" class="w-8 h-8 text-white" />
                </div>
                <span class="font-extrabold text-3xl tracking-tight text-indigo-600 dark:text-indigo-400">
                    Giga.id
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Card Container -->
            <div
                class="flex flex-col gap-6 bg-white dark:bg-zinc-800 p-8 rounded-3xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
