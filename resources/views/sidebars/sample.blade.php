<flux:sidebar sticky collapsible class="pb-4 z-40 bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-white/10 lg:col-start-1 lg:row-start-2">
    <flux:sidebar.header>
        <flux:sidebar.collapse style="opacity: 1;" class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group expandable icon="inbox" heading="Items" class="grid">
            <flux:sidebar.item icon="inbox" :href="route('sample.item.index')" :current="request()->routeIs('sample.item.index')" wire:navigate>
                Items Index
            </flux:sidebar.item>
            <flux:sidebar.item icon="plus" :href="route('sample.item.create')" :current="request()->routeIs('sample.item.create')" wire:navigate>
                Create Item
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group expandable icon="document-text" heading="Static Pages" class="grid">
            <flux:sidebar.item icon="document-text" :href="route('sample.blank1')" :current="request()->routeIs('sample.blank1')" wire:navigate>
                Blank 1
            </flux:sidebar.item>
            <flux:sidebar.item icon="document-text" :href="route('sample.blank2')" :current="request()->routeIs('sample.blank2')" wire:navigate>
                Blank 2
            </flux:sidebar.item>
            <flux:sidebar.item icon="document-text" :href="route('sample.blank3')" :current="request()->routeIs('sample.blank3')" wire:navigate>
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
