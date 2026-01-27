# Rich text editor - PRO

Source: https://fluxui.dev/components/editor

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:editor</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"content"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"…"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> description</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"…"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Configuring items

```blade
<flux:editor toolbar="heading | bold italic underline | align ~ undo redo" />
```

## Custom items

```blade
- resources
    - views
        - flux
            - editor
                - copy.blade.php
```

```blade
<flux:tooltip content="{{ __('Copy to clipboard') }}" class="contents">
    <flux:editor.button
        x-on:click="navigator.clipboard?.writeText($el.closest('[data-flux-editor]').value); $el.setAttribute('data-copied', ''); setTimeout(() => $el.removeAttribute('data-copied'), 2000)"
    >
        <flux:icon.clipboard variant="outline" class="[[data-copied]_&]:hidden size-5!" />
        <flux:icon.clipboard-document-check variant="outline" class="hidden [[data-copied]_&]:block size-5!" />
    </flux:editor.button>
</flux:tooltip>
```

```blade
<flux:editor toolbar="heading | [â€¦] | align ~ copy" />
```

## Customization

```blade
<flux:editor>
    <flux:editor.toolbar>
        <flux:editor.heading />
        <flux:editor.separator />
        <flux:editor.bold />
        <flux:editor.italic />
        <flux:editor.strike />
        <flux:editor.separator />
        <flux:editor.bullet />
        <flux:editor.ordered />
        <flux:editor.blockquote />
        <flux:editor.separator />
        <flux:editor.link />
        <flux:editor.separator />
        <flux:editor.align />
        <flux:editor.spacer />

        <flux:dropdown position="bottom end" offset="-15">
            <flux:editor.button icon="ellipsis-horizontal" tooltip="More" />

            <flux:menu>
                <flux:menu.item wire:click="â€¦" icon="arrow-top-right-on-square">Preview</flux:menu.item>
                <flux:menu.item wire:click="â€¦" icon="arrow-down-tray">Export</flux:menu.item>
                <flux:menu.item wire:click="â€¦" icon="share">Share</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:editor.toolbar>

    <flux:editor.content />
</flux:editor>
```

## Height

```blade
<flux:editor class="**:data-[slot=content]:min-h-[100px]!" />
```

## Localization

```blade
// lang/es.json

{
    "Rich text editor": "Editor de texto enriquecido",
    "Formatting": "Formato",
    "Text": "Texto",
    "Heading 1": "Encabezado 1",
    "Heading 2": "Encabezado 2",
    "Heading 3": "Encabezado 3",
    "Styles": "Estilos",
    "Bold": "Negrita",
    "Italic": "Cursiva",
    "Underline": "Subrayado",
    "Strikethrough": "Tachado",
    "Subscript": "SubÃ­ndice",
    "Superscript": "SuperÃ­ndice",
    "Highlight": "Resaltar",
    "Code": "CÃ³digo",
    "Bullet list": "Lista con viÃ±etas",
    "Ordered list": "Lista numerada",
    "Blockquote": "Cita",
    "Insert link": "Insertar enlace",
    "Unlink": "Quitar enlace",
    "Align": "Alinear",
    "Left": "Izquierda",
    "Center": "Centro",
    "Right": "Derecha",
    "Undo": "Deshacer",
    "Redo": "Rehacer"
}
```

## Set up listener

```blade
<head>
    ...
</head>
```

```blade
...

document.addEventListener('flux:editor', (e) => {
    ...
})
```

## Registering extensions

```blade
import Youtube from 'https://cdn.jsdelivr.net/npm/@tiptap/extension-youtube@2.11.7/+esm'

document.addEventListener('flux:editor', (e) => {
    e.detail.registerExtensions([
        Youtube.configure({
            controls: false,
            nocookie: true,
        }),
    ])
})
```

## Disabling extensions

```blade
document.addEventListener('flux:editor', (e) => {
    e.detail.disableExtension('underline')
})
```

## Accessing the instance

```blade
document.addEventListener('flux:editor', (e) => {
    e.detail.init(({ editor }) => {
        editor.on('create', () => {})
        editor.on('update', () => {})
        editor.on('selectionUpdate', () => {})
        editor.on('transaction', () => {})
        editor.on('focus', () => {})
        editor.on('blur', () => {})
        editor.on('destroy', () => {})
        editor.on('drop', () => {})
        editor.on('paste', () => {})
        editor.on('contentError', () => {})
    })
})
```

## Reference

### `flux:editor`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the editor to a Livewire property. |
| `value` | Initial content for the editor (when not using `wire:model`). |
| `label` | Label text above the editor (wraps in `flux:field` + `flux:label`). |
| `description` | Help text for the editor (see `flux:field`). |
| `description:trailing` | Show description below the editor instead of above it. |
| `badge` | Badge text displayed at end of label. |
| `placeholder` | Placeholder text when the editor is empty. |
| `toolbar` | Space-separated toolbar items. Use `|` for separator and `~` for spacer. |
| `disabled` | Disables interaction. |
| `invalid` | Error styling. |

### `flux:editor.toolbar`

| Prop | Description |
| --- | --- |
| `items` | Space-separated toolbar items. Use `|` for separator and `~` for spacer. |

### `flux:editor.button`

| Prop | Description |
| --- | --- |
| `icon` | Icon name for the button. |
| `iconVariant` | Icon variant. Options: `mini`, `micro`, `outline`. |
| `tooltip` | Tooltip text shown on hover. |
| `disabled` | Disables interaction. |

### `flux:editor.content`

| Slot | Description |
| --- | --- |
| `default` | Initial HTML content for the editor. |

### `Toolbar Items`

| Component | Description |
| --- | --- |
| `heading` | Heading level selector. |
| `bold` | Bold formatting. |
| `italic` | Italic formatting. |
| `strike` | Strikethrough formatting. |
| `underline` | Underline formatting. |
| `bullet` | Bulleted list. |
| `ordered` | Numbered list. |
| `blockquote` | Block quote. |
| `code` | Code block formatting. |
| `link` | Link insertion. |
| `align` | Text alignment. |
| `undo` | Undo. |
| `redo` | Redo. |
