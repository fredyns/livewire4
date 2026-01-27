# Autocomplete - PRO

Source: https://fluxui.dev/components/autocomplete

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"state"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"State of residence"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Alabama</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Arkansas</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">California</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    <!-- ... --></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:autocomplete</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<flux:autocomplete wire:model="state" label="State of residence">
    <flux:autocomplete.item>Alabama</flux:autocomplete.item>
    <flux:autocomplete.item>Arkansas</flux:autocomplete.item>
    <flux:autocomplete.item>California</flux:autocomplete.item>
    <!-- ... -->
</flux:autocomplete>
```

## Reference

### `flux:autocomplete`

| Prop | Description |
| --- | --- |
| `wire:model` | The name of the Livewire property to bind the input value to. |
| `type` | HTML input type (e.g., `text`, `email`, `password`, `file`, `date`). Default: `text`. |
| `label` | Label text displayed above the input. |
| `description` | Descriptive text displayed below the label. |
| `placeholder` | Placeholder text displayed when the input is empty. |
| `size` | Size of the input. Options: `sm`, `xs`. |
| `variant` | Visual style variant. Options: `filled`. Default: `outline`. |
| `disabled` | If `true`, prevents user interaction with the input. |
| `readonly` | If `true`, makes the input read-only. |
| `invalid` | If `true`, applies error styling to the input. |
| `multiple` | For file inputs, allows selecting multiple files. |
| `mask` | Input mask pattern using Alpine's mask plugin. Example: `99/99/9999`. |
| `icon` | Name of the icon displayed at the start of the input. |
| `icon:trailing` | Name of the icon displayed at the end of the input. |
| `kbd` | Keyboard shortcut hint displayed at the end of the input. |
| `clearable` | If `true`, displays a clear button when the input has content. |
| `copyable` | If `true`, displays a copy button to copy the input's content. |
| `viewable` | For password inputs, if `true`, displays a toggle to show/hide the password. |
| `as` | Render the input as a different element. Options: `button`. Default: `input`. |
| `container:class` | Additional CSS classes applied to the autocomplete container (e.g. `max-h-80`). |
| `class:input` | CSS classes applied directly to the input element instead of the input wrapper. |

### `flux:autocomplete.item`

| Prop | Description |
| --- | --- |
| `disabled` | If present or `true`, the item cannot be selected. |
