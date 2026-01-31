# Customization

Source: https://fluxui.dev/docs/customization

Knowing how to customize components to your own needs is a crucial part of using Flux. Flux provides multiple levels of customization so that it doesn't have to be all or nothing.

## Tailwind overrides

```blade
<flux:select class="max-w-md">
```

```blade
<flux:button class="bg-zinc-800 hover:bg-zinc-700">
```

```html
<button type="button" class="bg-zinc-800 hover:bg-zinc-700 bg-white hover:bg-zinc-100...">
```

```blade
<flux:button class="bg-zinc-800! hover:bg-zinc-700!">
```

## Publishing components

```bash
php artisan flux:publish
```

```bash
php artisan flux:publish --all
```

```text
resources/
    views/
        flux/
            checkbox.blade.php
            ...
```

## Global style overrides

```html
<style>
    [data-flux-button] {
        @apply bg-zinc-800 dark:bg-zinc-400 hover:bg-zinc-700 dark:hover:bg-zinc-300;
    }
</style>
```
