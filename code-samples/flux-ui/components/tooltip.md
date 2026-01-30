# Tooltip

Source: https://fluxui.dev/components/tooltip

Provide additional information when users hover over or focus on an element.

## Basic Example

```blade
<flux:tooltip content="Settings">
    <flux:button icon="cog-6-tooth" icon:variant="outline" />
</flux:tooltip>
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
| content | Text content to display in the tooltip. Alternative to using the flux:tooltip.content component. |
| position | Position of the tooltip relative to the trigger element. Options: top (default), right, bottom, left. |
| align | Alignment of the tooltip. Options: center (default), start, end. |
| disabled | Prevents user interaction with the tooltip. |
| gap | Spacing between the trigger element and the tooltip. Default: 5px. |
| offset | Offset of the tooltip from the trigger element. Default: 0px. |
| toggleable | Makes the tooltip clickable instead of hover-only. Useful for touch devices. |
| interactive | Uses the proper ARIA attributes (aria-expanded and aria-controls) to signal that the tooltip has interactive content. |
| kbd | Keyboard shortcut hint displayed at the end of the tooltip. |

### `flux:tooltip.content`

| Prop | Description |
| --- | --- |
| kbd | Keyboard shortcut hint displayed at the end of the tooltip content. |
