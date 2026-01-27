# Radio

Source: https://fluxui.dev/components/radio

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"payment"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Select your payment method"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"cc"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Credit Card"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"paypal"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Paypal"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"ach"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Bank transfer"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## With descriptions

```blade
<flux:radio.group label="Role">
    <flux:radio
        name="role"
        value="administrator"
        label="Administrator"
        description="Administrator users can perform any action."
        checked
    />

    <flux:radio
        name="role"
        value="editor"
        label="Editor"
        description="Editor users have the ability to read, create, and update."
    />

    <flux:radio
        name="role"
        value="viewer"
        label="Viewer"
        description="Viewer users only have the ability to read. Create, and update are restricted."
    />
</flux:radio.group>
```

## Within fieldset

```blade
<flux:fieldset>
    <flux:legend>Role</flux:legend>

    <flux:radio.group>
        <flux:radio
            value="administrator"
            label="Administrator"
            description="Administrator users can perform any action."
            checked
        />

        <flux:radio
            value="editor"
            label="Editor"
            description="Editor users have the ability to read, create, and update."
        />

        <flux:radio
            value="viewer"
            label="Viewer"
            description="Viewer users only have the ability to read. Create, and update are restricted."
        />
    </flux:radio.group>
</flux:fieldset>
```

## Segmented

```blade
<flux:radio.group wire:model="role" label="Role" variant="segmented">
    <flux:radio label="Admin" />
    <flux:radio label="Editor" />
    <flux:radio label="Viewer" />
</flux:radio.group>
```

```blade
<flux:radio.group wire:model="role" label="Role" variant="segmented" size="sm">
    <flux:radio label="Admin" />
    <flux:radio label="Editor" />
    <flux:radio label="Viewer" />
</flux:radio.group>
```

## Segmented with icons

```blade
<flux:radio.group wire:model="role" variant="segmented">
    <flux:radio label="Admin" icon="wrench" />
    <flux:radio label="Editor" icon="pencil-square" />
    <flux:radio label="Viewer" icon="eye" />
</flux:radio.group>
```

## Radio cards

```blade
<flux:radio.group wire:model="shipping" label="Shipping" variant="cards" class="max-sm:flex-col">
    <flux:radio value="standard" label="Standard" description="4-10 business days" checked />
    <flux:radio value="fast" label="Fast" description="2-5 business days" />
    <flux:radio value="next-day" label="Next day" description="1 business day" />
</flux:radio.group>
```

```blade
<flux:radio.group ... class="max-sm:flex-col">
    <!-- ... -->
</flux:radio.group>
```

## Vertical cards

```blade
<flux:radio.group label="Shipping" variant="cards" class="flex-col">
    <flux:radio value="standard" label="Standard" description="4-10 business days" />
    <flux:radio value="fast" label="Fast" description="2-5 business days" />
    <flux:radio value="next-day" label="Next day" description="1 business day" />
</flux:radio.group>
```

## Cards with icons

```blade
<flux:radio.group label="Shipping" variant="cards" class="max-sm:flex-col">
    <flux:radio value="standard" icon="truck" label="Standard" description="4-10 business days" />
    <flux:radio value="fast" icon="cube" label="Fast" description="2-5 business days" />
    <flux:radio value="next-day" icon="clock" label="Next day" description="1 business day" />
</flux:radio.group>
```

## Cards without indicators

```blade
<flux:radio.group label="Shipping" variant="cards" :indicator="false" class="max-sm:flex-col">
    <flux:radio value="standard" icon="truck" label="Standard" description="4-10 business days" />
    <flux:radio value="fast" icon="cube" label="Fast" description="2-5 business days" />
    <flux:radio value="next-day" icon="clock" label="Next day" description="1 business day" />
</flux:radio.group>
```

## Custom card content

```blade
<flux:radio.group label="Shipping" variant="cards" class="max-sm:flex-col">
    <flux:radio value="standard" checked>
        <flux:radio.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Standard</flux:heading>
            <flux:text size="sm" class="mt-2">4-10 business days</flux:text>
        </div>
    </flux:radio>

    <flux:radio value="fast">
        <flux:radio.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Fast</flux:heading>
            <flux:text size="sm" class="mt-2">2-5 business days</flux:text>
        </div>
    </flux:radio>

    <flux:radio value="next-day">
        <flux:radio.indicator />
        <div class="flex-1">
            <flux:heading class="leading-4">Next day</flux:heading>
            <flux:text size="sm" class="mt-2">1 business day</flux:text>
        </div>
    </flux:radio>
</flux:radio.group>
```

## Pills

```blade
<flux:radio.group wire:model="priority" label="Priority" variant="pills">
    <flux:radio value="low" label="Low" />
    <flux:radio value="medium" label="Medium" />
    <flux:radio value="high" label="High" />
    <flux:radio value="critical" label="Critical" />
</flux:radio.group>
```

## Buttons

```blade
<flux:radio.group variant="buttons" class="w-full *:flex-1" label="Feedback type">
    <flux:radio icon="bug-ant" checked>Bug report</flux:radio>
    <flux:radio icon="light-bulb">Suggestion</flux:radio>
    <flux:radio icon="question-mark-circle">Question</flux:radio>
</flux:radio.group>
```

## Reference

### `flux:radio.group`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the selection to a Livewire property. |
| `label` | Label text displayed above the group (wraps in `flux:field` + `flux:label`). |
| `description` | Help text between label and group. |
| `variant` | Options: `default`, `segmented`, `cards`, `pills`, `buttons`. |
| `invalid` | Error styling. |

### `flux:radio`

| Prop | Description |
| --- | --- |
| `label` | Label text for the radio (wraps in `flux:field` + `flux:label`). |
| `description` | Help text for the radio. |
| `value` | Value when used in a group. |
| `checked` | Selected by default. |
| `disabled` | Disables interaction. |
| `icon` | Icon name (for segmented variant). |
