# Patterns

Source: https://fluxui.dev/docs/patterns

Every design decision in flux was carefully and intentionally made. Understanding these intentions will make your experience with flux more intuitive.

Ideally, after internalizing some of flux's design philosophy, you will be able to almost guess how to use a component you're unfamiliar with.

## Props vs attributes

```blade
<flux:button variant="primary" x-on:change.prevent="...">
```

```html
<button type="button" class="bg-zinc-900 ..." x-on:change.prevent="...">
```

## Class merging

```blade
<flux:button class="w-full">
```

```html
<button type="button" class="w-full border border-zinc-200 ...">
```

## Dealing with class merging conflicts

```blade
<flux:button class="bg-zinc-800 hover:bg-zinc-700">
```

```html
<button type="button" class="bg-zinc-800 hover:bg-zinc-700 bg-white hover:bg-zinc-100...">
```

```blade
<flux:button class="bg-zinc-800! hover:bg-zinc-700!">
```

## Split attribute forwarding

```html
<div class="..."> <input type="text" class="..."></div>
```

```blade
<flux:input class="w-full" autofocus>
```

```html
<div class="w-full ..."> <input type="text" class="..." autofocus></div>
```

## Common props

### Variant

```blade
<flux:button variant="primary" /><flux:input variant="filled" /><flux:modal variant="flyout" /><flux:badge variant="solid" /><flux:select variant="combobox" /><flux:separator variant="subtle" /><flux:tabs variant="segmented" />
```

### Icon

```blade
<flux:button icon="magnifying-glass" /><flux:input icon="magnifying-glass" /><flux:tab icon="cog-6-tooth" /><flux:badge icon="user" /><flux:breadcrumbs.item icon="home" /><flux:navlist.item icon="user" /><flux:navbar.item icon="user" /><flux:menu.item icon="plus" />
```

```blade
<flux:button icon:trailing="chevron-down" /><flux:input icon:trailing="credit-card" /><flux:badge icon:trailing="x-mark" /><flux:navbar.item icon:trailing="chevron-down" />
```

### Size

```blade
<flux:button size="sm" /><flux:select size="sm" /><flux:input size="sm" /><flux:tabs size="sm" />
```

```blade
<flux:heading size="lg" /><flux:badge size="lg" />
```

### Keyboard hints

```blade
<flux:button kbd="⌘S" /><flux:tooltip kbd="D" /><flux:input kbd="⌘K" /><flux:menu.item kbd="⌘E" /><flux:command.item kbd="⌘N" />
```

### Inset

```blade
<flux:badge inset="top bottom"><flux:button variant="ghost" inset="left">
```

### Prop forwarding

```blade
<flux:button icon="bell" />
```

```blade
<flux:button> <flux:icon.bell /></flux:button>
```

```blade
<flux:button icon="bell" icon:variant="solid" />
```

### Opt-out props

```blade
<flux:navbar.item :current="false">
```

## Shorthand props

```blade
<flux:field> <flux:label>Email</flux:label> <flux:input wire:model="email" type="email" /> <flux:error name="email" /></flux:field>
```

```blade
<flux:input type="email" wire:model="email" label="Email" />
```

```blade
<flux:tooltip content="Settings"> <flux:button icon="cog-6-tooth" /></flux:tooltip>
```

```blade
<flux:button icon="cog-6-tooth" tooltip="Settings" />
```

## Data binding

```blade
<flux:input wire:model="email" /><flux:checkbox wire:model="terms" /><flux:switch wire:model.live="enabled" /><flux:textarea wire:model="content" /><flux:select wire:model="state" />
```

```blade
<flux:checkbox.group wire:model="notifications"><flux:radio.group wire:model="payment"><flux:tabs wire:model="activeTab">
```

## Component Groups

```blade
<flux:button.group> <flux:button /></flux:button.group><flux:input.group> <flux:input /></flux:input.group><flux:checkbox.group> <flux:checkbox /></flux:checkbox.group><flux:radio.group> <flux:radio /></flux:radio.group>
```

```blade
<flux:accordion> <flux:accordion.item /></flux:accordion><flux:menu> <flux:menu.item /></flux:menu><flux:breadcrumbs> <flux:breadcrumbs.item /></flux:breadcrumbs><flux:navbar> <flux:navbar.item /></flux:navbar><flux:navlist> <flux:navlist.item /></flux:navlist><flux:navmenu> <flux:navmenu.item /></flux:navmenu><flux:command> <flux:command.item /></flux:command><flux:autocomplete> <flux:autocomplete.item /></flux:autocomplete>
```

## Root components

```blade
<flux:field> <flux:label></flux:label> <flux:description></flux:description> <flux:error></flux:error></flux:field>
```

## Anomalies

```blade
<flux:tab.group> <flux:tabs> <flux:tab> </flux:tabs> <flux:tab.panel></flux:tab.group>
```

## Slots

```blade
<flux:input icon:trailing="x-mark" />
```

```blade
<flux:input> <x-slot name="iconTrailing"> <flux:button icon="x-mark" size="sm" variant="subtle" wire:click="clear" /> </x-slot></flux:input>
```

## Paper cuts

## Blade components vs HTML elements

```blade
<!-- Conditional attributes: --><input @if ($disabled) disabled @endif><flux:input :disabled="$disabled">
```
