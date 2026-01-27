# Popover - PRO

Source: https://fluxui.dev/components/popover

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:dropdown</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"adjustments-horizontal"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon:variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"micro"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon:class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"text-zinc-400"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon-trailing</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"chevron-down"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon-trailing:variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"micro"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        icon-trailing:class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"text-zinc-400"</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    ></span></span><span class="line"><span style="color:#424258;--shiki-dark:#EEFFFF">        Options</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:popover</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"flex flex-col gap-4"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sort"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Sort by"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label:class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"text-zinc-500 dark:text-zinc-400"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"active"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Recently active"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"posted"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Date posted"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:separator</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"view"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"View as"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label:class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"text-zinc-500 dark:text-zinc-400"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"list"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"List"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> checked</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"gallery"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Gallery"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:radio.group</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:separator</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"justify-start -m-2 px-2!"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Reset to default</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:popover</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:dropdown</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Hover trigger

```blade
<flux:dropdown hover position="bottom" align="start" offset="-16" gap="10">
    <button type="button" class="flex items-center gap-3">
        <flux:avatar size="sm" name="Caleb Porzio" src="https://unavatar.io/x/calebporzio" />
        <flux:heading>Caleb Porzio</flux:heading>
    </button>

    <flux:popover class="flex flex-col gap-3 rounded-xl shadow-xl">
        <flux:avatar size="xl" name="Caleb Porzio" src="https://unavatar.io/x/calebporzio" />

        <div>
            <flux:heading size="lg">Caleb Porzio</flux:heading>

            <div class="flex items-center gap-2">
                <flux:text size="lg">@calebporzio</flux:text>
                <flux:badge>Follows you</flux:badge>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <flux:text class="flex gap-1"><flux:heading>775</flux:heading> following</flux:text>
            <flux:text class="flex gap-1"><flux:heading>50.2k</flux:heading> followers</flux:text>
        </div>

        <div class="flex gap-2">
            <flux:button variant="outline" size="sm" icon="check" icon:class="opacity-75" class="flex-1">Following</flux:button>
            <flux:button variant="primary" size="sm" icon="chat-bubble-left-right" icon:class="opacity-75" class="flex-1">Message</flux:button>
        </div>
    </flux:popover>
</flux:dropdown>
```

## Position

```blade
<flux:dropdown position="top" align="start">
    <flux:button>...</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>

<flux:dropdown position="right" align="center">
    <flux:button>...</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>

<flux:dropdown position="left" align="center">
    <flux:button>...</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>

<flux:dropdown position="bottom" align="end">
    <flux:button>...</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>
```

## Gap & offset

```blade
<!-- Gap -->
<flux:dropdown gap="16">
    <flux:button>Gap: 16px</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>

<!-- Offset -->
<flux:dropdown offset="32">
    <flux:button>Offset: 32px</flux:button>
    <flux:popover>...</flux:popover>
</flux:dropdown>
```

## Examples

```blade
<flux:dropdown>
    <flux:button icon="tag" icon:variant="micro" icon:class="text-zinc-400">
        Categories

        <x-slot name="iconTrailing">
            <flux:badge size="sm" class="-mr-1">
                <span x-text="$wire.categories.length" class="tabular-nums">&nbsp;</span>
            </flux:badge>
        </x-slot>
    </flux:button>

    <flux:popover class="max-w-[18rem] flex flex-col gap-4">
        <flux:checkbox.group variant="pills" wire:model="categories">
            <flux:checkbox value="fantasy" label="Fantasy" />
            <flux:checkbox value="science-fiction" label="Science fiction" />
            <flux:checkbox value="horror" label="Horror" />
            <flux:checkbox value="mystery" label="Mystery" />
            <flux:checkbox value="romance" label="Romance" />
            <flux:checkbox value="autobiography" label="Autobiography" />
            <flux:checkbox value="thriller" label="Thriller" />
            <flux:checkbox value="poetry" label="Poetry" />
            <flux:checkbox value="children" label="Children" />
        </flux:checkbox.group>

        <flux:separator variant="subtle" />

        <flux:button
            variant="subtle"
            size="sm"
            class="justify-start -m-2 !px-2"
            wire:click="$set('categories', [])"
        >
            Clear all
        </flux:button>
    </flux:popover>
</flux:dropdown>
```

```blade
<flux:dropdown>
    <flux:button icon="chat-bubble-oval-left" icon:variant="micro" icon:class="text-zinc-300">
        Feedback
    </flux:button>

    <flux:popover class="min-w-[30rem] flex flex-col gap-4">
        <flux:radio.group variant="buttons" class="*:flex-1">
            <flux:radio icon="bug-ant" checked>Bug report</flux:radio>
            <flux:radio icon="light-bulb">Suggestion</flux:radio>
            <flux:radio icon="question-mark-circle">Question</flux:radio>
        </flux:radio.group>

        <div class="relative">
            <flux:textarea
                rows="8"
                class="dark:bg-transparent!"
                placeholder="Please include reproduction steps. You may attach images or video files."
            />

            <div class="absolute bottom-3 left-3 flex items-center gap-2">
                <flux:button variant="filled" size="xs" icon="face-smile" icon:variant="outline" icon:class="text-zinc-400 dark:text-zinc-300" />
                <flux:button variant="filled" size="xs" icon="paper-clip" icon:class="text-zinc-400 dark:text-zinc-300" />
            </div>
        </div>

        <div class="flex gap-2 justify-end">
            <flux:button variant="filled" size="sm" kbd="esc" class="w-28">Cancel</flux:button>
            <flux:button size="sm" kbd="âŽ" class="w-28">Submit</flux:button>
        </div>
    </flux:popover>
</flux:dropdown>
```

```blade
<flux:dropdown position="bottom center">
    <button type="button" class="w-54 rounded-lg p-2 flex items-center gap-2 bg-zinc-100 hover:bg-zinc-200">
        <div class="self-stretch w-0.5 bg-zinc-800 rounded-full"></div>

        <div>
            <flux:heading>Team sync</flux:heading>
            <flux:text class="mt-1">10:00 AM</flux:text>
        </div>
    </button>

    <flux:popover class="w-80 p-0 data-open:flex flex-col">
        <div class="p-4">
            <flux:heading>Team sync</flux:heading>
            <flux:text class="mt-2">Let's review the progress made last week and define the priorities for the next</flux:text>

            <flux:radio.group variant="segmented" class="mt-3">
                <flux:radio value="going" label="Going" checked />
                <flux:radio value="not-going" label="Not going" />
                <flux:radio value="maybe" label="Maybe" />
            </flux:radio.group>
        </div>

        <flux:separator />

        <div class="p-4 flex gap-2">
            <flux:icon.users variant="micro" class="text-zinc-400" />

            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <flux:heading>Guests</flux:heading>
                    </div>

                    <flux:text><flux:link href="#" variant="subtle">Invite</flux:link></flux:text>
                </div>

                <div class="flex items-center gap-3 mt-2">
                    <flux:avatar.group>
                        <flux:avatar size="xs" circle src="https://unavatar.io/x/calebporzio" />
                        <flux:avatar size="xs" circle src="https://unavatar.io/github/hugosaintemarie" />
                        <flux:avatar size="xs" circle src="https://unavatar.io/github/joshhanley" />
                    </flux:avatar.group>

                    <flux:text>1 maybe, 1 awaiting</flux:text>
                </div>
            </div>
        </div>

        <flux:separator />

        <div class="p-4 flex gap-2">
            <flux:icon.clock variant="micro" class="text-zinc-400" />

            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <flux:heading>10:00 AM</flux:heading>
                        <flux:icon.arrow-right variant="micro" class="text-zinc-400" />
                        <flux:heading>11:00 AM</flux:heading>
                    </div>

                    <flux:text><flux:link href="#" variant="subtle">Edit</flux:link></flux:text>
                </div>

                <div class="flex gap-3 mt-2">
                    <flux:text>May 29 2025</flux:text>
                    <flux:text>Â·</flux:text>
                    <flux:text class="flex items-center gap-1.5">
                        <flux:icon.arrow-path-rounded-square variant="micro" class="text-zinc-400" />
                        Every weekday
                    </flux:text>
                </div>
            </div>
        </div>

        <flux:separator />

        <div class="p-4 flex gap-2">
            <flux:icon.map-pin variant="micro" class="text-zinc-400" />

            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <flux:heading>Location</flux:heading>
                    <flux:text><flux:link href="#" variant="subtle">Edit</flux:link></flux:text>
                </div>

                <flux:text class="mt-2">Paris HQ, 13 rue de la Prairie 75018</flux:text>
            </div>
        </div>
    </flux:popover>
</flux:dropdown>
```

## Reference

### `flux:dropdown`

| Prop | Description |
| --- | --- |
| `position` | Position relative to trigger. Options: `top`, `right`, `bottom` (default), `left`. |
| `align` | Alignment. Options: `start` (default), `center`, `end`. |
| `hover` | Open on hover instead of click. |
| `wire:model` | Bind open/closed state to a Livewire property. |

### `flux:popover`

| Prop | Description |
| --- | --- |
| `class` | Classes applied to popover container (e.g. `max-w-sm`, `w-80`). |
