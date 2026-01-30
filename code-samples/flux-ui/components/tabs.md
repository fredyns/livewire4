# Tabs - PRO

Source: https://fluxui.dev/components/tabs

Organize content into separate panels within a single container. Easily switch between sections without leaving the page.

## Basic Example

```blade
<flux:tab.group>
    <flux:tabs>
        <flux:tab name="profile">Profile</flux:tab>
        <flux:tab name="account">Account</flux:tab>
        <flux:tab name="billing">Billing</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="profile">Profile content</flux:tab.panel>
    <flux:tab.panel name="account">Account content</flux:tab.panel>
    <flux:tab.panel name="billing">Billing content</flux:tab.panel>
</flux:tab.group>
```

## With icons

```blade
<flux:tab.group>
    <flux:tabs>
        <flux:tab name="profile" icon="user">Profile</flux:tab>
        <flux:tab name="account" icon="cog-6-tooth">Account</flux:tab>
        <flux:tab name="billing" icon="banknotes">Billing</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="profile">...</flux:tab.panel>
    <flux:tab.panel name="account">...</flux:tab.panel>
    <flux:tab.panel name="billing">...</flux:tab.panel>
</flux:tab.group>
```

## Padded edges

```blade
<flux:tabs class="px-4">
    <flux:tab name="profile">Profile</flux:tab>
    <flux:tab name="account">Account</flux:tab>
    <flux:tab name="billing">Billing</flux:tab>
</flux:tabs>
```

## Scrollable tabs

```blade
<flux:tab.group>
    <flux:tabs scrollable>
        <flux:tab name="profile">Profile</flux:tab>
        <flux:tab name="account">Account</flux:tab>
        <flux:tab name="billing">Billing</flux:tab>
        <flux:tab name="security">Security</flux:tab>
        <flux:tab name="notifications">Notifications</flux:tab>
        <flux:tab name="integrations">Integrations</flux:tab>
        <flux:tab name="api">API</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="profile">...</flux:tab.panel>
    <flux:tab.panel name="account">...</flux:tab.panel>
    <flux:tab.panel name="billing">...</flux:tab.panel>
    <flux:tab.panel name="security">...</flux:tab.panel>
    <flux:tab.panel name="notifications">...</flux:tab.panel>
    <flux:tab.panel name="integrations">...</flux:tab.panel>
    <flux:tab.panel name="api">...</flux:tab.panel>
</flux:tab.group>
```

```blade
<flux:tab.group>
    <flux:tabs scrollable scrollable:fade>
        <flux:tab name="profile">Profile</flux:tab>
        <flux:tab name="account">Account</flux:tab>
        <flux:tab name="billing">Billing</flux:tab>
        <flux:tab name="security">Security</flux:tab>
        <flux:tab name="notifications">Notifications</flux:tab>
        <flux:tab name="integrations">Integrations</flux:tab>
        <flux:tab name="api">API</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="profile">...</flux:tab.panel>
    <flux:tab.panel name="account">...</flux:tab.panel>
    <flux:tab.panel name="billing">...</flux:tab.panel>
    <flux:tab.panel name="security">...</flux:tab.panel>
    <flux:tab.panel name="notifications">...</flux:tab.panel>
    <flux:tab.panel name="integrations">...</flux:tab.panel>
    <flux:tab.panel name="api">...</flux:tab.panel>
</flux:tab.group>
```

## Segmented tabs

```blade
<flux:tabs variant="segmented">
    <flux:tab>List</flux:tab>
    <flux:tab>Board</flux:tab>
    <flux:tab>Timeline</flux:tab>
</flux:tabs>
```

## Segmented with icons

```blade
<flux:tabs variant="segmented">
    <flux:tab icon="list-bullet">List</flux:tab>
    <flux:tab icon="squares-2x2">Board</flux:tab>
    <flux:tab icon="calendar-days">Timeline</flux:tab>
</flux:tabs>
```

## Small segmented tabs

```blade
<flux:tabs variant="segmented" size="sm">
    <flux:tab>Demo</flux:tab>
    <flux:tab>Code</flux:tab>
</flux:tabs>
```

## Pill tabs

```blade
<flux:tabs variant="pills">
    <flux:tab>List</flux:tab>
    <flux:tab>Board</flux:tab>
    <flux:tab>Timeline</flux:tab>
</flux:tabs>
```

## Dynamic tabs

```blade
<flux:tab.group>
    <flux:tabs>
        @foreach($tabs as $id => $tab)
            <flux:tab :name="$id">{{ $tab }}</flux:tab>
        @endforeach
        <flux:tab icon="plus" wire:click="addTab" action>Add tab</flux:tab>
    </flux:tabs>
    @foreach($tabs as $id => $tab)
        <flux:tab.panel :name="$id">
            <!-- ... -->
        </flux:tab.panel>
    @endforeach
</flux:tab.group>

<!-- Livewire component example code...
public array $tabs = [
    'tab-1' => 'Tab #1',
    'tab-2' => 'Tab #2',
];

public function addTab(): void
{
    $id = 'tab-' . str()->random();
    $this->tabs[$id] = 'Tab #' . count($this->tabs) + 1;
} -->
```

## Reference

### `flux:tab.group`

| Slot | Description |
| --- | --- |
| default | The tabs and panels components. |

### `flux:tabs`

| Prop | Description |
| --- | --- |
| wire:model | Binds the active tab to a Livewire property. See wire:model documentation |
| variant | Visual style of the tabs. Options: default, segmented, pills. |
| size | Size of the tabs. Options: base (default), sm. |
| scrollable | Enables horizontal scrolling. |
| scrollable:scrollbar | Controls scrollbar visibility when tabs are scrollable. Options: hide. |
| scrollable:fade | Adds a fade effect to the trailing edge when tabs are scrollable. |

### `flux:tab`

| Prop | Description |
| --- | --- |
| name | Unique identifier for the tab, used to match with its panel. |
| icon | Name of the icon to display at the start of the tab. |
| icon:trailing | Name of the icon to display at the end of the tab. |
| icon:variant | Variant of the icon. Options: outline, solid, mini, micro. |
| selected | If true, the tab is selected by default. |
| action | Converts the tab to an action button (used for "Add tab" functionality). |
| accent | If true, applies accent color styling to the tab. |
| size | Size of the tab (only applies when variant="segmented"). Options: base (default), sm. |
| disabled | Disables the tab. |

### `flux:tab.panel`

| Prop | Description |
| --- | --- |
| name | Unique identifier matching the associated tab. |
| selected | If true, the panel is selected by default. |
