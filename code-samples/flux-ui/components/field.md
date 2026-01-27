# Field

Source: https://fluxui.dev/components/field

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Email</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:input</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"email"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> type</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"email"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:error</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"email"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Shorthand props

```blade
<flux:input wire:model="email" label="Email" type="email" />
```

## With trailing description

```blade
<flux:field>
    <flux:label>Password</flux:label>
    <flux:input type="password" />
    <flux:error name="password" />

    <flux:description>
        Must be at least 8 characters long, include an uppercase letter, a number, and a special character.
    </flux:description>
</flux:field>

<!-- Alternative shorthand syntax... -->

<flux:input
    type="password"
    label="Password"
    description:trailing="Must be at least 8 characters long, include an uppercase letter, a number, and a special character."
/>
```

## With badge

```blade
<flux:field>
    <flux:label badge="Required">Email</flux:label>
    <flux:input type="email" required />
    <flux:error name="email" />
</flux:field>

<flux:field>
    <flux:label badge="Optional">Phone number</flux:label>
    <flux:input type="phone" placeholder="(555) 555-5555" mask="(999) 999-9999" />
    <flux:error name="phone" />
</flux:field>
```

## Split layout

```blade
<div class="grid grid-cols-2 gap-4">
    <flux:input label="First name" placeholder="River" />
    <flux:input label="Last name" placeholder="Porzio" />
</div>
```

## Fieldset

```blade
<flux:fieldset>
    <flux:legend>Shipping address</flux:legend>

    <div class="space-y-6">
        <flux:input label="Street address line 1" placeholder="123 Main St" class="max-w-sm" />
        <flux:input label="Street address line 2" placeholder="Apartment, studio, or floor" class="max-w-sm" />

        <div class="grid grid-cols-2 gap-x-4 gap-y-6">
            <flux:input label="City" placeholder="San Francisco" />
            <flux:input label="State / Province" placeholder="CA" />
            <flux:input label="Postal / Zip code" placeholder="12345" />

            <flux:select label="Country">
                <option selected>United States</option>
                <!-- ... -->
            </flux:select>
        </div>
    </div>
</flux:fieldset>
```

## Reference

### `flux:field`

| Prop | Description |
| --- | --- |
| `variant` | Visual style variant. Options: `block`, `inline`. Default: `block`. |

### `flux:label`

| Prop | Description |
| --- | --- |
| `badge` | Optional badge text (e.g. `Required`, `Optional`). |

### `flux:description`

| Slot | Description |
| --- | --- |
| `default` | The descriptive text content. |

### `flux:error`

| Prop | Description |
| --- | --- |
| `name` | Field name to display validation errors for. |
| `message` | Custom error message (optional). |
| `bag` | Error bag name. Default: `default`. |
| `deep` | Whether to search nested array fields. Default: `true`. |
| `icon` | Icon shown with message. Default: `exclamation-triangle`. Set `false` to hide. |

### `flux:fieldset`

| Prop | Description |
| --- | --- |
| `legend` | Fieldset heading text. |
| `description` | Optional description text. |

### `flux:legend`

| Slot | Description |
| --- | --- |
| `default` | Fieldset heading text. |
