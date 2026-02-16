<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        icon="arrow-right-end-on-rectangle"
        data-test="sidebar-menu-button"
    />

    <flux:menu>
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
