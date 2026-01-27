# Separator

Source: https://fluxui.dev/components/separator

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:separator</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## With text

```blade
<flux:separator text="or" />
```

## Vertical

```blade
<flux:separator vertical />
```

## Limited height

```blade
<flux:separator vertical class="my-2" />
```

## Subtle

```blade
<flux:separator vertical variant="subtle" />
```

## Reference

### `flux:separator`

| Prop | Description |
| --- | --- |
| `vertical` | Vertical separator (default is horizontal). |
| `variant` | Options: `subtle` (default is standard). |
| `text` | Optional centered text. |
| `orientation` | Alternative to `vertical`. Options: `horizontal`, `vertical`. Default: `horizontal`. |
