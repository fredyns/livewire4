<flux:sidebar sticky collapsible="mobile" class="z-40 lg:hidden bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10">
    <flux:sidebar.header>
        <flux:sidebar.collapse class="-mr-2" />
        <flux:spacer />
        <x-app-logo href="{{ route('home') }}" wire:navigate/>
        <flux:spacer />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group :heading="__('Platform')" class="grid">
            <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
        </flux:sidebar.group>

        <flux:sidebar.group :heading="__('System')" class="grid">
            <flux:sidebar.item icon="users" :href="route('user.index')" :current="request()->routeIs('user.index')" wire:navigate>
                {{ __('Users') }}
            </flux:sidebar.item>
            <flux:sidebar.item icon="shield-check" :href="route('rbac.role.index')" :current="request()->routeIs('rbac.role.index')" wire:navigate>
                {{ __('Roles') }}
            </flux:sidebar.item>
            <flux:sidebar.item icon="key" :href="route('rbac.permission.index')" :current="request()->routeIs('rbac.permission.*')" wire:navigate>
                {{ __('Permissions') }}
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

        <div class="mt-6 text-xs font-semibold tracking-wide text-zinc-500 dark:text-white/60">{{ __('System') }}</div>
        <nav class="mt-2 grid gap-1">
            <a
                href="{{ route('user.index') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('user.index'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('user.index'),
                ])
                wire:navigate
            >
                {{ __('Users') }}
            </a>

            <a
                href="{{ route('rbac.role.index') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('rbac.role.index'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('rbac.role.index'),
                ])
                wire:navigate
            >
                {{ __('Roles') }}
            </a>

            <a
                href="{{ route('rbac.permission.index') }}"
                @class([
                    'px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-800/5 dark:hover:bg-white/10',
                    'text-zinc-800 dark:text-white' => request()->routeIs('rbac.permission.*'),
                    'text-zinc-600 dark:text-white/80' => ! request()->routeIs('rbac.permission.*'),
                ])
                wire:navigate
            >
                {{ __('Permissions') }}
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
