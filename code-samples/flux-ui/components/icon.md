# Icon

Source: https://fluxui.dev/components/icon

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:icon.bolt</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Variants

```blade
<flux:icon.bolt />                  <!-- 24px, outline -->
<flux:icon.bolt variant="solid" />  <!-- 24px, filled -->
<flux:icon.bolt variant="mini" />   <!-- 20px, filled -->
<flux:icon.bolt variant="micro" />  <!-- 16px, filled -->
```

## Sizes

```blade
<flux:icon.bolt class="size-12" />
<flux:icon.bolt class="size-10" />
<flux:icon.bolt class="size-8" />
```

## Color

```blade
<flux:icon.bolt variant="solid" class="text-amber-500 dark:text-amber-300" />
```

## Loading spinner

```blade
<flux:icon.loading />
```

## Dynamic icons

```blade
<flux:icon name="bolt" />
```

## Lucide icons

```blade
php artisan flux:icon
```

```blade
php artisan flux:icon crown grip-vertical github
```

```blade
<flux:icon.crown />
<flux:icon.grip-vertical />
<flux:icon.github />
```

## Custom icons

```blade
- resources
    - views
        - flux
            - icon
                - wink.blade.php
```

```blade
@php $attributes = $unescapedForwardedAttributes ?? $attributes; @endphp

@props([
    'variant' => 'outline',
])

@php
$classes = Flux::classes('shrink-0')
    ->add(match($variant) {
        'outline' => '[:where(&)]:size-6',
        'solid' => '[:where(&)]:size-6',
        'mini' => '[:where(&)]:size-5',
        'micro' => '[:where(&)]:size-4',
    });
@endphp

{{-- Your SVG code here: --}}
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" ... >
    ...
</svg>
```

```blade
<flux:icon.wink />
```

## Reference

### `flux:icon.*`

| Prop | Description |
| --- | --- |
| `variant` | Visual style. Options: `outline` (default), `solid`, `mini`, `micro`. |

### `Icon sizes`

| Size | Description |
| --- | --- |
| `outline` | 24x24 pixels (default). |
| `solid` | 24x24 pixels. |
| `mini` | 20x20 pixels. |
| `micro` | 16x16 pixels. |
