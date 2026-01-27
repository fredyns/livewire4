# Toast - PRO

Source: https://fluxui.dev/components/toast

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">body</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    <!-- ... --></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:toast</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">body</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## With heading

```blade
Flux::toast(
    heading: 'Changes saved.',
    text: 'You can always update this in your settings.',
);
```

## Variants

```blade
Flux::toast(variant: 'success', ...);
Flux::toast(variant: 'warning', ...);
Flux::toast(variant: 'danger', ...);
```

## Positioning

```blade
<flux:toast position="top end" />

<!-- Customize top padding for things like navbars... -->
<flux:toast position="top end" class="pt-24" />
```

## Duration

```blade
// 1 second...
Flux::toast(duration: 1000, ...);
```

## Permanent

```blade
// Show indefinitely...
Flux::toast(duration: 0, ...);
```

## Stack

```blade
<flux:toast.group>
    <flux:toast />
</flux:toast.group>
```

```blade
<flux:toast.group expanded>
    <flux:toast />
</flux:toast.group>
```

```blade
<flux:toast.group position="top end">
    <flux:toast />
</flux:toast.group>
```

## Reference

### `flux:toast`

| Prop | Description |
| --- | --- |
| `position` | Options: `bottom end` (default), `bottom center`, `bottom start`, `top end`, `top center`, `top start`. |

### `flux:toast.group`

| Prop | Description |
| --- | --- |
| `position` | Options: `bottom end` (default), `bottom center`, `bottom start`, `top end`, `top center`, `top start`. |
| `expanded` | If `true`, always expands the stack. Default: `false`. |

### `Flux::toast()`

| Parameter | Description |
| --- | --- |
| `heading` | Optional heading text. |
| `text` | Main toast text. |
| `variant` | Options: `success`, `warning`, `danger`. |
| `duration` | Milliseconds. Use `0` for permanent. Default: `5000`. |

### `$flux.toast()`

| Parameter | Description |
| --- | --- |
| `message` | Shorthand: toast body text. |
| `options` | Object containing `heading`, `text`, `variant`, `duration`. |
