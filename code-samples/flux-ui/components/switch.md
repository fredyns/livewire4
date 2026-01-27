# Switch

Source: https://fluxui.dev/components/switch

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"inline"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Enable notifications</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:label</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:switch</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model.live</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"notifications"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:error</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"notifications"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:field</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Fieldset

```blade
<flux:fieldset>
    <flux:legend>Email notifications</flux:legend>

    <div class="space-y-4">
        <flux:switch
            wire:model.live="communication"
            label="Communication emails"
            description="Receive emails about your account activity."
        />

        <flux:separator variant="subtle" />

        <flux:switch
            wire:model.live="marketing"
            label="Marketing emails"
            description="Receive emails about new products, features, and more."
        />

        <flux:separator variant="subtle" />

        <flux:switch
            wire:model.live="social"
            label="Social emails"
            description="Receive emails for friend requests, follows, and more."
        />

        <flux:separator variant="subtle" />

        <flux:switch
            wire:model.live="security"
            label="Security emails"
            description="Receive emails about your account activity and security."
        />
    </div>
</flux:fieldset>
```

## Left align

```blade
<flux:fieldset>
    <flux:legend>Email notifications</flux:legend>

    <div class="space-y-3">
        <flux:switch label="Communication emails" align="left" />
        <flux:switch label="Marketing emails" align="left" />
        <flux:switch label="Social emails" align="left" />
        <flux:switch label="Security emails" align="left" />
    </div>
</flux:fieldset>
```

## Reference

### `flux:switch`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds to a Livewire property. |
| `label` | Label text. When set, wraps in a `flux:field` with an adjacent `flux:label`. |
| `description` | Help text shown with `label` inside the `flux:field` wrapper. |
| `align` | Options: `right`\|`start` (default), `left`\|`end`. |
| `disabled` | Prevents user interaction. |
