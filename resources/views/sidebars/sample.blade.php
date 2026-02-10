<flux:sidebar sticky collapsible="mobile" class="z-40 lg:hidden bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10">
    <flux:sidebar.header>
        <flux:sidebar.collapse class="-mr-2" />
        <flux:spacer />
        <x-app-logo href="{{ route('home') }}" wire:navigate/>
        <flux:spacer />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group heading="Guides" class="grid">
            <flux:sidebar.item href="#" current>Installation</flux:sidebar.item>
            <flux:sidebar.item href="#">Upgrade guide</flux:sidebar.item>
            <flux:sidebar.item href="#">Theming</flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>
</flux:sidebar>

<aside class="hidden pl-4 z-40 lg:block border-r border-zinc-200 dark:border-white/10 bg-white dark:bg-zinc-900 lg:[grid-area:sidebar]">
    <div class="h-full overflow-y-auto px-4 py-6">
        <div class="text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">Guides</div>
        <nav class="mt-2 grid gap-1">
            <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-800 dark:text-white hover:bg-zinc-800/5 dark:hover:bg-white/10">Installation</a>
            <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Upgrade guide</a>
            <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">Theming</a>
        </nav>
    </div>
</aside>
