<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white text-zinc-900 dark:bg-zinc-900 dark:text-white">
<div class="min-h-screen flex flex-col lg:grid lg:grid-rows-[auto_1fr] lg:grid-cols-[18rem_1fr] lg:[grid-template-areas:'header_header''sidebar_main']">
    <header class="sticky top-0 z-30 flex items-center [:where(&)]:bg-white dark:[:where(&)]:bg-zinc-900 [:where(&)]:border-b [:where(&)]:border-zinc-200 dark:[:where(&)]:border-white/10 lg:[grid-area:header]" style="height: 4.5rem;">
        <div class="mx-auto w-full h-full [:where(&)]:max-w-7xl px-6 lg:px-8 flex items-center">
            <x-app-logo href="{{ route('home') }}" wire:navigate/>

            <div class="flex-1"></div>

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
    </header>

    <flux:sidebar sticky collapsible="mobile" class="lg:hidden bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10">
        <flux:sidebar.header>
            <flux:sidebar.collapse class="-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group heading="Guides" class="grid">
                <flux:sidebar.item href="#" current>Installation</flux:sidebar.item>
                <flux:sidebar.item href="#">Upgrade guide</flux:sidebar.item>
                <flux:sidebar.item href="#">Theming</flux:sidebar.item>
            </flux:sidebar.group>

            <flux:sidebar.group heading="Layouts" class="grid">
                <flux:sidebar.item href="#">Header</flux:sidebar.item>
                <flux:sidebar.item href="#">Sidebar</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>
    </flux:sidebar>

    <aside class="hidden lg:block border-r border-zinc-200 dark:border-white/10 bg-white dark:bg-zinc-900 lg:[grid-area:sidebar]">
        <div class="h-full overflow-y-auto px-4 py-6">
            <div class="text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">Guides</div>
            <nav class="mt-2 grid gap-1">
                <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-800 dark:text-white hover:bg-zinc-800/5 dark:hover:bg-white/10">Installation</a>
                <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Upgrade guide</a>
                <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Theming</a>
            </nav>

            <div class="mt-6 text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">Layouts</div>
            <nav class="mt-2 grid gap-1">
                <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Header</a>
                <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Sidebar</a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 px-6 lg:px-8 py-10 lg:[grid-area:main]">
        <div class="mx-auto w-full max-w-3xl">
            {{ $slot }}
        </div>
    </main>
</div>

@fluxScripts
</body>
</html>
