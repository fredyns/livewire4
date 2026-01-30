# Slider - PRO

Source: https://fluxui.dev/components/slider

Select a value using a horizontal slider control.

## Basic Example

```blade
<flux:slider wire:model="amount" />
```

## Min/max/step

```blade
<flux:slider min="0" max="100" step="10" />
```

## Displaying value

```blade
<flux:field>
    <flux:label>
        Corner radius
        <x-slot name="trailing">
            <span wire:text="amount" class="tabular-nums"></span>
        </x-slot>
    </flux:label>
    <flux:slider wire:model="amount" />
</flux:field>
```

## With input

```blade
<flux:field>
    <flux:label>Corner radius</flux:label>
    <div class="flex items-center gap-4 -mt-2">
        <flux:slider wire:model="amount" />
        <flux:input wire:model="amount" type="number" size="sm" class="max-w-18" />
    </div>
</flux:field>
```

## Big steps

```blade
<flux:slider step="1" big-step="10" />
```

## Step marks

```blade
<flux:slider min="1" max="5">
    @foreach (range(1, 5) as $i)
        <flux:slider.tick :value="$i" />
    @endforeach
</flux:slider>
```

## Numbered steps

```blade
<flux:slider min="1" max="5">
    @foreach (range(1, 5) as $i)
        <flux:slider.tick :value="$i">{{ $i }}</flux:slider.tick>
    @endforeach
</flux:slider>
```

## Custom steps

```blade
<flux:slider min="1" max="5">
    <flux:slider.tick value="1">Low</flux:slider.tick>
    <flux:slider.tick value="3">Mid</flux:slider.tick>
    <flux:slider.tick value="5">High</flux:slider.tick>
</flux:slider>
```

## Range slider

```blade
<flux:slider range />
```

## Basic usage

```blade
<flux:slider range value="20,80" />
```

```blade
<flux:slider range wire:model="range" />
```

```blade
<?php use Livewire\Component;

class Dashboard extends Component
{
    public array $range = [20, 80];
}
```

```blade
<flux:slider range step="1" min-steps-between="10" />
```

```blade
<div class="relative">
    <flux:field>
        <flux:label>
            Price range
            <x-slot name="trailing">
                $<span wire:text="range[0]" class="tabular-nums"></span> &ndash; $<span wire:text="range[1]" class="tabular-nums"></span>
            </x-slot>
        </flux:label>
        <flux:slider range wire:model="range" min="0" max="990" step="10" min-steps-between="10" big-step="100" />
    </flux:field>
</div>
```

## Custom styles

```blade
<flux:slider track:class="h-5" thumb:class="size-5" />
```

## Reference

### `flux:slider`

| Prop | Description |
| --- | --- |
| range | Enables range selection. |
| min | Minimum value of the slider. |
| max | Maximum value of the slider. |
| step | Step size of the slider. |
| big-step | Step size of the slider when holding shift. |
| min-steps-between | Minimum distance between thumbs in number of steps. |
| track:class | CSS classes applied to the track. |
| thumb:class | CSS classes applied to the thumb. |

### `flux:slider.tick`

| Prop | Description |
| --- | --- |
| value | The value at which the tick should be displayed. |
