<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white text-zinc-900 dark:bg-zinc-900 dark:text-white">
<div class="min-h-screen flex flex-col lg:grid lg:grid-rows-[auto_1fr] lg:grid-cols-[18rem_1fr] lg:[grid-template-areas:'header_header''sidebar_main']">
    <header class="sticky top-0 z-10 flex items-center [:where(&)]:bg-white dark:[:where(&)]:bg-zinc-900 [:where(&)]:border-b [:where(&)]:border-zinc-200 dark:[:where(&)]:border-white/10 lg:[grid-area:header]" style="height: 4.5rem;">
        <div class="w-full h-full px-6 lg:px-0 flex items-center">
            <div class="flex items-center lg:w-[18rem] lg:px-8">
                <x-app-logo href="{{ route('home') }}" wire:navigate/>
            </div>

            <div class="flex-1 flex items-center justify-end lg:px-8">
                <flux:button
                    x-data
                    x-on:click="$flux.dark = ! $flux.dark"
                    icon="moon"
                    variant="subtle"
                    aria-label="Toggle dark mode"
                />

                <div class="ms-2"></div>

                @if(auth()->user())
                    <x-desktop-user-menu/>
                @else
                    <x-desktop-guest-menu/>
                @endif
            </div>
        </div>
    </header>

    @includeWhen($sidebar, 'sidebars.'.$sidebar)

    <main class="flex-1 px-6 lg:px-8 py-10 lg:[grid-area:main]">
        <div class="mx-auto w-full max-w-3xl">
            {{ $slot }}
        </div>
    </main>
</div>

@fluxScripts
</body>
</html>
