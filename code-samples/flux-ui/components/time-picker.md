# Time picker - PRO

Source: https://fluxui.dev/components/time-picker

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:time-picker</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Basic usage

```blade
<flux:time-picker value="11:30" />
```

```blade
<flux:time-picker wire:model="time" />
```

## Input trigger

```blade
<flux:time-picker type="input" />
```

## Without dropdown

```blade
<flux:time-picker type="input" :dropdown="false" />
```

## Multiple times

```blade
<flux:time-picker multiple />
```

## Time format

```blade
<flux:time-picker time-format="12-hour" />
<flux:time-picker time-format="24-hour" />
```

## Interval

```blade
<flux:time-picker interval="60" />
```

## Min/max times

```blade
<flux:time-picker min="09:00" max="17:00" />
```

```blade
<!-- Prevent selection before now... -->
<flux:time-picker min="now" />

<!-- Prevent selection after now... -->
<flux:time-picker max="now" />
```

## Unavailable times

```blade
<flux:time-picker unavailable="03:00,04:00,05:30-07:29" />
```

## Open to

```blade
<flux:time-picker open-to="10:00" />
```

## Localization

```blade
<flux:time-picker locale="ja-JP" />
```

## Reference

### `flux:time-picker`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds to a Livewire property. |
| `value` | Selected time(s). Single: `H:i`. Multiple: `H:i,H:i`. |
| `type` | Options: `input`, `button`. Default: `button`. |
| `multiple` | Allow selecting multiple times. Default: `false`. |
| `time-format` | Options: `auto` (default), `12-hour`, `24-hour`. |
| `interval` | Minutes between options. Default: `30`. |
| `min` | Earliest selectable time (time string or `now`). |
| `max` | Latest selectable time (time string or `now`). |
| `unavailable` | Unavailable times / ranges (comma-separated). |
| `open-to` | Time to open to. Default: selected time or now. |
| `label` | Label text. When set, wraps in a `flux:field` + `flux:label`. |
| `description` | Help text used with `label` inside the `flux:field` wrapper. |
| `description:trailing` | Show description below instead of above. |
| `badge` | Badge text displayed at end of label. |
| `placeholder` | Placeholder when no time selected. |
| `size` | Options: `sm`, `xs`. |
| `clearable` | Shows a clear button when a time is selected. |
| `disabled` | Prevents user interaction. |
| `invalid` | Apply error styling. |
| `locale` | Locale for the picker (e.g. `fr`, `en-US`, `ja-JP`). |
