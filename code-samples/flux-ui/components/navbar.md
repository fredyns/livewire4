# Navbar

Source: https://fluxui.dev/components/navbar

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Home</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Features</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Pricing</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">About</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:navbar</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Detecting the current page

```blade
<flux:navbar.item href="/" current>Home</flux:navbar.item>
<flux:navbar.item href="/" :current="false">Home</flux:navbar.item>
<flux:navbar.item href="/" :current="request()->is('/')">Home</flux:navbar.item>
```

## With icons

```blade
<flux:navbar>
    <flux:navbar.item href="#" icon="home">Home</flux:navbar.item>
    <flux:navbar.item href="#" icon="puzzle-piece">Features</flux:navbar.item>
    <flux:navbar.item href="#" icon="currency-dollar">Pricing</flux:navbar.item>
    <flux:navbar.item href="#" icon="user">About</flux:navbar.item>
</flux:navbar>
```

## With badges

```blade
<flux:navbar>
    <flux:navbar.item href="#">Home</flux:navbar.item>
    <flux:navbar.item href="#" badge="12">Inbox</flux:navbar.item>
    <flux:navbar.item href="#">Contacts</flux:navbar.item>
    <flux:navbar.item href="#" badge="Pro" badge:color="lime">Calendar</flux:navbar.item>
</flux:navbar>
```

## Dropdown navigation

```blade
<flux:navbar>
    <flux:navbar.item href="#">Dashboard</flux:navbar.item>
    <flux:navbar.item href="#">Transactions</flux:navbar.item>

    <flux:dropdown>
        <flux:navbar.item icon:trailing="chevron-down">Account</flux:navbar.item>

        <flux:navmenu>
            <flux:navmenu.item href="#">Profile</flux:navmenu.item>
            <flux:navmenu.item href="#">Settings</flux:navmenu.item>
            <flux:navmenu.item href="#">Billing</flux:navmenu.item>
        </flux:navmenu>
    </flux:dropdown>
</flux:navbar>
```

## Navlist (sidebar)

```blade
<flux:navlist class="w-64">
    <flux:navlist.item href="#" icon="home">Home</flux:navlist.item>
    <flux:navlist.item href="#" icon="puzzle-piece">Features</flux:navlist.item>
    <flux:navlist.item href="#" icon="currency-dollar">Pricing</flux:navlist.item>
    <flux:navlist.item href="#" icon="user">About</flux:navlist.item>
</flux:navlist>
```

## Navlist group

```blade
<flux:navlist>
    <flux:navlist.group heading="Account" class="mt-4">
        <flux:navlist.item href="#">Profile</flux:navlist.item>
        <flux:navlist.item href="#">Settings</flux:navlist.item>
        <flux:navlist.item href="#">Billing</flux:navlist.item>
    </flux:navlist.group>
</flux:navlist>
```

## Collapsible groups

```blade
<flux:navlist class="w-64">
    <flux:navlist.item href="#" icon="home">Dashboard</flux:navlist.item>
    <flux:navlist.item href="#" icon="list-bullet">Transactions</flux:navlist.item>

    <flux:navlist.group heading="Account" expandable>
        <flux:navlist.item href="#">Profile</flux:navlist.item>
        <flux:navlist.item href="#">Settings</flux:navlist.item>
        <flux:navlist.item href="#">Billing</flux:navlist.item>
    </flux:navlist.group>
</flux:navlist>
```

```blade
<flux:navlist.group heading="Account" expandable :expanded="false">
```

## Navlist badges

```blade
<flux:navlist class="w-64">
    <flux:navlist.item href="#" icon="home">Home</flux:navlist.item>
    <flux:navlist.item href="#" icon="envelope" badge="12">Inbox</flux:navlist.item>
    <flux:navlist.item href="#" icon="user-group">Contacts</flux:navlist.item>
    <flux:navlist.item href="#" icon="calendar-days" badge="Pro" badge:color="lime">Calendar</flux:navlist.item>
</flux:navlist>
```

## Reference

### `flux:navbar`

| Slot | Description |
| --- | --- |
| `default` | The navigation items. |

### `flux:navbar.item`

| Prop | Description |
| --- | --- |
| `href` | URL the item links to. |
| `current` | Applies active styling when `true` (auto-detected if omitted). |
| `icon` | Leading icon name. |
| `icon:trailing` | Trailing icon name. |
| `badge` | Badge content (string/boolean/slot). |
| `badge:color` | Badge color (same options as `flux:badge`). |
| `badge:variant` | Badge variant. Options: `solid`, `outline`. Default: `solid`. |

### `flux:navlist`

| Slot | Description |
| --- | --- |
| `default` | The navigation items and groups. |

### `flux:navlist.item`

| Prop | Description |
| --- | --- |
| `href` | URL the item links to. |
| `current` | Applies active styling when `true` (auto-detected if omitted). |
| `icon` | Leading icon name. |
| `badge` | Badge content (string/boolean/slot). |
| `badge:color` | Badge color (same options as `flux:badge`). |
| `badge:variant` | Badge variant. Options: `solid`, `outline`. Default: `solid`. |

### `flux:navlist.group`

| Prop | Description |
| --- | --- |
| `heading` | Group heading text. |
| `expandable` | If `true`, makes the group collapsible. |
| `expanded` | If `true`, expands the group by default (when `expandable`). |
