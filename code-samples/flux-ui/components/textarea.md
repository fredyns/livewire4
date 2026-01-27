# Textarea

Source: https://fluxui.dev/components/textarea

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:textarea</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## With placeholder

```blade
<flux:textarea
    label="Order notes"
    placeholder="No lettuce, tomato, or onion..."
/>
```

## Fixed row height

```blade
<flux:textarea rows="2" label="Note" />
```

## Auto-sizing textarea

```blade
<flux:textarea rows="auto" />
```

## Configure resize

```blade
<flux:textarea resize="vertical" />
<flux:textarea resize="none" />
<flux:textarea resize="horizontal" />
<flux:textarea resize="both" />
```

## Reference

### `flux:textarea`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds to a Livewire property. |
| `placeholder` | Placeholder text. |
| `label` | Label text. When set, wraps in a `flux:field` with an adjacent `flux:label`. |
| `description` | Help text used with `label` inside the `flux:field` wrapper. |
| `description:trailing` | Show description below the textarea instead of above it. |
| `badge` | Badge text displayed at the end of the label. |
| `rows` | Number of visible lines. Use `auto` for automatic height. Default: `4`. |
| `resize` | Options: `vertical` (default), `horizontal`, `both`, `none`. |
| `invalid` | Apply error styling. |
