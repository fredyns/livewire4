# Composer - PRO

Source: https://fluxui.dev/components/composer

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">form</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:submit</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"send"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:composer</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"prompt"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Prompt"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label:sr-only</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> placeholder</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"How can I help you today?"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"actionsLeading"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"paper-clip"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"slash"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"subtle"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"adjustments-horizontal"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"actionsTrailing"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"filled"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"microphone"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> type</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"submit"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"primary"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"paper-airplane"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:composer</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">form</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Introduction

```blade
<form wire:submit="send">
    <flux:composer wire:model="prompt" label="Prompt" label:sr-only placeholder="How can I help you today?">
        <x-slot name="actionsLeading">
            <flux:button size="sm" variant="subtle" icon="paper-clip" />
            <flux:button size="sm" variant="subtle" icon="slash" />
            <flux:button size="sm" variant="subtle" icon="adjustments-horizontal" />
        </x-slot>

        <x-slot name="actionsTrailing">
            <flux:button size="sm" variant="filled" icon="microphone" />
            <flux:button type="submit" size="sm" variant="primary" icon="paper-airplane" />
        </x-slot>
    </flux:composer>
</form>
```

## With header

```blade
<flux:composer wire:model="prompt" label="Prompt" label:sr-only placeholder="How can I help you today?">
    <x-slot name="header">
        <div class="relative border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
            <img src="https://fluxui.dev/img/demo/caleb.png" alt="Profile picture" class="size-14">
            <div class="absolute top-0 right-0 p-1">
                <button type="button" class="p-0.5 rounded-full bg-zinc-900/50 hover:bg-zinc-900/70 flex justify-center items-center">
                    <flux:icon icon="x-mark" variant="micro" class="text-white" />
                </button>
            </div>
        </div>
    </x-slot>

    <x-slot name="actionsLeading">
        <!-- ... -->
    </x-slot>

    <x-slot name="actionsTrailing">
        <!-- ... -->
    </x-slot>
</flux:composer>
```

## Inline

```blade
<flux:composer wire:model="prompt" rows="1" inline label="Prompt" label:sr-only placeholder="How can I help you today?">
    <x-slot name="actionsLeading">
        <flux:button size="sm" variant="ghost" icon="plus" />
    </x-slot>

    <x-slot name="actionsTrailing">
        <flux:button size="sm" variant="filled" icon="microphone" />
        <flux:button type="submit" size="sm" variant="primary" icon="paper-airplane" />
    </x-slot>
</flux:composer>
```

## Input variant

```blade
<flux:composer variant="input" label="Message" placeholder="What's on your mind?">
    <!-- ... -->
</flux:composer>
```

## Height

```blade
<flux:composer rows="4" max-rows="8" ...>
    <!-- ... -->
</flux:composer>
```

## Submit behavior

```blade
<form wire:submit="send">
    <flux:composer wire:model="prompt" submit="enter" ...>
        <!-- ... -->
    </flux:composer>
</form>
```

## Rich text

```blade
<flux:composer wire:model="prompt" rows="3" label="Prompt" label:sr-only placeholder="How can I help you today?">
    <x-slot name="input">
        <flux:editor variant="borderless" toolbar="bold italic bullet ordered | link | align" />
    </x-slot>

    <x-slot name="actionsLeading">
        <flux:button size="sm" variant="subtle" icon="paper-clip" />
        <flux:button size="sm" variant="subtle" icon="slash" />
        <flux:button size="sm" variant="subtle" icon="adjustments-horizontal" />
    </x-slot>

    <x-slot name="actionsTrailing">
        <flux:button size="sm" variant="filled" icon="microphone" />
        <flux:button type="submit" size="sm" variant="primary" icon="paper-airplane" />
    </x-slot>
</flux:composer>
```

## Disabled

```blade
<flux:composer disabled ...>
    <!-- ... -->
</flux:composer>
```

## Invalid

```blade
<flux:composer wire:model="prompt" label="Prompt" label:sr-only ...>
    <!-- ... -->
</flux:composer>
```

## Reference

### `flux:composer`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the composer to a Livewire property. |
| `name` | Name attribute (also used for validation error detection). |
| `placeholder` | Placeholder text. |
| `label` | Label text (wraps in `flux:field` + `flux:label`). |
| `label:sr-only` | Visually hides the label (a11y friendly). |
| `description` | Help text. |
| `description:sr-only` | Visually hides description (a11y friendly). |
| `rows` | Visible rows. Default: `2`. |
| `max-rows` | Max auto-expanded rows. |
| `inline` | If present, shows actions inline with the input. |
| `submit` | Keyboard submit behavior. Options: `cmd+enter` (default), `enter`. |
| `disabled` | Disables interaction. |
| `invalid` | Applies error styling. |
