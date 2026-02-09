<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        icon="arrow-right-end-on-rectangle"
        data-test="sidebar-menu-button"
    />

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <flux:avatar
                name="Guest"
                initials="G"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate">Guest</flux:heading>
                <flux:text class="truncate">anonymous</flux:text>
            </div>
        </div>
        <flux:menu.separator/>
        <flux:menu.radio.group>
            <flux:menu.item :href="route('login')" icon="cog" wire:navigate>
                {{ __('Login') }}
            </flux:menu.item>
            @if(! app()->isProduction())
                <flux:menu.item :href="route('login-as')" icon="cog" wire:navigate>
                    {{ __('Login as' ) }}
                </flux:menu.item>
            @endif
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
