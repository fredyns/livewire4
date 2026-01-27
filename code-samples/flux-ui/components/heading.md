# Heading

Source: https://fluxui.dev/components/heading

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">User profile</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"mt-2"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">This information will be displayed publicly.</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Sizes

```blade
<flux:heading>Default</flux:heading>
<flux:heading size="lg">Large</flux:heading>
<flux:heading size="xl">Extra large</flux:heading>
```

## Heading level

```blade
<flux:heading level="3">User profile</flux:heading>

<flux:text class="mt-2">This information will be displayed publicly.</flux:text>
```

## Examples

```blade
<div>
    <flux:text>Year to date</flux:text>
    <flux:heading size="xl" class="mb-1">$7,532.16</flux:heading>

    <div class="flex items-center gap-2">
        <flux:icon.arrow-trending-up variant="micro" class="text-green-600 dark:text-green-500" />
        <span class="text-sm text-green-600 dark:text-green-500">15.2%</span>
    </div>
</div>
```

## Reference

### `flux:heading`

| Prop | Description |
| --- | --- |
| `size` | Size. Options: `base`, `lg`, `xl`. Default: `base`. |
| `level` | HTML heading level. Options: `1`, `2`, `3`, `4`. Default: renders as a `div` if not specified. |
| `accent` | If `true`, applies accent color styling. |

### `flux:text`

| Prop | Description |
| --- | --- |
| `size` | Size. Options: `sm`, `base`, `lg`, `xl`. Default: `base`. |
