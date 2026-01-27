# Text

Source: https://fluxui.dev/components/text

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Text component</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"mt-2"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">This is the standard text component for body copy and general content throughout your application.</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Size

```blade
<flux:text class="text-base">Base text size</flux:text>
<flux:text>Default text size</flux:text>
<flux:text class="text-xs">Smaller text</flux:text>
```

## Color

```blade
<flux:text variant="strong">Strong text color</flux:text>
<flux:text>Default text color</flux:text>
<flux:text variant="subtle">Subtle text color</flux:text>
<flux:text color="blue">Colored text</flux:text>
```

## Link

```blade
<flux:text>
    Visit our <flux:link href="#">documentation</flux:link> for more information.
</flux:text>
```

## Link variants

```blade
<flux:link href="#">Default link</flux:link>
<flux:link href="#" variant="ghost">Ghost link</flux:link>
<flux:link href="#" variant="subtle">Subtle link</flux:link>
```

## Link as button

```blade
<flux:link as="button" wire:click="...">Create new account â†’</flux:link>
```

## Reference

### `flux:text`

| Prop | Description |
| --- | --- |
| `size` | Options: `sm`, `default`, `lg`, `xl`. Default: `default`. |
| `variant` | Options: `strong`, `subtle`. Default: `default`. |
| `color` | Options: `default`, `red`, `orange`, `yellow`, `lime`, `green`, `emerald`, `teal`, `cyan`, `sky`, `blue`, `indigo`, `violet`, `purple`, `fuchsia`, `pink`, `rose`. Default: `default`. |
| `inline` | If `true`, renders as `span` instead of `p`. |

### `flux:link`

| Prop | Description |
| --- | --- |
| `href` | URL the link points to. Required. |
| `variant` | Options: `default`, `ghost`, `subtle`. Default: `default`. |
| `external` | If `true`, opens in a new tab. |
| `as` | Options: `a` (default), `button`. |
