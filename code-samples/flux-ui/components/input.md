# Input

Source: https://fluxui.dev/components/input

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Username</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:description</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">This will be publicly displayed.</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:description</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:input</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:error</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"username"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Shorthand

```blade
<flux:input label="Username" description="This will be publicly displayed." />
```

## Class targeting

```blade
<flux:input class="max-w-xs" class:input="font-mono" />
```

## Types

```blade
<flux:input type="email" label="Email" />
<flux:input type="password" label="Password" />
<flux:input type="date" max="2999-12-31" label="Date" />
```

## File

```blade
<flux:input type="file" wire:model="logo" label="Logo" />
<flux:input type="file" wire:model="attachments" label="Attachments" multiple />
```

## Smaller

```blade
<flux:input size="sm" placeholder="Filter by..." />
```

## Disabled

```blade
<flux:input disabled label="Email" />
```

## Readonly

```blade
<flux:input readonly variant="filled" />
```

## Invalid

```blade
<flux:input invalid />
```

## Input masking

```blade
<flux:input mask="(999) 999-9999" value="7161234567" />
<flux:input mask:dynamic="$money($input)" value="1234.56" />
```

## Icons

```blade
<flux:input icon="magnifying-glass" placeholder="Search orders" />
<flux:input icon:trailing="credit-card" placeholder="4444-4444-4444-4444" />
<flux:input icon:trailing="loading" placeholder="Search transactions" />
```

## Icon buttons

```blade
<flux:input placeholder="Search orders">
    <x-slot name="iconTrailing">
        <flux:button size="sm" variant="subtle" icon="x-mark" class="-mr-1" />
    </x-slot>
</flux:input>

<flux:input type="password" value="password">
    <x-slot name="iconTrailing">
        <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
    </x-slot>
</flux:input>
```

## Clearable, copyable, and viewable inputs

```blade
<flux:input placeholder="Search orders" clearable />
<flux:input type="password" value="password" viewable />
<flux:input icon="key" value="FLUX-1234-5678-ABCD-EFGH" readonly copyable />
```

## Keyboard hint

```blade
<flux:input kbd="âŒ˜K" icon="magnifying-glass" placeholder="Search..." />
```

## As a button

```blade
<flux:input as="button" placeholder="Search..." icon="magnifying-glass" kbd="âŒ˜K" />
```

## With buttons

```blade
<flux:input.group>
    <flux:input placeholder="Post title" />
    <flux:button icon="plus">New post</flux:button>
</flux:input.group>

<flux:input.group>
    <flux:select class="max-w-fit">
        <flux:select.option selected>USD</flux:select.option>
        <!-- ... -->
    </flux:select>

    <flux:input placeholder="$99.99" />
</flux:input.group>
```

## Text prefixes and suffixes

```blade
<flux:input.group>
    <flux:input.group.prefix>https://</flux:input.group.prefix>
    <flux:input placeholder="example.com" />
</flux:input.group>

<flux:input.group>
    <flux:input placeholder="chunky-spaceship" />
    <flux:input.group.suffix>.brand.com</flux:input.group.suffix>
</flux:input.group>
```

## Input group labels

```blade
<flux:field>
    <flux:label>Website</flux:label>

    <flux:input.group>
        <flux:input.group.prefix>https://</flux:input.group.prefix>
        <flux:input wire:model="website" placeholder="example.com" />
    </flux:input.group>

    <flux:error name="website" />
</flux:field>
```

## Reference

### `flux:input`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the input to a Livewire property. |
| `label` | Label text above input (wraps in `flux:field` + `flux:label`). |
| `description` | Help text above input. |
| `description:trailing` | Help text below input. |
| `placeholder` | Placeholder text. |
| `size` | Options: `sm`, `xs`. |
| `variant` | Options: `filled`. Default: `outline`. |
| `disabled` | Disables interaction. |
| `readonly` | Makes input read-only. |
| `invalid` | Error styling. |
| `multiple` | For file inputs, allows multiple files. |
| `mask` | Input mask pattern using Alpine mask plugin. |
| `mask:dynamic` | Dynamic mask pattern. |
| `icon` | Leading icon name. |
| `icon:trailing` | Trailing icon name. |
| `kbd` | Keyboard shortcut hint. |
| `clearable` | Shows clear button when input has content. |
| `copyable` | Shows copy button (https only). |
| `viewable` | Password show/hide toggle. |
| `as` | Render as different element. Options: `button`. Default: `input`. |
| `class:input` | Classes applied to the input element (not wrapper). |

### `flux:input.group`

| Slot | Description |
| --- | --- |
| `default` | Group content (input + prefix/suffix/etc.). |

### `flux:input.group.prefix`

| Slot | Description |
| --- | --- |
| `default` | Content before the input. |

### `flux:input.group.suffix`

| Slot | Description |
| --- | --- |
| `default` | Content after the input. |
