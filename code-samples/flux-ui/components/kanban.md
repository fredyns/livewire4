# Kanban - PRO

Source: https://fluxui.dev/components/kanban

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    @foreach </span><span style="color:#424258;--shiki-dark:#EEFFFF">($this</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">columns</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> as </span><span style="color:#424258;--shiki-dark:#EEFFFF">$column)</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.column.header</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$column->title"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :count</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"count($column->cards)"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.column.cards</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                @foreach </span><span style="color:#424258;--shiki-dark:#EEFFFF">($column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">cards</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> as </span><span style="color:#424258;--shiki-dark:#EEFFFF">$card)</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.card</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$card->title"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                @endforeach</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.column.cards</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    @endforeach</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:kanban</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Column actions

```blade
<flux:kanban.column>
    <flux:kanban.column.header :heading="$column->title" :count="count($column->cards)">
        <x-slot name="actions">
            <flux:dropdown>
                <flux:button variant="subtle" icon="ellipsis-horizontal" size="sm" />

                <flux:menu>
                    <flux:menu.item icon="plus">New card</flux:menu.item>
                    <flux:menu.item icon="archive-box">Archive column</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>

            <flux:button variant="subtle" icon="plus" size="sm" />
        </x-slot>
    </flux:kanban.column.header>

    <flux:kanban.column.cards>
        <!-- ... -->
    </flux:kanban.column.cards>
</flux:kanban.column>
```

## Column subheading

```blade
<flux:kanban.column>
    <flux:kanban.column.header heading="Blacklog" subheading="Ideas and suggestions" />

    <flux:kanban.column.cards>
        <!-- ... -->
    </flux:kanban.column.cards>
</flux:kanban.column>
```

## Column footer

```blade
<flux:kanban.column>
    <flux:kanban.column.header :heading="$column['title']" count="5" />

    <flux:kanban.column.cards>
        <!-- ... -->
    </flux:kanban.column.cards>

    <flux:kanban.column.footer>
        <form>
            <flux:kanban.card>
                <div class="flex items-center gap-1">
                    <flux:heading class="flex-1">
                        <input class="w-full outline-none" placeholder="New card...">
                    </flux:heading>

                    <flux:button type="submit" variant="filled" size="sm" inset="top bottom" class="-me-1.5">Add</flux:button>
                </div>
            </flux:kanban.card>
        </form>

        <flux:button variant="subtle" icon="plus" size="sm" align="start">
            New card
        </flux:button>
    </flux:kanban.column.footer>
</flux:kanban.column>
```

## Card as button

```blade
<flux:kanban.card as="button" wire:click="edit" heading="Update privacy policy in app" />
```

## Card header

```blade
<flux:kanban.card as="button" heading="Update privacy policy in app">
    <x-slot name="header">
        <div class="flex gap-2">
            <flux:badge color="blue" size="sm">UI</flux:badge>
            <flux:badge color="green" size="sm">Backend</flux:badge>
            <flux:badge color="red" size="sm">Bug</flux:badge>
        </div>
    </x-slot>
</flux:kanban.card>
```

## Card footer

```blade
<flux:kanban.card as="button" heading="Update privacy policy in app">
    <x-slot name="footer">
        <flux:icon name="bars-3-bottom-left" variant="micro" class="text-zinc-400" />

        <flux:avatar.group>
            <flux:avatar circle size="xs" src="https://unavatar.io/x/calebporzio" />
            <flux:avatar circle size="xs" src="https://unavatar.io/github/hugosaintemarie" />
            <flux:avatar circle size="xs" src="https://unavatar.io/github/joshhanley" />
            <flux:avatar circle size="xs">3+</flux:avatar>
        </flux:avatar.group>
    </x-slot>
</flux:kanban.card>
```

## Reference

### `flux:kanban`

| Slot | Description |
| --- | --- |
| `default` | Place multiple `flux:kanban.column` components here to create columns in the kanban board. |

### `flux:kanban.column`

| Slot | Description |
| --- | --- |
| `default` | Should contain `flux:kanban.column.header`, `flux:kanban.column.cards`, and optionally `flux:kanban.column.footer`. |

### `flux:kanban.column.header`

| Prop | Description |
| --- | --- |
| `heading` | Column header title text. |
| `subheading` | Optional secondary text below header. |
| `count` | Optional number shown next to heading (often card count). |
| `badge` | Optional badge content next to heading. Supports `badge:*` attributes. |

### `flux:kanban.column.cards`

| Slot | Description |
| --- | --- |
| `default` | Place `flux:kanban.card` components here. |

### `flux:kanban.column.footer`

| Slot | Description |
| --- | --- |
| `default` | Footer content (commonly â€œAdd cardâ€ UI). |

### `flux:kanban.card`

| Prop | Description |
| --- | --- |
| `heading` | Card title text. |
| `as` | Render element. Options: `button`, `div` (default). |
