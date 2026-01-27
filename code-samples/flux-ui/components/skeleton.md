# Skeleton

Source: https://fluxui.dev/components/skeleton

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:skeleton.group</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> animate</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"shimmer"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"flex items-center gap-4"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:skeleton</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"size-10 rounded-full"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"flex-1"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:skeleton.line</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:skeleton.line</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"w-1/2"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:skeleton.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Line of text

```blade
<flux:skeleton.group animate="shimmer">
    <flux:skeleton.line class="mb-2 w-1/4" />
    <flux:skeleton.line />
    <flux:skeleton.line />
    <flux:skeleton.line class="w-3/4" />
</flux:skeleton.group>
```

## Animation

```blade
<flux:skeleton />
<flux:skeleton animate="shimmer" />
<flux:skeleton animate="pulse" />
```

## Examples

```blade
<flux:skeleton.group animate="shimmer">
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Customer</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Amount</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach (range(1, 5) as $order)
                <flux:table.row>
                    <flux:table.cell>
                        <div class="flex items-center gap-2">
                            <flux:skeleton class="rounded-full size-5" />

                            <div class="flex-1">
                                <flux:skeleton.line style="width: {{ rand(50, 100) }}%" />
                            </div>
                        </div>
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:skeleton.line />
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:skeleton.line />
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:skeleton.line />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:skeleton.group>
```

```blade
<flux:card class="dark:bg-zinc-800">
    <div class="flex flex-col gap-6">
        <div class="flex gap-12">
            <div>
                <flux:text>Today</flux:text>
                <flux:heading size="xl" class="mt-2 tabular-nums">$---</flux:heading>
                <flux:text class="mt-2 tabular-nums">-:-- PM</flux:text>
            </div>

            <div>
                <flux:text>Yesterday</flux:text>
                <flux:heading size="lg" class="mt-2 tabular-nums">$---</flux:heading>
            </div>
        </div>

        <flux:skeleton animate="shimmer" class="aspect-[4/1] size-full rounded-lg" />
    </div>
</flux:card>
```

## Reference

### `flux:skeleton`

| Prop | Description |
| --- | --- |
| `animate` | Options: `shimmer`, `pulse`. Default: no animation. |

### `flux:skeleton.line`

| Prop | Description |
| --- | --- |
| `size` | Options: `base`, `lg`. Default: `base`. |
| `animate` | Options: `shimmer`, `pulse`. Default: none. Can be inherited from `flux:skeleton.group`. |

### `flux:skeleton.group`

| Prop | Description |
| --- | --- |
| `animate` | Sets animation for all skeletons in group. Options: `shimmer`, `pulse`. Default: none. |
