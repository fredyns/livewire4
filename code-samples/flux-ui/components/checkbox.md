# Checkbox

Source: https://fluxui.dev/components/checkbox

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"inline"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:checkbox</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"terms"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">I agree to the terms and conditions</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:error</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"terms"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<flux:field variant="inline">
    <flux:checkbox wire:model="terms" />
    <flux:label>I agree to the terms and conditions</flux:label>
    <flux:error name="terms" />
</flux:field>
```

## Checkbox group

```blade
<flux:checkbox.group wire:model="notifications" label="Notifications">
    <flux:checkbox label="Push notifications" value="push" checked />
    <flux:checkbox label="Email" value="email" checked />
    <flux:checkbox label="In-app alerts" value="app" />
    <flux:checkbox label="SMS" value="sms" />
</flux:checkbox.group>
```

## With descriptions

```blade
<flux:checkbox.group wire:model="subscription" label="Subscription preferences">
    <flux:checkbox
        checked
        value="newsletter"
        label="Newsletter"
        description="Receive our monthly newsletter with the latest updates and offers."
    />

    <flux:checkbox
        value="updates"
        label="Product updates"
        description="Stay informed about new features and product updates."
    />

    <flux:checkbox
        value="invitations"
        label="Event invitations"
        description="Get invitations to our exclusive events and webinars."
    />
</flux:checkbox.group>
```

## Horizontal fieldset

```blade
<flux:fieldset>
    <flux:legend>Languages</flux:legend>
    <flux:description>Choose the languages you want to support.</flux:description>

    <div class="flex gap-4 *:gap-x-2">
        <flux:checkbox checked value="english" label="English" />
        <flux:checkbox checked value="spanish" label="Spanish" />
        <flux:checkbox value="french" label="French" />
        <flux:checkbox value="german" label="German" />
    </div>
</flux:fieldset>
```

## Check-all

```blade
<flux:checkbox.group>
    <flux:checkbox.all />
    <flux:checkbox checked />
    <flux:checkbox />
    <flux:checkbox />
</flux:checkbox.group>
```

## Checked

```blade
<flux:checkbox checked />
```

## Disabled

```blade
<flux:checkbox disabled />
```

## Checkbox cards

```blade
<flux:checkbox.group wire:model="subscription" label="Subscription preferences" variant="cards" class="max-sm:flex-col">
    <flux:checkbox
        checked
        value="newsletter"
        label="Newsletter"
        description="Get the latest updates and offers."
    />

    <flux:checkbox
        value="updates"
        label="Product updates"
        description="Learn about new features and products."
    />

    <flux:checkbox
        value="invitations"
        label="Event invitations"
        description="Invitatations to exclusive events."
    />
</flux:checkbox.group>
```

```blade
<flux:checkbox.group ... class="max-sm:flex-col">
    <!-- ... -->
</flux:checkbox.group>
```

## Vertical cards

```blade
<flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">
    <flux:checkbox
        checked
        value="newsletter"
        label="Newsletter"
        description="Get the latest updates and offers."
    />

    <flux:checkbox
        value="updates"
        label="Product updates"
        description="Learn about new features and products."
    />

    <flux:checkbox
        value="invitations"
        label="Event invitations"
        description="Invitatations to exclusive events."
    />
</flux:checkbox.group>
```

## Cards with icons

```blade
<flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">
    <flux:checkbox
        checked
        value="newsletter"
        icon="newspaper"
        label="Newsletter"
        description="Get the latest updates and offers."
    />

    <flux:checkbox
        value="updates"
        icon="cube"
        label="Product updates"
        description="Learn about new features and products."
    />

    <flux:checkbox
        value="invitations"
        icon="calendar"
        label="Event invitations"
        description="Invitatations to exclusive events."
    />
</flux:checkbox.group>
```

## Custom card content

```blade
<flux:checkbox.group label="Subscription preferences" variant="cards" class="flex-col">
    <flux:checkbox checked value="newsletter">
        <flux:checkbox.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Newsletter</flux:heading>
            <flux:text size="sm" class="mt-2">Get the latest updates and offers.</flux:text>
        </div>
    </flux:checkbox>

    <flux:checkbox value="updates">
        <flux:checkbox.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Product updates</flux:heading>
            <flux:text size="sm" class="mt-2">Learn about new features and products.</flux:text>
        </div>
    </flux:checkbox>

    <flux:checkbox value="invitations">
        <flux:checkbox.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Event invitations</flux:heading>
            <flux:text size="sm" class="mt-2">Invitatations to exclusive events.</flux:text>
        </div>
    </flux:checkbox>
</flux:checkbox.group>
```

## Pills

```blade
<flux:checkbox.group wire:model="categories" label="Categories" variant="pills">
    <flux:checkbox value="fantasy" label="Fantasy" />
    <flux:checkbox value="science-fiction" label="Science fiction" />
    <flux:checkbox value="horror" label="Horror" />
    <flux:checkbox value="mystery" label="Mystery" />
    <flux:checkbox value="romance" label="Romance" />
    <flux:checkbox value="autobiography" label="Autobiography" />
    <flux:checkbox value="thriller" label="Thriller" />
    <flux:checkbox value="poetry" label="Poetry" />
    <flux:checkbox value="children" label="Children" />
</flux:checkbox.group>
```

## Buttons

```blade
<flux:checkbox.group wire:model="features" label="Features" variant="buttons">
    <flux:checkbox value="notifications" icon="bell" label="Notifications" />
    <flux:checkbox value="analytics" icon="chart-bar" label="Analytics" />
    <flux:checkbox value="backups" icon="cloud-arrow-up" label="Backups" />
</flux:checkbox.group>
```

## Reference

### `flux:checkbox`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the checkbox to a Livewire property. |
| `label` | Label text displayed next to the checkbox. |
| `description` | Help text displayed below the checkbox. |
| `value` | Value associated with the checkbox when used in a group. |
| `checked` | Sets the checkbox to be checked by default. |
| `indeterminate` | Sets the checkbox to an indeterminate state. |
| `disabled` | Prevents user interaction with the checkbox. |
| `invalid` | Applies error styling to the checkbox. |

### `flux:checkbox.group`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the group to a Livewire property (array of selected values). |
| `label` | Label text displayed above the group. |
| `description` | Help text displayed below the label. |
| `variant` | Visual style. Options: `default`, `cards` (Pro), `pills` (Pro), `buttons` (Pro). |
| `disabled` | Disables all checkboxes in the group. |
| `invalid` | Applies error styling to all checkboxes. |

### `flux:checkbox.all`

| Prop | Description |
| --- | --- |
| `label` | Text label displayed next to the checkbox. |
| `description` | Help text displayed below the checkbox. |
| `disabled` | Prevents user interaction with the checkbox. |
