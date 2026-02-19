<flux:sidebar sticky collapsible="mobile" class="z-40 lg:hidden bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10">
    <flux:sidebar.header>
        <flux:sidebar.collapse class="-mr-2" />
        <flux:spacer />
        <x-app-logo href="{{ route('home') }}" wire:navigate/>
        <flux:spacer />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group heading="Items" class="grid">
            <flux:sidebar.item icon="home" :href="route('sample.item.index')" :current="request()->routeIs('sample.item.index')" wire:navigate>
                Items Index
            </flux:sidebar.item>
            <flux:sidebar.item icon="home" :href="route('sample.item.create')" :current="request()->routeIs('sample.item.create')" wire:navigate>
                Create Item
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group heading="Static Pages" class="grid">
            <flux:sidebar.item icon="home" :href="route('sample.blank1')" :current="request()->routeIs('sample.blank1')" wire:navigate>
                Blank 1
            </flux:sidebar.item>
            <flux:sidebar.item icon="home" :href="route('sample.blank2')" :current="request()->routeIs('sample.blank2')" wire:navigate>
                Blank 2
            </flux:sidebar.item>
            <flux:sidebar.item icon="home" :href="route('sample.blank3')" :current="request()->routeIs('sample.blank3')" wire:navigate>
                Blank 3
            </flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:spacer />

    <flux:sidebar.nav>
        <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
            {{ __('Repository') }}
        </flux:sidebar.item>

        <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
            {{ __('Documentation') }}
        </flux:sidebar.item>
    </flux:sidebar.nav>
</flux:sidebar>

<aside class="hidden pl-4 z-40 lg:block border-r border-zinc-200 dark:border-white/10 bg-white dark:bg-zinc-900 lg:col-start-1 lg:row-start-2">
    <div class="h-full overflow-y-auto px-4 py-6">
        <div class="text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">Items</div>
        <nav class="mt-2 grid gap-1">
            <a
                href="{{ route('sample.item.index') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('sample.item.index'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('sample.item.index'),
                ])
                wire:navigate
            >
                Items Index
            </a>
            <a
                href="{{ route('sample.item.create') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('sample.item.create'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('sample.item.create'),
                ])
                wire:navigate
            >
                Create Item
            </a>
        </nav>
        <div class="mt-6 text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">Static Pages</div>
        <nav class="mt-2 grid gap-1">
            <a
                href="{{ route('sample.blank1') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('sample.blank1'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('sample.blank1'),
                ])
                wire:navigate
            >
                Blank 1
            </a>
            <a
                href="{{ route('sample.blank2') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('sample.blank2'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('sample.blank2'),
                ])
                wire:navigate
            >
                Blank 2
            </a>
            <a
                href="{{ route('sample.blank3') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('sample.blank3'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('sample.blank3'),
                ])
                wire:navigate
            >
                Blank 3
            </a>
        </nav>

        <div class="mt-6 text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">{{ __('Resources') }}</div>
        <nav class="mt-2 grid gap-1">
            <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">
                {{ __('Repository') }}
            </a>
            <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="px-3 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-white/80 hover:bg-zinc-800/5 dark:hover:bg-white/10">
                {{ __('Documentation') }}
            </a>
        </nav>
    </div>
</aside>
