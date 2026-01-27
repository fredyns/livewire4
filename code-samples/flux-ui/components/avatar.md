# Avatar

Source: https://fluxui.dev/components/avatar

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:avatar</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> src</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"https://unavatar.io/x/calebporzio"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Basic

```blade
<flux:avatar src="https://unavatar.io/x/calebporzio" />
```

## Tooltip

```blade
<flux:avatar tooltip="Caleb Porzio" src="https://unavatar.io/x/calebporzio" />
```

## Initials

```blade
<flux:avatar name="Caleb Porzio" />
<flux:avatar name="calebporzio" />
<flux:avatar name="calebporzio" initials:single />

<flux:avatar initials="CP" />
```

## Sizes

```blade
<flux:avatar size="xl" src="https://unavatar.io/x/calebporzio" />
<flux:avatar size="lg" src="https://unavatar.io/x/calebporzio" />
<flux:avatar src="https://unavatar.io/x/calebporzio" />
<flux:avatar size="sm" src="https://unavatar.io/x/calebporzio" />
<flux:avatar size="xs" src="https://unavatar.io/x/calebporzio" />
```

## Icons

```blade
<flux:avatar icon="user" />
<flux:avatar icon="phone" />
<flux:avatar icon="computer-desktop" />
```

## Color

```blade
<flux:avatar name="Caleb Porzio" color="red" />
```

## Circle

```blade
<flux:avatar circle src="https://unavatar.io/x/calebporzio" />
```

## Badges

```blade
<flux:avatar badge badge:color="green" src="https://unavatar.io/x/calebporzio" />
<flux:avatar badge badge:color="zinc" badge:position="top right" badge:circle badge:variant="outline" src="https://unavatar.io/x/calebporzio" />
<flux:avatar badge="25" src="https://unavatar.io/x/calebporzio" />
<flux:avatar circle badge="ðŸ‘" badge:circle src="https://unavatar.io/x/calebporzio" />

<flux:avatar circle src="https://unavatar.io/x/calebporzio">
    <x-slot:badge>
        <img class="size-3" src="https://unavatar.io/github/hugosaintemarie" />
    </x-slot:badge>
</flux:avatar>
```

## Groups

```blade
<flux:avatar.group>
    <flux:avatar src="https://unavatar.io/x/calebporzio" />
    <flux:avatar src="https://unavatar.io/github/hugosaintemarie" />
    <flux:avatar src="https://unavatar.io/github/joshhanley" />
    <flux:avatar>3+</flux:avatar>
</flux:avatar.group>

<flux:avatar.group class="**:ring-zinc-100 dark:**:ring-zinc-800">
    <flux:avatar circle src="https://unavatar.io/x/calebporzio" />
    <flux:avatar circle src="https://unavatar.io/github/hugosaintemarie" />
    <flux:avatar circle src="https://unavatar.io/github/joshhanley" />
    <flux:avatar circle>3+</flux:avatar>
</flux:avatar.group>
```

## As link

```blade
<flux:avatar href="https://x.com/calebporzio" src="https://unavatar.io/x/calebporzio" />
```

## Testimonial

```blade
<div>
    <div class="flex items-center gap-2">
        <flux:icon.star variant="solid" />
        <flux:icon.star variant="solid" />
        <flux:icon.star variant="solid" />
        <flux:icon.star variant="solid" />
        <flux:icon.star variant="solid" />
    </div>

    <flux:heading size="xl" class="mt-4 italic">
        <p>IMO Livewire takes Blade to the next level. It's basically what Blade should be by default. ðŸ”¥</p>
    </flux:heading>

    <div class="mt-6 flex items-center gap-4">
        <flux:avatar size="lg" src="https://unavatar.io/x/taylorotwell" />

        <div>
            <flux:heading size="lg">Taylor Otwell</flux:heading>
            <flux:text>Creator of Laravel</flux:text>
        </div>
    </div>
</div>
```

## Grouped feature

```blade
<div>
    <flux:heading size="xl">The Laravel Podcast <flux:badge inset="top bottom" class="ml-1 max-sm:hidden">New</flux:badge></flux:heading>

    <flux:text class="mt-2">
        A podcast about Laravel, development best practices, and the PHP ecosystemâ€”hosted by Jeffrey Way, Matt Stauffer, and Taylor Otwell, later joined by Adam Wathan.
    </flux:text>

    <flux:avatar.group class="mt-6">
        <flux:avatar circle size="lg" src="https://unavatar.io/x/taylorotwell" />
        <flux:avatar circle size="lg" src="https://unavatar.io/x/adamwathan" />
        <flux:avatar circle size="lg" src="https://unavatar.io/x/jeffrey_way" />
        <flux:avatar circle size="lg" src="https://unavatar.io/x/stauffermatt" />
    </flux:avatar.group>
</div>
```

## Members table

```blade
<div class="flex justify-between items-center mb-4">
    <flux:heading size="lg">Team members</flux:heading>

    <flux:button size="sm" icon="plus">Invite</flux:button>
</div>

<flux:table>
    <flux:table.rows>
        <flux:table.row>
            <flux:table.cell>
                <div class="flex items-center gap-2 sm:gap-4">
                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/calebporzio" />
                    <div class="flex flex-col">
                        <flux:heading>Caleb Porzio <flux:badge size="sm" color="blue" class="ml-1 max-sm:hidden">You</flux:badge></flux:heading>
                        <flux:text class="max-sm:hidden">caleb@laravel-livewire.com</flux:text>
                    </div>
                </div>
            </flux:table.cell>

            <flux:table.cell>
                <div class="flex justify-end items-center gap-2">
                    <flux:select size="sm" class="min-w-fit max-w-fit">
                        <flux:select.option value="admin" selected>Admin</flux:select.option>
                        <flux:select.option value="member">Member</flux:select.option>
                        <flux:select.option value="guest">Guest</flux:select.option>
                    </flux:select>
                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
                </div>
            </flux:table.cell>
        </flux:table.row>

        <flux:table.row >
            <flux:table.cell>
                <div class="flex items-center gap-2 sm:gap-4">
                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/hugosaintemarie" />
                    <div class="flex flex-col">
                        <flux:heading>Hugo Sainte-Marie</flux:heading>
                        <flux:text class="max-sm:hidden">hugo@example.com</flux:text>
                    </div>
                </div>
            </flux:table.cell>

            <flux:table.cell>
                <div class="flex justify-end items-center gap-2">
                    <flux:select size="sm" class="min-w-fit max-w-fit">
                        <flux:select.option value="admin">Admin</flux:select.option>
                        <flux:select.option value="member" selected>Member</flux:select.option>
                        <flux:select.option value="guest">Guest</flux:select.option>
                    </flux:select>
                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
                </div>
            </flux:table.cell>
        </flux:table.row>

        <flux:table.row>
            <flux:table.cell>
                <div class="flex items-center gap-2 sm:gap-4">
                    <flux:avatar circle size="lg" class="max-sm:size-8" src="https://unavatar.io/github/joshhanley" />
                    <div class="flex flex-col">
                        <flux:heading>Josh Hanley</flux:heading>
                        <flux:text class="max-sm:hidden">josh@example.com</flux:text>
                    </div>
                </div>
            </flux:table.cell>

            <flux:table.cell>
                <div class="flex justify-end items-center gap-2">
                    <flux:select size="sm" class="min-w-fit max-w-fit">
                        <flux:select.option value="admin">Admin</flux:select.option>
                        <flux:select.option value="member" selected>Member</flux:select.option>
                        <flux:select.option value="guest">Guest</flux:select.option>
                    </flux:select>
                    <flux:button size="sm" variant="subtle" icon="trash" class="shrink-0" />
                </div>
            </flux:table.cell>
        </flux:table.row>
    </flux:table.rows>
</flux:table>
```

## Assignees list

```blade
<flux:card>
    <div class="flex justify-between items-center">
        <flux:heading>Assignees</flux:heading>
        <flux:button size="sm" variant="subtle" icon="plus" inset="top bottom" />
    </div>

    <flux:separator class="mt-2 mb-4" variant="subtle" />

    <ul class="flex flex-col gap-3">
        <li class="flex items-center gap-2">
            <flux:avatar size="xs" src="https://unavatar.io/github/calebporzio" />
            <flux:heading>Caleb Porzio</flux:heading>
        </li>
        <li class="flex items-center gap-2">
            <flux:avatar size="xs" src="https://unavatar.io/github/hugosaintemarie" />
            <flux:heading>Hugo Sainte-Marie</flux:heading>
        </li>
        <li class="flex items-center gap-2">
            <flux:avatar size="xs" src="https://unavatar.io/github/joshhanley" />
            <flux:heading>Josh Hanley</flux:heading>
        </li>
        <li class="flex items-center gap-2">
            <flux:avatar size="xs" src="https://unavatar.io/github/jasonlbeggs" />
            <flux:heading>Jason Beggs</flux:heading>
        </li>
    </ul>
</flux:card>
```

## Select options

```blade
<flux:select variant="listbox" label="Assign to">
    <flux:select.option selected>
        <div class="flex items-center gap-2 whitespace-nowrap">
            <flux:avatar circle size="xs" src="https://unavatar.io/github/calebporzio" /> Caleb Porzio
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2 whitespace-nowrap">
            <flux:avatar circle size="xs" src="https://unavatar.io/github/hugosaintemarie" /> Hugo Sainte-Marie
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2 whitespace-nowrap">
            <flux:avatar circle size="xs" src="https://unavatar.io/github/joshhanley" /> Josh Hanley
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2 whitespace-nowrap">
            <flux:avatar circle size="xs" src="https://unavatar.io/github/jasonlbeggs" /> Jason Beggs
        </div>
    </flux:select.option>
</flux:select>
```

## User popover

```blade
<flux:dropdown hover position="bottom center">
    <flux:avatar as="button" name="calebporzio" src="https://unavatar.io/x/calebporzio" />

    <flux:popover class="relative max-w-[15rem]">
        <div class="absolute top-0 right-0 p-2">
            <flux:button icon="user-plus" variant="filled" size="sm">Follow back</flux:button>
        </div>

        <flux:avatar size="xl" name="calebporzio" src="https://unavatar.io/x/calebporzio" />

        <flux:heading class="mt-2">Caleb Porzio</flux:heading>
        <flux:text>@calebporzio <flux:badge color="zinc" size="sm" inset="top bottom">Follows you</flux:badge></flux:text>

        <flux:text class="mt-3">
            I'm a full stack developer with a passion for building web applications. Currently working on a new project called <flux:link href="https://fluxui.dev">Flux</flux:link>.
        </flux:text>

        <div class="flex gap-4 mt-3">
            <div class="flex gap-2 items-center">
                <flux:heading>1.2k</flux:heading> <flux:text>Followers</flux:text>
            </div>

            <div class="flex gap-2 items-center">
                <flux:heading>1.2k</flux:heading> <flux:text>Following</flux:text>
            </div>
        </div>
    </flux:popover>
</flux:dropdown>
```

## Reference

### `flux:avatar`

| Prop | Description |
| --- | --- |
| `name` | User's name to display as initials. If provided without `initials`, this will be used to generate initials automatically. |
| `src` | URL to the image to display as avatar. |
| `initials` | Custom initials to display when no `src` is provided. Will override `name` if provided. |
| `alt` | Alternative text for the avatar image. (Default: `name` if provided) |
| `size` | Size of the avatar. Options: `xs` (24px), `sm` (32px), default (40px), `lg` (48px). |
| `color` | Background color when displaying initials or icons. Options: `red`, `orange`, `amber`, `yellow`, `lime`, `green`, `emerald`, `teal`, `cyan`, `sky`, `blue`, `indigo`, `violet`, `purple`, `fuchsia`, `pink`, `rose`, `auto`. Default: none (uses system colors). |
| `color:seed` | Value used when `color="auto"` to deterministically generate consistent colors. |
| `circle` | If present or `true`, makes the avatar fully circular instead of rounded corners. |
| `icon` | Name of the icon to display instead of an image or initials. |
| `icon:variant` | Icon variant to use. Options: `outline`, `solid`. Default: `solid`. |
| `tooltip` | Text to display in a tooltip when hovering over the avatar. If set to `true`, uses the `name` prop as tooltip content. |
| `tooltip:position` | Position of the tooltip. Options: `top`, `right`, `bottom`, `left`. Default: `top`. |
| `badge` | Content to display as a badge. Can be a string, boolean, or a slot. |
| `badge:color` | Color of the badge. Options: same color options as the `color` prop. |
| `badge:circle` | If present or `true`, makes the badge fully circular instead of slightly rounded corners. |
| `badge:position` | Position of the badge. Options: `top left`, `top right`, `bottom left`, `bottom right`. Default: `bottom right`. |
| `badge:variant` | Variant of the badge. Options: `solid`, `outline`. Default: `solid`. |
| `as` | Element to render the avatar as. Options: `button`, `div` (default). |
| `href` | URL to link to, making the avatar a link element. |

### `flux:avatar.group`

| Prop | Description |
| --- | --- |
| `class` | CSS classes to apply to the group, including customizing ring colors using `*:ring-{color}` format. |
