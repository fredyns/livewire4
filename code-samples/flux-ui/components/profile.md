# Profile

Source: https://fluxui.dev/components/profile

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:profile</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> avatar</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"https://unavatar.io/x/calebporzio"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## With name

```blade
<flux:profile name="Caleb Porzio" avatar="https://unavatar.io/x/calebporzio" />
```

## Without chevron

```blade
<flux:profile :chevron="false" avatar="https://unavatar.io/x/calebporzio" />
```

## Circle avatar

```blade
<flux:profile circle :chevron="false" avatar="https://unavatar.io/x/calebporzio" />
<flux:profile circle name="Caleb Porzio" avatar="https://unavatar.io/x/calebporzio" />
```

## Avatar with initials

```blade
<!-- Automatically generates initials from name -->
<flux:profile name="Caleb Porzio" />

<!-- Specify color... -->
<flux:profile name="Caleb Porzio" avatar:color="cyan" />

<!-- Manually specify initials... -->
<flux:profile initials="CP" />

<!-- Provide name only for avatar initial generation... -->
<flux:profile avatar:name="Caleb Porzio" />
```

## Custom trailing icon

```blade
<flux:profile
    icon:trailing="chevron-up-down"
    avatar="https://unavatar.io/x/calebporzio"
    name="Caleb Porzio"
/>
```

## Examples

```blade
<flux:dropdown align="end">
    <flux:profile avatar="https://unavatar.io/x/calebporzio" />

    <flux:navmenu class="max-w-[12rem]">
        <div class="px-2 py-1.5">
            <flux:text size="sm">Signed in as</flux:text>
            <flux:heading class="mt-1! truncate">caleb@example.com</flux:heading>
        </div>

        <flux:navmenu.separator />

        <div class="px-2 py-1.5">
            <flux:text size="sm" class="pl-7">Teams</flux:text>
        </div>

        <flux:navmenu.item href="#" icon="check" class="text-zinc-800 dark:text-white truncate">Personal</flux:navmenu.item>
        <flux:navmenu.item href="#" indent class="text-zinc-800 dark:text-white truncate">Wireable LLC</flux:navmenu.item>

        <flux:navmenu.separator />

        <flux:navmenu.item href="/dashboard" icon="key" class="text-zinc-800 dark:text-white">Licenses</flux:navmenu.item>
        <flux:navmenu.item href="/account" icon="user" class="text-zinc-800 dark:text-white">Account</flux:navmenu.item>

        <flux:navmenu.separator />

        <flux:navmenu.item href="/logout" icon="arrow-right-start-on-rectangle" class="text-zinc-800 dark:text-white">Logout</flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>
```

```blade
<flux:dropdown position="top" align="start">
    <flux:profile avatar="https://unavatar.io/x/calebporzio" name="Caleb Porzio" />

    <flux:menu>
        <flux:menu.radio.group>
            <flux:menu.radio checked>Caleb Porzio</flux:menu.radio>
            <flux:menu.radio>Hugo Sainte-Marie</flux:menu.radio>
            <flux:menu.radio>Josh Hanley</flux:menu.radio>
        </flux:menu.radio.group>

        <flux:menu.separator />

        <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Reference

### `flux:profile`

| Prop | Description |
| --- | --- |
| `name` | User name displayed next to avatar. |
| `avatar` | Avatar image URL (or provide via `avatar` slot). |
| `avatar:name` | Name used for avatar initials generation. |
| `avatar:color` | Color for avatar (see Avatar color options). |
| `circle` | Circular avatar. Default: `false`. |
| `initials` | Initials when no avatar image (auto from name if omitted). |
| `chevron` | Show chevron dropdown indicator. Default: `true`. |
| `icon:trailing` | Custom trailing icon instead of chevron. |
| `icon:variant` | Trailing icon variant. Options: `micro` (default), `outline`. |
