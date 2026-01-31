# Dark mode

Source: https://fluxui.dev/docs/dark-mode

Flux supports dark mode out of the box.

## Set up Tailwind

```css
@import "tailwindcss";
@import '../../vendor/livewire/flux/dist/flux.css';
@custom-variant dark (&:where(.dark, .dark *));
```

## Disabling dark mode handling

```blade
<head>
    ...
--    @fluxAppearance
</head>
```

## JavaScript utilities

```js
// Get/set a users color scheme preference...
$flux.appearance = 'light|dark|system'

// Get/set the current color scheme of your app...
$flux.dark = 'true|false'
```

```blade
<flux:button x-data x-on:click="$flux.dark = ! $flux.dark">Toggle</flux:button>
```

```blade
<flux:radio.group x-data x-model="$flux.appearance">
    <flux:radio value="light">Light</flux:radio>
    <flux:radio value="dark">Dark</flux:radio>
    <flux:radio value="system">System</flux:radio>
</flux:radio.group>
```

```js
let button = document.querySelector('...')

button.addEventListener('click', () => {
    Flux.dark = ! Flux.dark
})
```

## Toggle button

```blade
<flux:button
    x-data
    x-on:click="$flux.dark = ! $flux.dark"
    icon="moon"
    variant="subtle"
    aria-label="Toggle dark mode"
/>
```

## Dropdown menu

```blade
<flux:dropdown x-data align="end">
    <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />

        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
    </flux:button>

    <flux:menu>
        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Toggle switch

```blade
<flux:switch x-data x-model="$flux.dark" label="Dark mode" />
```

## Segmented radio

```blade
<flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
    <flux:radio value="light" icon="sun">Light</flux:radio>
    <flux:radio value="dark" icon="moon">Dark</flux:radio>
    <flux:radio value="system" icon="computer-desktop">System</flux:radio>
</flux:radio.group>
```

```blade
<flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
    <flux:radio value="light" icon="sun" />
    <flux:radio value="dark" icon="moon" />
    <flux:radio value="system" icon="computer-desktop" />
</flux:radio.group>
```
