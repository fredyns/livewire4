# Theming

Source: https://fluxui.dev/docs/theming

We've meticulously designed Flux to look great out of the box, however, every project has its own identity. You can choose from our hand-picked color schemes or build your own theme by customizing CSS variables.

[Build your theme with our interactive theme builder ->](https://fluxui.dev/themes)

## Base color

```css
/* resources/css/app.css */
/* Re-assign Flux's gray of choice... */
@theme {
  --color-zinc-50: var(--color-slate-50);
  --color-zinc-100: var(--color-slate-100);
  --color-zinc-200: var(--color-slate-200);
  --color-zinc-300: var(--color-slate-300);
  --color-zinc-400: var(--color-slate-400);
  --color-zinc-500: var(--color-slate-500);
  --color-zinc-600: var(--color-slate-600);
  --color-zinc-700: var(--color-slate-700);
  --color-zinc-800: var(--color-slate-800);
  --color-zinc-900: var(--color-slate-900);
  --color-zinc-950: var(--color-slate-950);
}
```

```blade
<flux:text class="text-slate-800 dark:text-white">...</flux:text>
```

## Accent color

```css
/* resources/css/app.css */
@theme {
    --color-accent: var(--color-red-500);
    --color-accent-content: var(--color-red-600);
    --color-accent-foreground: var(--color-white);
}

@layer theme {
    .dark {
        --color-accent: var(--color-red-500);
        --color-accent-content: var(--color-red-400);
        --color-accent-foreground: var(--color-white);
    }
}
```

```html
<button class="bg-[var(--color-accent)] text-[var(--color-accent-foreground)]">
```

```html
<button class="bg-accent text-accent-foreground">
```

## Accent props

```blade
<!-- Link -->
<flux:link :accent="false">Profile</flux:tab>

<!-- Tabs -->
<flux:tabs>
    <flux:tab :accent="false">Profile</flux:tab>
    <flux:tab :accent="false">Account</flux:tab>
    <flux:tab :accent="false">Billing</flux:tab>
</flux:tabs>

<!-- Navbar -->
<flux:navbar>
    <flux:navbar.item :accent="false">Profile</flux:navbar.item>
    <flux:navbar.item :accent="false">Account</flux:navbar.item>
    <flux:navbar.item :accent="false">Billing</flux:navbar.item>
</flux:navbar>

<!-- Navlist -->
<flux:navlist>
    <flux:navlist.item :accent="false">Profile</flux:navlist.item>
    <flux:navlist.item :accent="false">Account</flux:navlist.item>
    <flux:navlist.item :accent="false">Billing</flux:navlist.item>
</flux:navlist>
```
