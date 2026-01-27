# Brand

Source: https://fluxui.dev/components/brand

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:brand</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> logo</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"/img/demo/logo.png"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Acme Inc."</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:brand</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> href</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"#"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Acme Inc."</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"logo"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"size-6 rounded shrink-0 bg-accent text-accent-foreground flex items-center justify-center"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">i</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"font-serif font-bold"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">A</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">i</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:brand</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<flux:brand href="#" logo="/img/demo/logo.png" name="Acme Inc." />

<flux:brand href="#" name="Acme Inc.">
    <x-slot name="logo">
        <div class="size-6 rounded shrink-0 bg-accent text-accent-foreground flex items-center justify-center"><i class="font-serif font-bold">A</i></div>
    </x-slot>
</flux:brand>
```

## Logo slot

```blade
<flux:brand href="#" name="Launchpad">
    <x-slot name="logo" class="size-6 rounded-full bg-cyan-500 text-white text-xs font-bold">
        <flux:icon name="rocket-launch" variant="micro" />
    </x-slot>
</flux:brand>
```

## Logo only

```blade
<flux:brand href="#" logo="/img/demo/logo.png" />
```

## Header with brand

```blade
<flux:header class="px-4! w-full bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-100 dark:border-white/5">
    <flux:brand href="#" name="Acme Inc.">
        <x-slot name="logo" class="bg-accent text-accent-foreground">
            <i class="font-serif font-bold">A</i>
        </x-slot>
    </flux:brand>

    <flux:navbar variant="outline">
        <flux:navbar.item href="#" current>Home</flux:navbar.item>
        <flux:navbar.item badge="12" href="#">Inbox</flux:navbar.item>
    </flux:navbar>

    <flux:spacer class="min-w-24" />

    <flux:profile circle :chevron="false" avatar="https://unavatar.io/x/calebporzio" />
</flux:header>
```

## Reference

### `flux:brand`

| Prop | Description |
| --- | --- |
| `name` | Company or application name to display next to the logo. |
| `logo` | URL to the image to display as logo, or can pass content via slot. |
| `alt` | Alternative text for the logo. |
| `href` | URL to navigate to when the brand is clicked. Default: `/`. |
