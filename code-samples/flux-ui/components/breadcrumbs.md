# Breadcrumbs

Source: https://fluxui.dev/components/breadcrumbs

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Home</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Blog</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Post</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs.item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:breadcrumbs</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#">Home</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## With slashes

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" separator="slash">Home</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#" separator="slash">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item separator="slash">Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## With icon

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />
    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## With ellipsis

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />
    <flux:breadcrumbs.item icon="ellipsis-horizontal" />
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## With ellipsis dropdown

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />

    <flux:breadcrumbs.item>
        <flux:dropdown>
            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" />

            <flux:navmenu>
                <flux:navmenu.item>Client</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-turn-down-right">Team</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-turn-down-right">User</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:breadcrumbs.item>

    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## Reference

### `flux:breadcrumbs`

| Slot | Description |
| --- | --- |
| `default` | The breadcrumb items to display. |

### `flux:breadcrumbs.item`

| Prop | Description |
| --- | --- |
| `href` | URL the breadcrumb item links to. If omitted, renders as non-clickable text. |
| `icon` | Name of the icon to display before the badge text. |
| `icon:variant` | Icon variant. Options: `outline`, `solid`, `mini`, `micro`. Default: `mini`. |
| `separator` | Name of the icon to display as the separator. Default: `chevron-right`. |
