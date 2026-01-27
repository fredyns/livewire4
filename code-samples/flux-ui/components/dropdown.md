# Dropdown

Source: https://fluxui.dev/components/dropdown

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:dropdown</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon:trailing</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"chevron-down"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Options</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"plus"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">New post</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.separator</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.submenu</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Sort by"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Name</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Date</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Popularity</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.radio.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.submenu</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.submenu</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Filter"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Draft</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Published</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Archived</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.checkbox</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.submenu</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.separator</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"danger"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"trash"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Delete</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:menu</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:dropdown</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Navigation menus

```blade
<flux:dropdown position="bottom" align="end">
    <flux:profile avatar="/img/demo/user.png" name="Olivia Martin" />

    <flux:navmenu>
        <flux:navmenu.item href="#" icon="user">Account</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="building-storefront">Profile</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="credit-card">Billing</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="trash" variant="danger">Delete</flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>
```

## Positioning

```blade
<flux:dropdown position="top" align="start">

<!-- More positions... -->

<flux:dropdown position="right" align="center">

<flux:dropdown position="bottom" align="center">

<flux:dropdown position="left" align="end">
```

## Offset & gap

```blade
<flux:dropdown offset="-15" gap="2">
```

## Keyboard hints

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Options</flux:button>

    <flux:menu>
        <flux:menu.item icon="pencil-square" kbd="âŒ˜S">Save</flux:menu.item>
        <flux:menu.item icon="document-duplicate" kbd="âŒ˜D">Duplicate</flux:menu.item>
        <flux:menu.item icon="trash" variant="danger" kbd="âŒ˜âŒ«">Delete</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Checkbox items

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Permissions</flux:button>

    <flux:menu>
        <flux:menu.checkbox wire:model="read" checked>Read</flux:menu.checkbox>
        <flux:menu.checkbox wire:model="write" checked>Write</flux:menu.checkbox>
        <flux:menu.checkbox wire:model="delete">Delete</flux:menu.checkbox>
    </flux:menu>
</flux:dropdown>
```

## Radio items

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Sort by</flux:button>

    <flux:menu>
        <flux:menu.radio.group wire:model="sortBy">
            <flux:menu.radio checked>Latest activity</flux:menu.radio>
            <flux:menu.radio>Date created</flux:menu.radio>
            <flux:menu.radio>Most popular</flux:menu.radio>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
```

## Groups

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Options</flux:button>

    <flux:menu>
        <flux:menu.item>View</flux:menu.item>
        <flux:menu.item>Transfer</flux:menu.item>
        <flux:menu.separator />
        <flux:menu.item>Publish</flux:menu.item>
        <flux:menu.item>Share</flux:menu.item>
        <flux:menu.separator />
        <flux:menu.item variant="danger">Delete</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Groups with headings

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Options</flux:button>

    <flux:menu>
        <flux:menu.group heading="Account">
            <flux:menu.item>Profile</flux:menu.item>
            <flux:menu.item>Permissions</flux:menu.item>
        </flux:menu.group>

        <flux:menu.group heading="Billing">
            <flux:menu.item>Transactions</flux:menu.item>
            <flux:menu.item>Payouts</flux:menu.item>
            <flux:menu.item>Refunds</flux:menu.item>
        </flux:menu.group>

        <flux:menu.item>Logout</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Submenus

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Options</flux:button>

    <flux:menu>
        <flux:menu.submenu heading="Sort by">
            <flux:menu.radio checked>Name</flux:menu.radio>
            <flux:menu.radio>Date</flux:menu.radio>
            <flux:menu.radio>Popularity</flux:menu.radio>
        </flux:menu.submenu>

        <flux:menu.submenu heading="Filter">
            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
            <flux:menu.checkbox checked>Published</flux:menu.checkbox>
            <flux:menu.checkbox>Archived</flux:menu.checkbox>
        </flux:menu.submenu>

        <flux:menu.separator />

        <flux:menu.item variant="danger">Delete</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Keep open

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Filter</flux:button>

    <flux:menu keep-open>
        <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
        <flux:menu.checkbox checked>Published</flux:menu.checkbox>
        <flux:menu.checkbox>Archived</flux:menu.checkbox>
    </flux:menu>
</flux:dropdown>
```

```blade
<flux:dropdown>
    <flux:button icon:trailing="chevron-down">Filters</flux:button>

    <flux:menu>
        <flux:menu.checkbox keep-open checked>Draft</flux:menu.checkbox>
        <flux:menu.checkbox keep-open checked>Published</flux:menu.checkbox>
        <flux:menu.checkbox keep-open>Archived</flux:menu.checkbox>
        <flux:menu.separator />
        <flux:menu.item variant="danger">Clear</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Reference

### `flux:dropdown`

| Prop | Description |
| --- | --- |
| `position` | Position of the dropdown menu. Options: `top`, `right`, `bottom` (default), `left`. |
| `align` | Alignment of the dropdown menu. Options: `start`, `center`, `end`. Default: `start`. |
| `offset` | Offset in pixels from the trigger element. Default: `0`. |
| `gap` | Gap in pixels between trigger and menu. Default: `4`. |

### `flux:menu`

| Prop | Description |
| --- | --- |
| `keep-open` | Prevents the menu from closing when any item inside of it is clicked. |

### `flux:menu.item`

| Prop | Description |
| --- | --- |
| `icon` | Name of the icon to display at the start of the item. |
| `icon:trailing` | Name of the icon to display at the end of the item. |
| `icon:variant` | Variant of the icon. Options: `outline`, `solid`, `mini`, `micro`. |
| `kbd` | Keyboard shortcut hint displayed at the end of the item. |
| `suffix` | Text displayed at the end of the item. |
| `variant` | Visual style of the item. Options: `default`, `danger`. |
| `disabled` | If `true`, prevents interaction with the menu item. |
| `keep-open` | Prevents the menu from closing when this item is selected. |

### `flux:menu.submenu`

| Prop | Description |
| --- | --- |
| `heading` | Text displayed as the submenu heading. |
| `icon` | Name of the icon to display at the start of the submenu. |
| `icon:trailing` | Name of the icon to display at the end of the submenu. |
| `icon:variant` | Variant of the icon. Options: `outline`, `solid`, `mini`, `micro`. |
| `keep-open` | Prevents the submenu from closing when any item inside of it is selected. |

### `flux:menu.checkbox-group`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the checkbox group to a Livewire property. |

### `flux:menu.checkbox`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the checkbox to a Livewire property. |
| `checked` | If `true`, the checkbox is checked by default. |
| `disabled` | If `true`, prevents interaction with the checkbox. |
| `keep-open` | Prevents the menu from closing when this checkbox is selected. |

### `flux:menu.radio.group`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the radio group to a Livewire property. |
| `keep-open` | Prevents the menu from closing when any radio in this group is selected. |

### `flux:menu.radio`

| Prop | Description |
| --- | --- |
| `checked` | If `true`, the radio button is selected by default. |
| `disabled` | If `true`, prevents interaction with the radio button. |
| `keep-open` | Prevents the menu from closing when this radio is selected. |
