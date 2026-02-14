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
    @class([
    'min-h-screen flex flex-col',
    'lg:grid lg:grid-rows-[auto_1fr] lg:grid-cols-[18rem_1fr]' => (bool) $sidebar,
])>
    <header @class([
        'sticky top-0 z-50 flex items-center [:where(&)]:bg-white dark:[:where(&)]:bg-zinc-900 [:where(&)]:border-b [:where(&)]:border-zinc-200 dark:[:where(&)]:border-white/10',
        'lg:col-span-2' => (bool) $sidebar,
    ]) style="height: 4.5rem;">
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

                <flux:dropdown position="bottom" align="end" class="hidden xl:block">
                    <flux:button
                        class="ms-2"
                        icon="unfold-horizontal"
                        variant="subtle"
                        aria-label="Set content max width"
                    />

                    <flux:menu class="w-fit min-w-0">
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('3xl')">
                            <span class="w-full text-center" x-bind:class="contentWidth == '3xl' ? 'font-semibold' : ''">3xl</span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('5xl')">
                            <span class="w-full text-center" x-bind:class="contentWidth == '5xl' ? 'font-semibold' : ''">5xl</span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('7xl')">
                            <span class="w-full text-center" x-bind:class="contentWidth == '7xl' ? 'font-semibold' : ''">7xl</span>
                        </flux:menu.item>
                        <flux:menu.item as="button" type="button" x-on:click="setContentWidth('max')">
                            <span class="w-full text-center" x-bind:class="contentWidth == 'max' ? 'font-semibold' : ''">max</span>
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

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

    <main @class([
        'flex-1 px-6 lg:px-8 py-10',
        'lg:col-start-2 lg:row-start-2' => (bool) $sidebar,
    ])>
        <div id="content-frame" class="mx-auto w-full" :class="contentWidthClass">
            {{ $slot }}
        </div>
    </main>
</div>

@fluxScripts
</body>
</html>
