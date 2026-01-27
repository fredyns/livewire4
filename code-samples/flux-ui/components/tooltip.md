# Tooltip

Source: https://fluxui.dev/components/tooltip

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:tooltip</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> content</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Settings"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"cog-6-tooth"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon:variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"outline"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:tooltip</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Info tooltip

```blade
<flux:heading class="flex items-center gap-2">
    Tax identification number

    <flux:tooltip toggleable>
        <flux:button icon="information-circle" size="sm" variant="ghost" />

        <flux:tooltip.content class="max-w-[20rem] space-y-2">
            <p>For US businesses, enter your 9-digit Employer Identification Number (EIN) without hyphens.</p>
            <p>For European companies, enter your VAT number including the country prefix (e.g., DE123456789).</p>
        </flux:tooltip.content>
    </flux:tooltip>
</flux:heading>
```

## Position

```blade
<flux:tooltip content="Settings" position="top">
    <flux:button icon="cog-6-tooth" icon:variant="outline" />
</flux:tooltip>

<flux:tooltip content="Settings" position="right">
    <flux:button icon="cog-6-tooth" icon:variant="outline" />
</flux:tooltip>

<flux:tooltip content="Settings" position="bottom">
    <flux:button icon="cog-6-tooth" icon:variant="outline" />
</flux:tooltip>

<flux:tooltip content="Settings" position="left">
    <flux:button icon="cog-6-tooth" icon:variant="outline" />
</flux:tooltip>
```

## Disabled buttons

```blade
<flux:tooltip content="Cannot merge until reviewed by a team member">
    <div>
        <flux:button disabled icon="arrow-turn-down-right">Merge pull request</flux:button>
    </div>
</flux:tooltip>
```

## Reference

### `flux:tooltip`

| Prop | Description |
| --- | --- |
| `content` | Tooltip text (alternative to `flux:tooltip.content`). |
| `position` | Options: `top` (default), `right`, `bottom`, `left`. |
| `align` | Options: `center` (default), `start`, `end`. |
| `disabled` | Prevents user interaction. |
| `gap` | Spacing between trigger and tooltip. Default: `5px`. |
| `offset` | Offset from trigger. Default: `0px`. |
| `toggleable` | Clickable tooltip (useful for touch). |
| `interactive` | Uses ARIA attributes for interactive content (`aria-expanded`, `aria-controls`). |
| `kbd` | Keyboard shortcut hint shown in tooltip. |

### `flux:tooltip.content`

| Prop | Description |
| --- | --- |
| `kbd` | Keyboard shortcut hint shown in tooltip content. |
