# Command palette - PRO

Source: https://fluxui.dev/components/command

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.input</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> placeholder</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Search..."</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.items</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"user-plus"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> kbd</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"⌘A"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Assign to…</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"document-plus"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Create new file</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"folder-plus"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> kbd</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"⌘⇧N"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Create new project</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"book-open"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Documentation</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"newspaper"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Changelog</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"..."</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"cog-6-tooth"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> kbd</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"⌘,"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Settings</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command.items</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:command</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<flux:command>
    <flux:command.input placeholder="Search..." />

    <flux:command.items>
        <flux:command.item wire:click="..." icon="user-plus" kbd="âŒ˜A">Assign toâ€¦</flux:command.item>
        <flux:command.item wire:click="..." icon="document-plus">Create new file</flux:command.item>
        <flux:command.item wire:click="..." icon="folder-plus" kbd="âŒ˜â‡§N">Create new project</flux:command.item>
        <flux:command.item wire:click="..." icon="book-open">Documentation</flux:command.item>
        <flux:command.item wire:click="..." icon="newspaper">Changelog</flux:command.item>
        <flux:command.item wire:click="..." icon="cog-6-tooth" kbd="âŒ˜,">Settings</flux:command.item>
    </flux:command.items>
</flux:command>
```

## As a modal

```blade
<flux:modal.trigger name="search" shortcut="cmd.k">
    <flux:input as="button" placeholder="Search..." icon="magnifying-glass" kbd="âŒ˜K" />
</flux:modal.trigger>

<flux:modal name="search" variant="bare" class="w-full max-w-[30rem] my-[12vh] max-h-screen overflow-y-hidden">
    <flux:command class="border-none shadow-lg inline-flex flex-col max-h-[76vh]">
        <flux:command.input placeholder="Search..." closable />

        <flux:command.items>
            <flux:command.item icon="user-plus" kbd="âŒ˜A">Assign toâ€¦</flux:command.item>
            <flux:command.item icon="document-plus">Create new file</flux:command.item>
            <flux:command.item icon="folder-plus" kbd="âŒ˜â‡§N">Create new project</flux:command.item>
            <flux:command.item icon="book-open">Documentation</flux:command.item>
            <flux:command.item icon="newspaper">Changelog</flux:command.item>
            <flux:command.item icon="cog-6-tooth" kbd="âŒ˜,">Settings</flux:command.item>
        </flux:command.items>
    </flux:command>
</flux:modal>
```

## Reference

### `flux:command`

| Prop | Description |
| --- | --- |
| `data-flux-command` | Applied to the root element for styling and identification. |

### `flux:command.input`

| Prop | Description |
| --- | --- |
| `clearable` | If `true`, shows a clear button. |
| `closable` | If `true`, shows a close button to dismiss the palette. |
| `icon` | Icon shown at start. Default: `magnifying-glass`. |
| `placeholder` | Placeholder text. |

### `flux:command.items`

| Prop | Description |
| --- | --- |
| `icon` | Icon shown at start of the item. |
| `icon:variant` | Icon variant. Options: `outline` (default), `solid`, `mini`, `micro`. |
| `kbd` | Keyboard shortcut hint. |

### `flux:command.item`

| Prop | Description |
| --- | --- |
| `icon` | Icon shown at start of the item. |
| `icon:variant` | Icon variant. Options: `outline` (default), `solid`, `mini`, `micro`. |
| `kbd` | Keyboard shortcut hint. |
