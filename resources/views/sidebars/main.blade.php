<flux:sidebar sticky collapsible="mobile" class="z-40 lg:hidden bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10">
    <flux:sidebar.header>
        <flux:sidebar.collapse class="-mr-2" />
        <flux:spacer />
        <x-app-logo href="{{ route('dashboard') }}" wire:navigate/>
        <flux:spacer />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group :heading="__('Platform')" class="grid">
            <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

</flux:sidebar>

<aside class="hidden pl-4 z-40 lg:block border-r border-zinc-200 dark:border-white/10 bg-white dark:bg-zinc-900 lg:col-start-1 lg:row-start-2">
    <div class="h-full overflow-y-auto px-4 py-6">
        <div class="text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">{{ __('Platform') }}</div>
        <nav class="mt-2 grid gap-1">
            <a
                href="{{ route('dashboard') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('dashboard'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('dashboard'),
                ])
                wire:navigate
            >
                {{ __('Dashboard') }}
            </a>
        </nav>
    </div>
</aside>
