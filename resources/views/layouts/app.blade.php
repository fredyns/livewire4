@props([
    'sidebar' => false,
    'title' => null,
    'width' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body class="min-h-screen bg-white text-zinc-900 dark:bg-zinc-900 dark:text-white">
<div
    x-data="{
        contentWidth: (localStorage.getItem('contentWidth') ?? @js($width ?? '3xl')),
        setContentWidth(width) {
            this.contentWidth = width
            localStorage.setItem('contentWidth', width)
        },
        get contentWidthClass() {
            return {
                '3xl': 'max-w-3xl',
                '5xl': 'max-w-5xl',
                '7xl': 'max-w-7xl',
                'max': 'max-w-none',
            }[this.contentWidth] ?? 'max-w-3xl'
        },
    }"
    x-init="
        if (!@js((bool) $sidebar)) {
            return
        }

        const sidebar = $el.querySelector('[data-flux-sidebar]')

        const syncSidebarWidth = () => {
            const isCollapsed = sidebar && sidebar.hasAttribute('data-flux-sidebar-collapsed-desktop')
            document.documentElement.style.setProperty('--sidebar-width', isCollapsed ? '3.5rem' : '18rem')
        }

        if (sidebar) {
            syncSidebarWidth()

            new MutationObserver(() => {
                syncSidebarWidth()
            }).observe(sidebar, { attributes: true, attributeFilter: ['data-flux-sidebar-collapsed-desktop'] })
        }

        window.addEventListener('storage', (event) => {
            if (event.key === 'flux-sidebar-collapsed-desktop') {
                document.documentElement.style.setProperty('--sidebar-width', (event.newValue === 'true') ? '3.5rem' : '18rem')
            }
        })
    "
    @class([
    'min-h-screen flex flex-col',
    'lg:grid lg:grid-rows-[auto_1fr]' => (bool) $sidebar,
])
    @if($sidebar) style="grid-template-columns: var(--sidebar-width) 1fr; grid-template-areas: 'header header' 'sidebar main';" @endif
>
    <header @class([
        'sticky top-0 z-50 flex items-center [:where(&)]:bg-white dark:[:where(&)]:bg-zinc-900 [:where(&)]:border-b [:where(&)]:border-zinc-200 dark:[:where(&)]:border-white/10',
    ]) @if($sidebar) style="height: 4.5rem; grid-area: header;" @else style="height: 4.5rem;" @endif>
        <div class="w-full h-full px-6 lg:px-0 flex items-center">
            <div
                class="flex items-center lg:px-8"
                @if($sidebar) style="width: var(--sidebar-width);" @endif
            >
                <x-app-logo href="{{ route('home') }}" wire:navigate/>
            </div>

            @if(auth()->check())
                <flux:navbar class="-mb-px max-lg:hidden">
                    <flux:navbar.item
                        icon="layout-grid"
                        :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')"
                        wire:navigate
                    >
                        {{ __('Dashboard') }}
                    </flux:navbar.item>
                    <flux:navbar.item
                        icon="layout-grid"
                        :href="route('user.index')"
                        :current="request()->routeIs('user.*')"
                        wire:navigate
                    >
                        Auth
                    </flux:navbar.item>

                    @if(!app()->isProduction())
                        <flux:navbar.item
                            icon="layout-grid"
                            :href="route('sample.blank1')"
                            :current="request()->routeIs('sample.*')"
                            wire:navigate
                        >
                            {{ __('Sample') }}
                        </flux:navbar.item>
                    @endif

                </flux:navbar>

                <flux:navbar class="-mb-px lg:hidden">
                    <flux:dropdown>
                        <flux:navbar.item icon:trailing="ellipsis-vertical"></flux:navbar.item>
                        <flux:navmenu>
                            <flux:navmenu.item
                                icon="layout-grid"
                                :href="route('dashboard')"
                                :current="request()->routeIs('dashboard')"
                                wire:navigate
                            >
                                {{ __('Dashboard') }}
                            </flux:navmenu.item>

                            @if(!app()->isProduction())
                                <flux:navmenu.item
                                    icon="layout-grid"
                                    :href="route('sample.blank1')"
                                    :current="request()->routeIs('sample.*')"
                                    wire:navigate
                                >
                                    {{ __('Sample') }}
                                </flux:navmenu.item>
                            @endif

                        </flux:navmenu>
                    </flux:dropdown>
                </flux:navbar>

                @if(!app()->isProduction())
                @endif

            @endif

            <div class="flex-1 flex items-center justify-end lg:px-8">
                <flux:button
                    x-data
                    x-on:click="$flux.dark = ! $flux.dark"
                    icon="moon"
                    variant="subtle"
                    aria-label="Toggle dark mode"
                />

                <flux:dropdown position="bottom" align="end" class="hidden xl:block">
                    <flux:button
                        class="ms-2"
                        icon="unfold-horizontal"
                        variant="subtle"
                        aria-label="Set content max width"
                    />

                    <flux:menu class="w-fit min-w-0">
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('3xl')">
                            <span
                                class="w-full text-center"
                                x-bind:class="contentWidth == '3xl' ? 'font-semibold' : ''"
                            >
                                3xl
                            </span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('5xl')">
                            <span
                                class="w-full text-center"
                                x-bind:class="contentWidth == '5xl' ? 'font-semibold' : ''">
                                5xl
                            </span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('7xl')">
                            <span
                                class="w-full text-center"
                                x-bind:class="contentWidth == '7xl' ? 'font-semibold' : ''"
                            >
                                7xl
                            </span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('max')">
                            <span
                                class="w-full text-center"
                                x-bind:class="contentWidth == 'max' ? 'font-semibold' : ''"
                            >
                                max
                            </span>
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

                <div class="ms-2"></div>

                @if(auth()->check())
                    <x-desktop-user-menu/>
                @else
                    <x-desktop-guest-menu/>
                @endif
            </div>
        </div>
    </header>

    @includeWhen($sidebar, 'sidebars.'.$sidebar)

    <main @class([
        'flex-1 px-6 lg:px-8 py-10',
    ]) @if($sidebar) style="grid-area: main;" @endif>
        <div id="content-frame" class="mx-auto w-full" :class="contentWidthClass">
            {{ $slot }}
        </div>
    </main>
</div>

@fluxScripts
</body>
</html>
