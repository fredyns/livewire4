# Toast - PRO

Source: https://fluxui.dev/components/toast

A message that provides feedback to users about an action or event, often temporary and dismissible.

## Basic Example

```blade
Flux::toast(text: 'Changes saved.');
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
| position | Position of the toast on the screen. Options: bottom end (default), bottom center, bottom start, top end, top center, top start. |

### `flux:toast.group`

| Prop | Description |
| --- | --- |
| position | Position of the toast group on the screen. Options: bottom end (default), bottom center, bottom start, top end, top center, top start. |
| expanded | If true, always shows the toast stack in an expanded state, making all toasts visible at once. Default: false. |

### `Flux::toast()`

| Parameter | Description |
| --- | --- |
| heading | Optional heading text for the toast. |
| text | Main content text of the toast. |
| variant | Visual style. Options: success, warning, danger. |
| duration | Duration in milliseconds. Use 0 for permanent toasts. Default: 5000. |

### `$flux.toast()`

| Parameter | Description |
| --- | --- |
| message | A string containing the toast message. When using this simple form, the message becomes the toast's text content. |
| options | Alternatively, an object containing: - heading: Optional title text - text: Main message text - variant: Visual style (success, warning, danger) - duration: Display time in milliseconds |
